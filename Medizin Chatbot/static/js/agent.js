//const siteroot = "https://lscg-chatbot.herokuapp.com"
// const siteroot = "http://127.0.0.1:5000";
var siteroot = window.location.href;
siteroot = siteroot.slice(0, -5)
var agent_name = "Doctor Harry";
var agent_id = uuid.v4()

var issues_resolved = 0
var issues_open = 0

var current_cust = 0
var waiting_cust = []
var resolving = false

var pusher = new Pusher('59117481b93e20a34f20', {
  cluster: 'eu'
});

var agent_channel = pusher.subscribe('agent_channel');
agent_channel.bind('new_cust', function(data) {
  newCust(data.cust_id);
});

function newCust(cust_id) {
  if (resolving)
  {
    addUserCard('New Issue', 2, cust_id);
    waiting_cust.push(cust_id);
  }
  else
  {
    resolving = true;
    addUserCard('New Issue', 1, cust_id);
    startChat(cust_id);
  }
}

function startChat(cust_id) {
  current_cust = cust_id;

  cust_channel = pusher.subscribe(cust_id);
  cust_channel.bind('cust_msg', function(data) {
    addResponseMsg(data.message);
  })
  sendMsg(`${agent_name} is ready to answer your queries`);
}

function endChat() {
  if (!resolving) {
    return false;
  }
  url = siteroot + 'api/agent/end';
  data = {'cust_id': current_cust, 'agent_name': agent_name};
  sendPOST(url, data);

  clearChat();
  updateCards();
  pusher.unsubscribe(current_cust);

  if(waiting_cust.length == 0) {
    resolving = false;
    return;
  }
  startChat(waiting_cust.shift());
}

function send() {
  var msg = $("#message").val();

  if (msg.trim() == "") {
    return false;
  }
  $("#message").val("");
  $("#message").focus();

  addMsg(msg);
  if (!resolving) {
    addResponseMsg("No one hears you.");
    return false;
  }
  sendMsg(msg);
}

function sendMsg(msg) {
  var url = siteroot + "api/agent/reply";
  data = {'cust_id': current_cust, 'message': msg};
  sendPOST(url, data);
}

function sendPOST(url, data) {
  fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  });
}

function addMsg(msg) {
  var msgDiv = `<div class="chat-message-div">
                  <span style='flex-grow:1'></span>
                  <div class='chat-message chat-message-sent'>${msg}</div>
                </div>`;

  $("#message-box").append(msgDiv);
  $("#message-box").scrollTop($("#message-box")[0].scrollHeight);
}

function addResponseMsg(msg) {
  var responseMsgDiv = `
    <div class="chat-message-div">
        <div class='chat-message chat-message-received'>${msg}</div>
    <div>`;

  $("#message-box").append(responseMsgDiv);
  $("#message-box").scrollTop($("#message-box")[0].scrollHeight);
}

function addMultiResponseMsg(msgs) {
  var num = msgs.length;

  var multiResponseMsg = `<div class="chat-message-div">`;

  for (i = 1; i < num; i++) {
    multiResponseMsg += `<button onclick="handleResponseButton(this.id)" class="chat-message response-button" id="button${buttonID++}">${msgs[i]}</button>`;
  };
  multiResponseMsg += '</div>'

  $("#message-box").append(multiResponseMsg);
  $("#message-box").scrollTop($("#message-box")[0].scrollHeight);
}

function clearChat() {
  $("#message-box").empty();
}

function handleResponseButton(id) {
  intent = $(`#${id}`).html();
  addMsg(intent);
  getResponse(intent);
}

function updateCards() {
  issues_open--;
  issues_resolved++;
  $("#issues-resolved").html(issues_resolved);
  $("#issues-open").html(issues_open);

  $(".text-primary").removeClass("text-primary").addClass("text-success").html("Issue Resolved");

  if(waiting_cust.length > 0) {
    $(".text-danger").first().removeClass("text-danger").addClass("text-primary").html("Resolving Issue");
  }
}

function addStatCard(stat, amount) {
  card=`
    <div class="issue-card bg-light text-center">
      <div class="card-body">
        <h3 class="card-title">${amount}</h5>
        <div class="card-text">${stat}</div>
      </div>
    </div>`;
  $("#stats-col").append(card)
}

function addUserCard(title, statusCode, id) {
  if (statusCode==1){
    var status = "Resolving Issue";
    var textColor = "text-primary";
  }
  else if (statusCode==2){
    var status = "Open Issue";
    var textColor = "text-danger";
  }
  issues_open++;
  $("#issues-open").html(issues_open);
  card = `
    <div class="issue-card bg-light">
      <div class="card-header bg-transparent ${textColor}">${status}</div>
      <div class="card-body">
        <h5 class="card-title">${title}</h5>
        <div class="class-text">${id}</div>
      </div>
    </div>`;

  $("#card-stack").append(card);
  $("#card-stack").children().get(-1).scrollIntoView();
}

function setAgentName() {
  agent_name = $("#agent-name").val();
}

$(document).ready(function () {
  $("#agent-name").on("keyup", function (event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      setAgentName();
    }
  });

  $("#agent-name").blur(setAgentName);

  $("#message").on("keyup", function (event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      send();
    }
  });
  
  $("#end-chat").click(endChat);
});