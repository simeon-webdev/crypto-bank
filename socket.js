var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();
var cron = require('node-cron');
var shell = require('shelljs');

redis.subscribe('account', function(err, count) {});
redis.subscribe('accrual', function(err, count) {});
redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

cron.schedule('*\15 * * * *', function(){
    shell.exec('php artisan accrual:daily');
});

http.listen(3000, function(){
    console.log('Listening on Port 3000');
});
