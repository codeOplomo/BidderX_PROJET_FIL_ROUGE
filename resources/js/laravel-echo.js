import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.PUSHER_APP_KEY,
    cluster: process.env.PUSHER_APP_CLUSTER ?? 'eu',
    encrypted: false,
    //wsHost: process.env.PUSHER_HOST ?? `ws-${process.env.PUSHER_APP_CLUSTER}.pusher.com`,
    //wsPort: process.env.PUSHER_PORT ?? 6001,
    //wssPort: process.env.PUSHER_PORT ?? 6001,
});

export default Echo;
