/*var WebSocketServer = new require('ws');

// подключенные клиенты
var clients = {};

// WebSocket-сервер на порту 8081
var webSocketServer = new WebSocketServer.Server({port: 8888});
webSocketServer.on('connection', function(ws) {

  var id = Math.random();
  clients[id] = ws;
  console.log("новое соединение " + id);

  ws.on('message', function(message) {
    console.log('получено сообщение ' + message);

    for(var key in clients) {
      clients[key].send(message);
    }
  });

  ws.on('close', function() {
    console.log('соединение закрыто ' + id);
    delete clients[id];
  });

});

console.log("Сервер запущен на порту 8082");*/


var https = require('https');
var WebSocketServer = require('ws'), fs = require('fs');
var port = 4433; 
var app = null;

var processRequest = function( req, res ) {
    res.writeHead(200);
    res.end("All glory to WebSockets!\n");
};

app = https.createServer({
    //key: fs.readFileSync('/etc/nginx/ssl/server.key'),
    //cert: fs.readFileSync('/etc/nginx/ssl/bundle.crt'),
    rejectUnauthorized: false,
}, processRequest ).listen(port);

var webSocketServer = new WebSocketServer.Server( { server: app } );
console.log("Сервер запущен на порту " + port);

webSocketServer.on('connection', function(ws) {

  var id = Math.random();
  clients[id] = ws;
  console.log("новое соединение " + id);

  ws.on('message', function(message) {
    console.log('получено сообщение ' + message);

    for(var key in clients) {
      clients[key].send(message);
    }
  });

  ws.on('close', function() {
    console.log('соединение закрыто ' + id);
    delete clients[id];
  });

});