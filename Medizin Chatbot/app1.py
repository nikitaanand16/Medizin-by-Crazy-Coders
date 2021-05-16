from flask import Flask, render_template, request, jsonify, url_for, redirect
from model import IntentPredictor
from flask_pymongo import PyMongo
import random
import os
from datetime import datetime
from pusher import Pusher
import pymongo
pusher_client = Pusher(
  app_id='1088509',
  key='0ab2e86a00e6cc9ad003',
  secret='407e22a01b932b64aa14',
  cluster='ap2',
  ssl=True
)

from flask_cors import CORS

MONGO_URI = "mongodb+srv://test:test@cluster0.klydr.mongodb.net/chatbot?retryWrites=true&w=majority"

app = Flask(__name__)
CORS(app)

app.config["MONGO_URI"] = "mongodb+srv://test:test@cluster0.klydr.mongodb.net/chatbot?retryWrites=true&w=majority"
mongo = PyMongo(app)

model = IntentPredictor()
model.load_model()

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/agent')
def agent():
    return render_template('agent.html')

# @app.route('/intent', methods=['POST'])
@app.route('/intent')
def intent():
    # jsonfile = request.json
    # print(jsonfile)
    return render_template('intent.html')


@app.route('/intent/client',methods=['GET','POST'])
def getintent():
    if request.method == 'GET':
        return 'Send a POST request here'
    jsonfile=request.json
    print(jsonfile)
    myclient = pymongo.MongoClient(MONGO_URI)
    mydb = myclient["chatbot"]
    mycol = mydb["responses"]
    a=jsonfile['tag']
    f=mycol.find_one({'intent': a});
    if(f==None):
        q='print'
        s=jsonfile['pattern'][-1].split(";")
        mydict={'intent':a, 'action':q,'responses':s}
        mycol.insert(mydict)
        f=mycol.find_one({'intent': a});
        print("Insert Done")
        doc=mycol.find_one({'intent': '<unknown_token>'});
        print(doc,flush=True)
        doc['intents'].append(a)
        doc['responses'].append(a)
        mycol.update({"intent": '<unknown_token>'},doc)


    else:
        s=jsonfile['pattern'][-1].split(";")
        myquery = { "intent": a }
        newvalues = { "$set": { "responses": s } }
        mycol.update_one(myquery, newvalues)
        print("Update Done")
    return 'HI'


@app.route('/api/agent/join', methods=['POST'])
def wait():
    jsonfile = request.json
    cust_id = jsonfile['id']
    pusher_client.trigger('agent_channel', 'new_cust', {'cust_id': cust_id})
    return jsonify({'code': 200}) 

@app.route('/api/agent/reply', methods=['POST'])
def reply():
    jsonfile = request.json
    cust_id = jsonfile['cust_id']
    msg = jsonfile['message']
    pusher_client.trigger(cust_id, 'agent_msg', {'message': msg})
    return jsonify({'code': 200}) 

@app.route('/api/agent/send', methods=['POST'])
def send():
    jsonfile = request.json
    msg = jsonfile['message']
    cust_id = jsonfile['id']
    pusher_client.trigger(cust_id, 'cust_msg', {'message': msg})
    return jsonify({'code': 200})

@app.route('/api/agent/end', methods=['POST'])
def end():
    jsonfile = request.json
    cust_id = jsonfile['cust_id']
    agent_name = jsonfile['agent_name']
    pusher_client.trigger(cust_id, 'end_chat', {'agent_name': agent_name})
    return jsonify({'code': 200}) 

@app.route('/api/respond', methods=['POST'])
def respond():
    jsonfile = request.json
    logs = jsonfile['logs']
    sess_id = jsonfile['id']
    message = ""

    if "message" in jsonfile.keys():
        message = jsonfile['message']
        intent = model.predict_intent(message)

    else:
        intent = jsonfile['intent']

    json = {"intent": intent}
    res = mongo.db.responses.find_one_or_404(json)

    responses = res['responses']
    action = res['action']
    intents = []
    if action=='print_multi':
        response = responses
        intents = res['intents']
    else:
        response = random.choice(responses)

    dateTimeObj = datetime.utcnow()
    timestamp = dateTimeObj.strftime("%H:%M:%S %d/%m/%Y") 

    logs.append({"message" : message, "intent": intent, "action": action, "response": response, "intents": intents, "timestamp": timestamp})
    mongo.db.logs.update_one({"_id": sess_id}, {"$set" :{"logs": logs}}, upsert=True)

    return jsonify({"logs": logs})

if __name__ == '__main__':
    app.run(debug=True)