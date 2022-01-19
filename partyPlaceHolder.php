<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Party</title>
    <link rel="stylesheet" href="../css/partyHolder.css">
</head>
<body>
  <div id = "buttons">
    <button id = "pause">Pause</button>
    <button id = "play">Play</button>
  </div>
  
  <div id = "video-box">
    <iframe id="myFrame" src=""></iframe>
    <input type="text" id="url" placeholder="Type your link here" />
    <button id="sendURL" title="Post Url!" >Post Url</button>
  </div>
  <div id = "chat-box">
    <pre id="messages"></pre>
    <input type="text" id="messageBox" placeholder="Type your message here" style="display: block; width: 100%;" />
    <button id="sendMSG" title="Send Message!" style="width: 100%; height: 30px;">Send Message</button>
  </div>
  
</body>
<script src="port.js"> </script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
  var name = prompt("Please enter your name:");
  // Generate random name
  var random = Math.floor(100000 + Math.random() * 900000);
  if (name == "null" || name == "") {
      name = "default" + random;
  }
  var port = ""
  var client = new XMLHttpRequest();
  // Open latest port via text file
  client.open('GET', '../ports.txt');
  // check if page is ready
  client.onreadystatechange = function() {
    if(client.readyState==4 && client.status==200)
      port = client.responseText
      var pageUrl = window.location.href.split('st/').pop();
      
      (function() {
        const sendURL = document.querySelector('#sendURL');
        const messages = document.querySelector('#messages');
        const url = document.querySelector('#url');
        const messageBox = document.querySelector('#messageBox');
        const sendMSG = document.querySelector('#sendMSG');
        const pauseVideo = document.querySelector('#pause');
        let ws;
        function sleep (time) {
            return new Promise((resolve) => setTimeout(resolve, time));
        }
        
        function pauser (result) {
          // pause iframe
          $('#myFrame')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
        }
        function player (result) {
          // play iframe
          $('#myFrame')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
        }

        //display video
        function showVideo(url) {
            // make youtube link embedded
            var fixedurl = url.split('v=').pop();
            var userURL = 'https://www.youtube.com/embed/'+fixedurl;
            document.getElementById("myFrame").src = userURL+"?enablejsapi=1&autoplay=1&mute=1&start=1&version=3&playerapiid=ytplayer";
            //messages.textContent += `\n\n${message}`;
            url.value = '';
        }

        //display messages
        function showMessage(message) {
          messages.textContent += `\n\n${message}`;
          messages.scrollTop = messages.scrollHeight;
          messageBox.value = '';
        }

        function init() {
          // open websocket 
          if (ws) {
            ws.onerror = ws.onopen = ws.onclose = null;
            ws.close();
          }
          ws = new WebSocket('ws://localhost:'+port);
          ws.onopen = () => {
            console.log('Connection opened!');
          }
          ws.onmessage = ({ data }) => {
            if( data.indexOf("http") == 0 ) {
                showVideo(data);
            } else if (data == "pauseVideo") {
              pauser(data);
            } else if (data == "playVideo"){
              player(data);
            } else {
              showMessage(data);
            }
          }
          ws.onclose = function() {
            ws = null;
          }
        }
        sendURL.onclick = function() {
          if (!ws) {
            showMessage("No WebSocket connection :(");
            return ;
          }

          if( url.value.indexOf("http") == 0 ){
            ws.send(url.value);
            showVideo(url.value);
          }else{
            alert("Invalid Link");
          }
        }

        pause.onclick = function() {
          ws.send("pauseVideo");
          pauser();
        }

        play.onclick = function() {
          ws.send("playVideo");
          player();
        }
        
        sendMSG.onclick = function() {
          if (!ws) {
            showMessage("No WebSocket connection :(");
            return ;
          }
          if( messageBox.value.indexOf("http") != 0 ){
            ws.send(name + ": " + messageBox.value);
            showMessage(name + ": " + messageBox.value);
          }else{
            alert("Message Must not be a Link!");
          }
          
        }

        init();
      })();
      }
      client.send();
      
  
</script>
