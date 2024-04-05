import { createServer } from 'http';
import { Server } from 'socket.io';
import Redis from 'ioredis';

const server = createServer();
const io = new Server(server);
const redis = new Redis();

redis.subscribe('chat-channel', function (err, count) {
    // Handle subscription
});

redis.on('message', function (channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

server.listen(3000);
