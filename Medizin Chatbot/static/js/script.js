var siteroot = window.location.href;
if (siteroot.slice(-1)!="/") {
  siteroot += "/"
}

var mode = 'bot'

var logs = []
var sess_id = uuid.v4()

var first_msg = true;

function send() {
  if (first_msg)
  {
    removeWelcome();
  }

  var msg = document.getElementById("message").value;
  if (msg.trim() == "") {
    return false;
  }

  $("#message").val("");
  $("#message").focus();

  addMsg(msg);
  sendMsg(msg);
}

function sendMsg(msg) {
  var data = {"message": msg};
  if(mode == 'bot')
  {
    getResponse(data);
  }
  else if (mode == 'human')
  {
    sendAgent(data);
  }
}

function sendAgent(data) {
  data.id = sess_id

  var url = siteroot + "api/agent/send";
  fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  });
}

async function getResponse(data) {
  data.logs = logs
  data.id = sess_id

  var url = siteroot + "api/respond";
  var res = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  });

  var json = await res.json();
  logs = json.logs;
  last_log = logs[logs.length - 1];

  var action = last_log.action;
  var response = last_log.response;

  if (action == "print") {
    addResponseMsg(response);
  }
  else if (action == "print_multi") {
    var intents = last_log.intents;
    addMultiResponseMsg(response, intents);
  }
  else if(action == "contact_agent") {
    addResponseMsg(response);
    handleAgentConfirmation();
  }
}

function welcomeUser() {
  var welcomeMsg = `<div class="chat-message-div" id="welcome-msg">
                      <span style='flex-grow:1'></span>
                      <button type="button" class='btn btn-light chat-message chat-message-welcome' onclick="sayHi()">Say Hi!</button>
                      <span style='flex-grow:1'></span>
                    </div>`
  addMsgToChat(welcomeMsg);
}

function addMsgToChat(msg){
  $("#message-box").append(msg);
  $("#message-box").children().get(-1).scrollIntoView();
}

function addMsg(msg) {
  var newMsg = `<div class="chat-message-div">
                  <span style='flex-grow:1'></span>
                  <div class='chat-message chat-message-sent'>${msg}</div>
                </div>`;
  addMsgToChat(newMsg);

}

function addResponseMsg(msg) {
  var newResMsg = `<div class="chat-message-div">
                    <div class='chat-message chat-message-received'>${msg}</div>
                  </div>`;

  addMsgToChat(newResMsg);
}

function addMultiResponseMsg(msgs, intents) {
  var num = msgs.length;
  var multiResponseMsg = `<div class="chat-message-div"><div class="chat-message chat-message-received"><div class="list-group">`;
  multiResponseMsg += `<li class="list-group-item active">${msgs[0]}</li>`;

  for (i = 1; i < num; i++) {
    multiResponseMsg += `<button type="button" onclick="handleResponseButton(this)" class="list-group-item list-group-item-action" value="${intents[i-1]}">${msgs[i]}</button>`;
  }
  multiResponseMsg += '</div></div></div>';

  addMsgToChat(multiResponseMsg)
}

function sayHi() {
  removeWelcome();
  var msg = "Hi!";
  addMsg(msg);
  sendMsg(msg);
}

function removeWelcome() {
  $("#welcome-msg").remove();
  $("#message-box").css("display", "block");
  first_msg = false;
}

function handleAgentConfirmation() {
  mode='human';
  var pusher = new Pusher('59117481b93e20a34f20', {
    cluster: 'eu'
  });
  
  var channel = pusher.subscribe(sess_id);

  channel.bind('agent_msg', function(data) {
    addResponseMsg(data.message)
  });

  channel.bind('end_chat', function(data) {
    var agent_name = data.agent_name
    addResponseMsg(`Chat with ${agent_name} has ended`);
    pusher.unsubscribe(sess_id);
    mode = 'bot';
  });

  var url = siteroot + "api/agent/join";
  fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({'id': sess_id})
  });
}

function handleResponseButton(button) {
  var parent = button.parentElement;
  var response = button.innerHTML;
  var intent = button.value;
  parent.parentElement.remove();
  addMsg(response);

  var data = {"intent": intent};
  getResponse(data);
}

function closeWindow() {
  $("#chat-circle").toggle("scale");
  $("#main-card").toggle("scale");
}

function openWindow() {
  $("#chat-circle").toggle("scale");
  $("#main-card").toggle("scale");
  $("#main-card").css("display", "flex");
}

window.onload = function () {
  $("#message").on("keyup", function (event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      send();
    }
  });
};

$(document).ready(function () {
  $("#chat-circle").click(openWindow);
  $("#chat-toggle").click(closeWindow);
  welcomeUser();
});