import os
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3' 

import tensorflow as tf
#physical_devices = tf.config.list_physical_devices('GPU') 
#tf.config.experimental.set_memory_growth(physical_devices[0], True)

from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Dense, Activation, Dropout
from tensorflow.keras.optimizers import SGD
from tensorflow.keras import losses
from tensorflow.keras.models import load_model

import numpy as np
import pickle
import nltk
nltk.download("punkt")
nltk.download("wordnet")
from nltk.stem import WordNetLemmatizer

class myCallback(tf.keras.callbacks.Callback):
    def on_epoch_end(self, epoch, logs={}):
        if(logs.get('accuracy') > 0.99):
            print("\nReached 99% accuracy, so stopping training ")
            self.model.stop_training=True

class IntentPredictor(object):
    def __init__(self):
        self.confidence_threshold = 0.7
        self.unknown_intent = "<unknown_token>"
        self.lemmatizer = WordNetLemmatizer()
        self.words = pickle.load(open('data/words.pkl','rb'))
        self.classes = pickle.load(open('data/classes.pkl','rb'))

    def make_model(self, input_shape, output_shape):
        
        model = Sequential()
        model.add(Dense(70, input_shape=(input_shape,), activation='relu'))
        model.add(Dropout(0.5))
        model.add(Dense(40, activation='relu'))
        model.add(Dropout(0.5))
        model.add(Dense(output_shape))
        # Compiling model. SGD with Nesterov accelerated gradient gives good results for this model
        sgd = SGD(lr=0.01, decay=1e-6, momentum=0.9, nesterov=True)
        model.compile(loss=losses.CategoricalCrossentropy(from_logits=True), optimizer=sgd, metrics=['accuracy'])
        
        self.model = model

    def train(self, Xs, Ys, epochs=50, batch_size=5, location='saved_models'):
        callbacks = myCallback()
        history = self.model.fit(Xs, Ys, epochs=epochs, batch_size=batch_size, callbacks=[callbacks])
        model_location = os.path.join(location, 'model.h5')
        self.model.save(model_location)

        converter = tf.lite.TFLiteConverter.from_keras_model(self.model)
        tflite_model = converter.convert()
        
        lite_model_location = os.path.join(location, 'model.tflite')
        open(lite_model_location, "wb").write(tflite_model)

        return history

    def load_model(self, location='saved_models/model.h5'):
        self.model = load_model(location,compile=False)

    def clean_up_sentence(self, sentence):
        sentence_words = nltk.word_tokenize(sentence)
        sentence_words = [self.lemmatizer.lemmatize(word.lower()) for word in sentence_words]
        return sentence_words

    def bag_of_words(self, sentence, show_details=False):
        sentence_words = self.clean_up_sentence(sentence)
        bag = [0]*len(self.words)  
        for s in sentence_words:
            for i,word in enumerate(self.words):
                if word == s: 
                    bag[i] = 1
                    if show_details:
                        print ("found in bag: %s" % word)
        return(np.array(bag))

    def predict_intent(self, sentence):
        # filter below  threshold predictions
        p = self.bag_of_words(sentence,show_details=False)
        logits = self.model.predict(np.array([p]))[0]
        results  = tf.nn.softmax(logits).numpy()
        max_index = np.argmax(results)

        if results[max_index] < self.confidence_threshold:
            return self.unknown_intent
        
        intent_str = self.classes[max_index]
        return intent_str
