const express1 = require("express");
const http1 = require("http");
const WebSocket1 = require("ws");

// Opening websocket servers on 7 different ports

const port1 = 6969;
var server = http1.createServer(express1);
const wss1 = new WebSocket1.Server({ server });

wss1.on("connection", function connection(ws1) {
  console.log(wss1.clients.size);
  ws1.on("message", function incoming(data) {
    wss1.clients.forEach(function each(client) {
      if (client !== ws1 && client.readyState === WebSocket1.OPEN) {
        client.send(data);
      }
    });
  });
});

server.listen(port1, function () {
  console.log(`Server is listening on ${port1}!`);
});

const port2 = 7969;
server = http1.createServer(express1);
const wss2 = new WebSocket1.Server({ server });

wss2.on("connection", function connection(ws2) {
  ws2.on("message", function incoming(data) {
    wss2.clients.forEach(function each(client) {
      if (client !== ws2 && client.readyState === WebSocket1.OPEN) {
        client.send(data);
      }
    });
  });
});

server.listen(port2, function () {
  console.log(`Server is listening on ${port2}!`);
});

const port3 = 15207;
server = http1.createServer(express1);
const wss3 = new WebSocket1.Server({ server });

wss3.on("connection", function connection(ws3) {
  ws3.on("message", function incoming(data) {
    wss3.clients.forEach(function each(client) {
      if (client !== ws3 && client.readyState === WebSocket1.OPEN) {
        client.send(data);
      }
    });
  });
});

server.listen(port3, function () {
  console.log(`Server is listening on ${port3}!`);
});

const port4 = 54428;
server = http1.createServer(express1);
const wss4 = new WebSocket1.Server({ server });

wss4.on("connection", function connection(ws4) {
  ws4.on("message", function incoming(data) {
    wss4.clients.forEach(function each(client) {
      if (client !== ws4 && client.readyState === WebSocket1.OPEN) {
        client.send(data);
      }
    });
  });
});

server.listen(port4, function () {
  console.log(`Server is listening on ${port4}!`);
});

const port5 = 42027;
server = http1.createServer(express1);
const wss5 = new WebSocket1.Server({ server });

wss5.on("connection", function connection(ws5) {
  ws5.on("message", function incoming(data) {
    wss5.clients.forEach(function each(client) {
      if (client !== ws5 && client.readyState === WebSocket1.OPEN) {
        client.send(data);
      }
    });
  });
});

server.listen(port5, function () {
  console.log(`Server is listening on ${port5}!`);
});

const port6 = 37018;
server = http1.createServer(express1);
const wss6 = new WebSocket1.Server({ server });

wss6.on("connection", function connection(ws6) {
  ws6.on("message", function incoming(data) {
    wss6.clients.forEach(function each(client) {
      if (client !== ws6 && client.readyState === WebSocket1.OPEN) {
        client.send(data);
      }
    });
  });
});

server.listen(port6, function () {
  console.log(`Server is listening on ${port6}!`);
});

const port7 = 24097;
server = http1.createServer(express1);
const wss7 = new WebSocket1.Server({ server });

wss7.on("connection", function connection(ws7) {
  ws7.on("message", function incoming(data) {
    wss7.clients.forEach(function each(client) {
      if (client !== ws7 && client.readyState === WebSocket1.OPEN) {
        client.send(data);
      }
    });
  });
});

server.listen(port7, function () {
  console.log(`Server is listening on ${port7}!`);
});
