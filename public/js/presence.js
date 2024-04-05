import Echo from 'laravel-echo';

// Import Pusher if you haven't done it in your bootstrap.js file
// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// Initialize Echo
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.PUSHER_APP_KEY,
    cluster: process.env.PUSHER_APP_CLUSTER ?? 'eu',
    wsHost: process.env.PUSHER_HOST ?? `ws-${process.env.PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: process.env.PUSHER_PORT ?? 6001,
});

// Add your Echo code for presence channel here
// Ensure to replace `userId` with the actual user ID
window.Echo.join(`presence-user-presence.${userId}`)
    .here((users) => {
        console.log('Initial list of online users:', users);
    })
    .joining((user) => {
        console.log('User joined:', user);
    })
    .leaving((user) => {
        console.log('User left:', user);
    });


