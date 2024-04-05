import Echo from './laravel-echo';

const userId = getUserId(); // Define your function to get the user ID here
console.log(userId);
// Presence channel logic
Echo.join(`presence-user-presence.${userId}`)
    .here((users) => {
        console.log('Initial list of online users:', users);
    })
    .joining((user) => {
        console.log('User joined:', user);
    })
    .leaving((user) => {
        console.log('User left:', user);
    });

function getUserId() {
    // Define your function to get the user ID here
    return 1;
}

