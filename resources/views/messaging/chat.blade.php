@extends('layouts.usersLayout.MainLayout')

@section('content')
    <style>
        .chat-thumbnail {
            border-radius: 100%; max-height: 60px; object-fit: cover; max-width: 100%; height: auto;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card chat-app d-flex single-community-box">
                    <!-- Update the people list with online users -->
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0" id="online-users-list">
                            <!-- Online users will be dynamically added here -->
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-8">
                <div class="card chat-app d-flex single-community-box">
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-12 d-flex">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="{{ asset('assets/images/client/client-1.png') }}" class="chat-thumbnail" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0">Aiden Chavez</h6>
                                        <small>Last seen: 2 hours ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul id="message-list" class="m-b-0">
                                <!-- Messages will be dynamically added here -->
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0 col-lg-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </div>
                                <input id="message-input" type="text" class="form-control col-lg-12" placeholder="Enter text here...">
                                <button id="send-button" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>


        // Initialize Pusher with your app credentials
        const pusher = new Pusher("fcb85a97aa567efe9b80", {
            cluster: "eu",
            encrypted: true
        });



        // Bind to the "new-message" event
        const channel = pusher.subscribe('bidder-chat');
        channel.bind('new-message', function(data) {
            // Data contains the new message
            console.log(data);

            // Append the new message to the message list
            appendMessage(data);
        });

        // Function to send messages
        function sendMessage() {
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value.trim();
            if (message !== '') {
                // Send the message to the server via AJAX
                fetch('{{ route('messages.send') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token if you're using Laravel CSRF protection
                    },
                    body: JSON.stringify({ content: message }) // Send message content in JSON format
                })
                    .then(response => {
                        if (response.ok) {
                            // Message sent successfully, clear the input field
                            messageInput.value = '';
                        } else {
                            // Handle error if message sending fails
                            console.error('Failed to send message');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

            }
        }

        // Append a new message to the message list
        function appendMessage(message) {
            const messageList = document.getElementById('message-list');
            const listItem = document.createElement('li');
            listItem.innerHTML = `
            <div class="message-data text-left d-flex">
                <span class="message-data-time">${message.created_at}</span>
                <img src="${message.sender.avatar}" class="chat-thumbnail" alt="avatar">
            </div>
            <div class="message other-message float-right bg-color--2">${message.content}</div>
        `;
            messageList.appendChild(listItem);
        }

        // Send message when the Send button is clicked
        document.getElementById('send-button').addEventListener('click', sendMessage);

        // Send message when Enter key is pressed
        document.getElementById('message-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>


@endsection
