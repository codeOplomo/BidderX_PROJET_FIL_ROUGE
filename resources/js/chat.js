import Echo from "laravel-echo";
import io from 'socket.io-client';

window.io = io;

// Now we can initialize Echo with Socket.io
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

var authUserId = window.authUserId;
let currentReceiverId = null;
document.addEventListener('DOMContentLoaded', function () {
    initializeChat();
});

function initializeChat() {
    setupSendMessageListener();
    listenForIncomingMessages();
    attachUserItemClickListeners();
}

function setupSendMessageListener() {
    const sendButton = document.getElementById('send-button');
    const messageInput = document.getElementById('message-input');

    sendButton.addEventListener('click', sendMessage);
    messageInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault(); // To prevent form submission
            sendMessage();
        }
    });
}

function setupChatListeners() {
    if(currentReceiverId) {
        // Listen for messages sent to the receiver
        window.Echo.private(`chat.${currentReceiverId}`)
            .listen('MessageSent', (e) => {
                console.log("Message received from receiver", e.message);
                appendMessage(e.message, false); // Incoming message
            });
    }

    // Always listen for messages sent to the authenticated user
    window.Echo.private(`chat.${authUserId}`)
        .listen('MessageSent', (e) => {
            console.log("Message received for auth user", e.message);
            if(e.message.sender_id !== authUserId) { // Ensure not to duplicate for sender
                appendMessage(e.message, true); // Incoming message
            }
        });
}

function sendMessage() {
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value.trim();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    console.log('tesr1')
    if (!message || currentReceiverId === null) return;

    console.log('tesr2')
    fetch(window.routes.sendMessage, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ content: message, receiver_id: currentReceiverId })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
    then(data => {
        if (data.message === 'Message sent successfully!') {
            appendMessage(data.data, true); // true to indicate this user is the sender
            messageInput.value = ''; // Clear input after sending
        } else {
            console.error('Failed to send message');
        }
    })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });

}

function listenForIncomingMessages() {
    window.Echo.private(`chat.${authUserId}`)
        .listen('MessageSent', (e) => {
            console.log('Incoming message:', e.message);
            // Assuming the incoming message structure has a sender_id and matches the current chat
            if (e.message.receiver_id === currentReceiverId || e.message.sender_id === currentReceiverId) {
                appendMessage(e.message, e.message.sender_id === authUserId);
            }
        });
}

function appendMessage(message, isSender) {
    const messageList = document.getElementById('message-list');
    const listItem = document.createElement('li');
    listItem.innerHTML = `<div class="${isSender ? 'sent' : 'received'}">
        <span>${message.content}</span>
        <div class="metadata">${message.created_at}, ${isSender ? 'You' : 'Them'}</div>
    </div>`;
    messageList.appendChild(listItem);
    //messageList.scrollTop = messageList.scrollHeight;
    document.querySelector('.chat-history').style.display = 'block';
}
function loadChat(receiverId) {
    currentReceiverId = receiverId;
    fetchChatHistory(receiverId);
}

function fetchChatHistory(receiverId) {
    const fetchChatHistoryUrl = window.routes.fetchChatHistory.replace('REPLACE', receiverId);
    fetch(fetchChatHistoryUrl, { // Update the URL pattern as needed
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Adjusted for better security practices
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            // Assuming `data` includes `messages` and `user` details
            displayChat(data.messages);

            // Update chat header with user info
            const user = data.user;
            document.getElementById('chat-user-name').textContent = user.firstname + ' ' + user.lastname;
            document.getElementById('chat-user-image').src = user.imagePath; // Ensure you have a valid image path

            // Show the chat history
            document.querySelector('.chat-history').style.display = 'block';
        })
        .catch(error => console.error('Error fetching chat history:', error));
}

function displayChat(messages) {
    const messageList = document.getElementById('message-list');
    messageList.innerHTML = ''; // Clear existing messages

    messages.forEach(message => {
        const isSender = message.sender_id === authUserId; // Compare message sender ID with authenticated user ID

        // Create list item
        const listItem = document.createElement('li');
        listItem.classList.add('message-item', isSender ? 'sender' : 'receiver');

        // Create message text container
        const messageContent = document.createElement('div');
        messageContent.classList.add('message-content');
        messageContent.textContent = message.content;

        // Style differently based on sender or receiver
        if (isSender) {
            messageContent.style.backgroundColor = '#007bff'; // Example: blue for sender
            messageContent.style.color = 'white';
            messageContent.style.textAlign = 'right';
            listItem.style.justifyContent = 'flex-end'; // Align sender messages to the right
        } else {
            messageContent.style.backgroundColor = '#f1f0f0'; // Example: light gray for receiver
            messageContent.style.color = 'black';
            messageContent.style.textAlign = 'left';
            listItem.style.justifyContent = 'flex-start'; // Align receiver messages to the left
        }

        listItem.appendChild(messageContent);
        messageList.appendChild(listItem);
    });
}

// Attaching click listeners to each user item to initiate chat
function attachUserItemClickListeners() {
    const userItems = document.querySelectorAll('#online-users-list li');
    userItems.forEach(item => {
        item.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            currentReceiverId = userId;
            console.log(`Loading chat with user ${userId}`);
            loadChat(userId); // Direct call to load chat and history.
        });
    });
}


