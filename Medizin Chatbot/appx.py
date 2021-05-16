from flask import Flask, render_template, request, jsonify
from model import IntentPredictor
from flask_pymongo import PyMongo
import random
import os
from tensorflow.keras.models import load_model
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

MONGO_URI="mongodb+srv://hariharan:hariharan@chatbot.uzonj.mongodb.net/chatbot?retryWrites=true&w=majority"

app = Flask(__name__)

app.config["MONGO_URI"] = MONGO_URI
mongo = PyMongo(app)

model = IntentPredictor()
model.load_model()

@app.route('/<name>')
def home(name):
    return render_template('index.html',client_name=name)

@app.route('/agent')
def agent():
    return render_template('agent.html')

@app.route('/<name>/api/agent/join', methods=['POST'])
def wait():
    jsonfile = request.json
    cust_id = jsonfile['id']
    pusher_client.trigger('agent_channel', 'new_cust', {'cust_id': cust_id})
    return jsonify({'code': 200}) 

@app.route('/<name>/api/agent/reply', methods=['POST'])
def reply():
    jsonfile = request.json
    cust_id = jsonfile['cust_id']
    msg = jsonfile['message']
    pusher_client.trigger(cust_id, 'agent_msg', {'message': msg})
    return jsonify({'code': 200}) 

@app.route('/<name>/api/agent/send', methods=['POST'])
def send():
    jsonfile = request.json
    msg = jsonfile['message']
    cust_id = jsonfile['id']
    pusher_client.trigger(cust_id, 'cust_msg', {'message': msg})
    return jsonify({'code': 200})

@app.route('/<name>/api/agent/end', methods=['POST'])
def end():
    jsonfile = request.json
    cust_id = jsonfile['cust_id']
    agent_name = jsonfile['agent_name']
    pusher_client.trigger(cust_id, 'end_chat', {'agent_name': agent_name})
    return jsonify({'code': 200}) 

@app.route('/<name>/api/respond', methods=['POST'])
def respond(name):
    k=0;
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
    #res = mongo.db.responses.find_one_or_404(json)
    #responses = res['responses']
    #action = res['action']
    #intents = []
    #m=res['client_name']

    myclient = pymongo.MongoClient(MONGO_URI)
    mydb = myclient["chatbot"]
    mycol = mydb["responses"]
    res=mycol.find_one(json);

    if(intent=="<unknown_token>" or res==None):
        myclient = pymongo.MongoClient(MONGO_URI)
        mydb = myclient["chatbot"]
        mycol = mydb["bank_custom"]
        b=mycol.find_one({'intent': name});

        if(b==None):
            b=mycol.find_one({'intent': '<unknown_token>'});
            intent='<unknown_token>';
            
        a=b['custom_intents'][intent]
        action=a[0]
        intents=a[1]
        responses=a[2]

        if action=='print_multi':
            response = responses
        else:
            response = random.choice(responses)

    else:
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
    app.run()
