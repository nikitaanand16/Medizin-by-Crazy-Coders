# Chatbot Development Documentation

## Contents
1. [Setup Instructions and Dependencies](#1-setup-instructions-and-dependencies)
2. [Repository Overview](#2-repository-overview)
3. [Application Architecture](#3-application-architecture)
4. [Features To Be Added](#4-features-to-be-added)

## 1. Setup Instructions and Dependencies
To set up this repository on your local machine first clone this repo by running the following line on your `terminal`.

```Batchfile
git clone https://github.com/LS-CG/CHATBOT.git
```

All dependencies required by this repo are listed in `requirements.txt`. Setup a virtual environment with **Python 3.8** and run the following command to install the dependencies.

``` Batchfile
pip install -r requirements.txt
```

Make an environment variable for **MONGO_URI**.

In Linux, this can be done as:
```Batchfile
export MONGO_URI="mongodb+srv://test:uDklHW0jFfumu3t6@cluster0.mxgtd.gcp.mongodb.net/responses?retryWrites=true&w=majority"
```

## 2. Repository Overview

+ **Data**: Data files for training the NLU model.

    + `classes.pkl`: Pickled list of classes used by NLU model.
    + `data.json`: Data used to train on.
    + `words.pkl`: Pickled list of words used by the NLU model.

+ **Saved_models**: Saved TensorFlow models.

    + `model.h5`: Saved NLU model.
    + `model.tflite`: Saved NLU model in tf-lite format, to be used in deployment.

+ **Static**: Files for the Chatbot frontend.

    + **css**: Contains css stylesheets.
    + **js**: Contains client side code.

        + `agent.js`: Code for Agent view.
        + `script.js`: Code for Customer view.
    
    + **resources**: Contains statics resources.

+ **Templates**: HTML files for frontend.
+ `app.py`: Server-side code.
+ `model.py`: NLU model class.
+ `requirements.txt`: Python dependencies.
+ `train.py`: Code for training and saving NLU model.

## 3. Application Architecture
Chatbot is an `API` service that takes a user message or `query` as a **POST** request and sends back a customizable response. The `API` takes the user query and runs it through our `NLU model`, which outputs the user’s intent. Using this intent we query our `database` for a response. We then send this response back to the frontend to be displayed to the user.
Currently, there are 2 types of responses:
+ `print` just prints the response in the frontend (**non-interactive**)
+ `print_multi` prints multiple options, and the user can select one to proceed (**interactive**).

## 4. Features To Be Added
*(Listed in order of urgency)*

+ **Live chat with an agent (Must have for demo)**

    *Update* - This feature is implemented using **Pusher**.
    + Need to polish the workings of this feature.

+ **Secure API with access keys**
    
    + Securing our prediction API with access keys will allow us to only serve targeted customers. This will also prevent hackers and unethical people from messing with our programs.

+ **Shift Response and Logs Storage Database from MongoDB Atlas**

    + Currently, I am storing all the responses and logs in my personal Atlas database. It has only a few hundred-megabyte limit and will start costing me soon.
    + We can shift the database to LSCGs AWS using AWS Dynamo as we have enough credit there. Otherwise, we can create the company’s Atlas account for the same.
