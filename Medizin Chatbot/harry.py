{
    "intent": "medizin",
    "custom_intents": {
        "<unknown_token>": ["print_multi", ["d","b", "c","e","a"],
            ["Sorry, only the listed features are available right now","About Hospital", "Hospital Address","Hospital Contact Number","Chat with Doctor","About Chatbot"]
        ],
        "a": ["print", [],
            ["I am Medizin Chatbot - Doctor Patient Assistant Created by Harry"]
        ],
        
        "b": ["print", [],
            ["Hospital Address : Apollo Hospital, 80, Gandhi Nagar, Krishnagiri -635001"]
        ],
        "c": ["print", [],
            ["Hospital Contact number : +91 9487984214"]
        ],
        "d": ["print", [],
            ["To know about Hospital Visit : https://www.apollohospitals.com/"]
        ],
        "e": ["contact_agent", [],
            ["Please what while we connect you with a Doctor..."]
        ]    
    }
}


















































{
    "intent": "bank1",
    "custom_intents": {
				"<unknown_token>":["print_multi",["internet_banking", "invoice", "card_details", "insurance", "loan", "payment_issue", "contact_human_agent", "LS&CG"],["Sorry, I was unable to understand you. What is the issue you are facing?", "Bank 1 : I have problem with internet banking", "Bank 1 : Invoice Generation Or Invoice Details", "Bank 1 : Card related issues", "Bank 1 : Insurance requirements", "Bank 1 : Loan Prerequisites and charges", "Bank 1 : Problem in Payment ", "Bank 1 : Contact customer care", "Bank 1 : About our company"]
				],

				"internet_banking":["print",[],["Bank 1 : Welcome to the simplest internet banking interface ever", "Bank 1 : With internet banking, you can make any transaction anywhere", "Bank 1 : We provide the best quality internet banking solutions alongwith the most robust theft detection softwares", "Bank 1 : Our internet banking will help you achieve all the transaction possibilities you can imagine"]
				],

				"invoice_review":["print",[],["Bank 1 : We are checking the details on your invoice so as to remove any transaction discrepancies", "Bank 1 : Your invoice is under observation so as to filter out discrepancies if any."]
				],

				"invoice_generation":["print",[],["Bank 1 : We have made invoice generation highly user friendly. Follow the steps to get your invoice."]
				],

				"payment_issue_1":["print",[],["Bank 1 : You can solve this issue by doing abc", "Bank 1 : This is a frequently faced problem and can be solved by abc", "Bank 1 : I'm sorry for the inconvenience. This type of issue is solved by doing abc"]
				],

				"payment_issue_2":["print",[],["Bank 1 : You can solve this issue by doing xyz", "Bank 1 : This is a frequently faced problem and can be solved by xyz", "Bank 1 : I'm sorry for the inconvenience. This type of issue is solved by doing xyz"]
				],

				"payment_issue_3":["print",[],["Bank 1 : You can solve this issue by doing mno", "Bank 1 : This is a frequently faced problem and can be solved by mno", "Bank 1 : I'm sorry for the inconvenience. This type of issue is solved by doing mno"]
				],

				"existing_card_holder":["print",[],["Bank 1 : You are being redirected to our existing card division executive", "Bank 1 : Sorry for the trouble, we are resolving your problem. Kindly wait", "Bank 1 : For troubleshooting you can try this method. Otherwise wait till we connect you to our team."]
				],

				"new_card_holder":["print",[],["Bank 1 : You are being connected to our new card holder division", "Bank 1 : We are happy that you want to apply for our card. You are being forwarded to our agent.", "Bank 1 : Here is the link to get more details about our card policies and wait till you are redirected to our agent."]
				],

				"insurance":["print",[],["Bank 1 : Our insurance policies are highly reliable and cheap offering as low as 5 percent interests for loans over 100k and also extra benefits on health insurances.", "Bank 1 : We provide highly cheap and exciting offers on interests and extra benefits on loans over 100k", "Bank 1 : Loans at LS&CG are highly reliable and cheapest among all the options in the market. Also extra benefits are provided on loans over 100k"]
				],

				"card_details":["print_multi",["existing_card_holder", "new_card_holder"],["Select the desired option among the two", "Bank 1 : You already possess a card", "Bank 1 : You want to get a card"]
				],

				"invoice":["print_multi",["invoice_generation", "invoice_review"],["You have a query related to ", "Bank 1 : Invoice Generation", "Bank 1 : Discrepancy in generated invoice"]
				],

				"payment_issue":["print_multi",["payment_issue_1", "payment_issue_2", "payment_issue_3", "not_listed"],["Please describe which problem you are facing?", "Bank 1 : Problem of type 1", "Bank 1 : Problem of type 2", "Bank 1 : Problem of type 3", "Bank 1 : My problem isn't listed here"]
				],

				"loan":["print",[],["Bank 1 : You will be redirected to our loan handling department", "Bank 1 : For loan related issues, our respective department will in touch", "Bank 1 : Loan handling department will be happy to assist you", "Bank 1 : All your problems will be taken care by the loan handling department"]
				]
			}
}



{
	"intent": "bank1",
	"custom_intents": ['<unknown_token>','internet_banking','invoice_review','invoice_generation','payment_issue_1','payment_issue_2','payment_issue_3','existing_card_holder','new_card_holder','insurance','card_details','invoice','payment_issue','loan'],
	"action": ['print_multi','print','print','print','print','print','print','print','print','print','print_multi','print_multi','print_multi','print'],
	"multi_intents": [["internet_banking", "invoice", "card_details", "insurance", "loan", "payment_issue", "contact_human_agent", "LS&CG"],[],[],[],[],[],[],[],[],[],["existing_card_holder", "new_card_holder"],["invoice_generation", "invoice_review"],["payment_issue_1", "payment_issue_2", "payment_issue_3", "not_listed"],[]],
	"responses": []
}


{
    "intent": "bank2",
    "intents": [["internet_banking", "invoice", "card_details", "insurance", "loan", "payment_issue", "contact_human_agent", "LS&CG"]],
    "action": ["print_multi"],
    "responses": [["Sorry, I was unable to understand you. What is the issue you are facing?", "I have problem with internet banking", "Invoice Generation Or Invoice Details", "Card related issues", "Insurance requirements", "Loan Prerequisites and charges", "Problem in Payment ", "Contact customer care", "About our company"]]
}


{
    "intent": "<unknown_token>",
    "custom_intents": {
    		"<unknown_token>":["print",[],["Your Bank is not LS&CG Customer"]]
    	}
}

{
    "intent": "internet_banking",
    "action": "print",
    "client_name": "bank2",
    "responses": ["Welcome to the simplest internet banking interface ever", "With internet banking, you can make any transaction anywhere", "We provide the best quality internet banking solutions alongwith the most robust theft detection softwares", "Our internet banking will help you achieve all the transaction possibilities you can imagine"]
}

{
    "intent": "insurance",
    "action": "print",
    "client_name": "bank1",
    "responses": ["Our insurance policies are highly reliable and cheap offering as low as 5% interests for loans over 100k and also extra benefits on health insurances.", "We provide highly cheap and exciting offers on interests and extra benefits on loans over 100k", "Loans at LS&CG are highly reliable and cheapest among all the options in the market. Also extra benefits are provided on loans over 100k"],
    "bank1": ["Good insurance"]
}

{
    "intent": "invoice_generation",
    "action": "print",
    "client_name": "bank1",
    "responses": ["We have made invoice generation highly user friendly. Follow the steps to get your invoice."]
}

{
    "intent": "invoice_review",
    "action": "print",
    "client_name": "bank",
    "responses": ["We are checking the details on your invoice so as to remove any transaction discrepancies", "Your invoice is under observation so as to filter out discrepancies if any."]
}

{
    "intent": "card_details",
    "action": "print_multi",
    "client_name": "bank2",
    "intents": ["existing_card_holder", "new_card_holder"],
    "responses": ["Select the desired option among the two", "You already possess a card", "You want to get a card"]
}



{
    "intent": "invoice",
    "action": "print_multi",
    "client_name": "bank",
    "intents": ["invoice_generation", "invoice_review"],
    "responses": ["You have a query related to ", "Invoice Generation", "Discrepancy in generated invoice"]
}

{
    "intent": "payment_issue_1",
    "action": "print",
    "client_name": "bank",
    "responses": ["You can solve this issue by doing xyz", "This is a frequently faced problem and can be solved by xyz", "I'm sorry for the inconvenience. This type of issue is solved by doing xyz"]
}

{
    "intent": "payment_issue_2",
    "action": "print",
    "client_name": "bank",
    "responses": ["You can solve this issue by doing abc", "This is a frequently faced problem and can be solved by abc", "I'm sorry for the inconvenience. This type of issue is solved by doing abc"]
}

{
    "intent": "payment_issue_3",
    "action": "print",
    "client_name": "bank",
    "responses": ["You can solve this issue by doing ijk", "I'm sorry for the inconvenience. This type of issue is solved by doing ijk", "This is a frequently faced problem and can be solved by ijk"]
}


{
    "intent": "existing_card_holder",
    "action": "print",
    "client_name": "bank",
    "responses": ["You are being redirected to our existing card division executive", "Sorry for the trouble, we are resolving your problem. Kindly wait", "For troubleshooting you can try this method. Otherwise wait till we connect you to our team."]
}

{
    "intent": "new_card_holder",
    "action": "print",
    "client_name": "bank",
    "responses": ["You are being connected to our new card holder division", "We are happy that you want to apply for our card. You are being forwarded to our agent.", "Here is the link to get more details about our card policies and wait till you are redirected to our agent."]
}

{
    "intent": "payment_issue",
    "action": "print_multi",
    "client_name": "bank1",
    "intents": ["payment_issue_1", "payment_issue_2", "payment_issue_3", "not_listed"],
    "responses": ["Please describe which problem you are facing?", "Problem of type 1", "Problem of type 2", "Problem of type 3", "My problem isn't listed here"]
}



{
    "intent": "not_listed",
    "action": "contact_agent_confirm",
    "client_name": "bank",
    "responses": ["Would you like to chat with our agent?", "I will divert this chat to an agent. Is that okay?", "Are you okay if an agent from our company reaches out to solve your problem?"]
}