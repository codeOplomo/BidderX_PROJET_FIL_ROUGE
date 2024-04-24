@extends('layouts.usersLayout.MainLayout')

@section('content')

    <style>
        .message-item {
            padding: 5px 10px;
            margin: 5px;
            border-radius: 10px;
        }

        .sender {
            background-color: #DCF8C6;
            text-align: right;
            float: right;
            clear: both;
            color: #231A00;
        }

        .receiver {
            background-color: #f4c89c;
            text-align: left;
            float: left;
            clear: both;
            color: #231A00;
        }

        .chat {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .chat-history {
            overflow-y: auto;
            max-height: 70vh;
            padding: 10px;
        }


        #message-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .message-item {
            padding: 5px 10px;
            margin: 5px 0;
            border-radius: 10px;
            width: fit-content;
            max-width: 80%;
        }

        .chat-message {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 0;
        }

        .input-group {
            width: auto;
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

                            @foreach ($activeUsers as $activeUser)
                                <li data-user-id="{{ $activeUser->id }}" onclick="fetchChatHistory({{ $activeUser->id }})">
                                    <a href="javascript:void(0);" class="col-lg-12 user-item d-flex align-items-center" style="text-decoration: none; color: inherit;">
                                        <img src="{{ asset('assets/images/client/client-1.png') }}" class="chat-thumbnail" alt="avatar">
                                        <div class="chat-about d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0 mr-3">{{ $activeUser->firstname }} {{ $activeUser->lastname }}</h6>
                                            @if ($activeUser->unreadMessagesBySender->sum() > 0)
                                                <span class="badge bg-danger ml-2">{{ $activeUser->unreadMessagesBySender->sum() }}</span>
                                            @endif
                                        </div>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-8">
                <div class="card chat-app d-flex single-community-box">
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-12 d-flex align-items-center justify-content-center gap-4">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="" id="chat-user-image" class="chat-thumbnail" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0" id="chat-user-name">{{ $user ? $user->firstname . ' ' . $user->lastname : 'Select a user to start chatting' }}</h6>
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
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </div>
                                <input id="message-input" name="content" type="text" class="form-control" placeholder="Enter text here...">
                                <button id="send-button" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        var selectedUserId = {{ request('userId') ? request('userId') : 'null' }};
        var loggedInUserId = {{ auth()->id() }};

        function fetchUserDetailsFromServer(userId) {
            $.ajax({
                url: '/get-user-details/' + userId,
                type: 'GET',
                success: function(user) {
                    console.log("Fetched user details:", user);
                    var fullName = user.firstname + ' ' + user.lastname;
                    var imageUrl = user.imageUrl || 'path/to/default/image.jpg';
                    updateUserDetails(fullName, imageUrl);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch user details:', error);
                }
            });
        }

        function updateUserDetails(fullName, imageUrl) {
            console.log("Updating user details:", fullName, imageUrl);
            $('#chat-user-name').text(fullName);
            $('#chat-user-image').attr('src', imageUrl);
        }

        function loadChatHistory(userId, fetchUserDetails = true) {
            $.ajax({
                url: '/fetch-chat-history/' + userId,
                type: 'GET',
                success: function(messages) {
                    const messageList = $('#message-list');
                    messageList.empty();
                    messages.forEach(function(message) {
                        var messageClass = message.sender_id == loggedInUserId ? 'sender' : 'receiver';
                        var messageElement = `<li class='message-item ${messageClass}'>${message.content}</li>`;
                        messageList.append(messageElement);
                    });
                    $('.chat-history').css('display', 'block');
                    if (fetchUserDetails) {
                        fetchUserDetailsFromServer(userId);
                    }
                    markMessagesAsRead(userId);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch chat history:', error);
                }
            });
        }

        function markMessagesAsRead(userId) {
            $.ajax({
                url: '/mark-messages-as-read/' + userId,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log('Messages marked as read');
                },
                error: function(xhr, status, error) {
                    console.error('Failed to mark messages as read:', error);
                }
            });
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (selectedUserId) {
                loadChatHistory(selectedUserId, true);
            }

            var refreshInterval;
            var chatUpdateRate = 3000; // Refresh rate in milliseconds

            function startRefreshChat(userId) {
                if (refreshInterval) clearInterval(refreshInterval);
                refreshInterval = setInterval(function() {
                    loadChatHistory(userId);
                }, chatUpdateRate);
            }

            $('#message-input').on('focus', function() {
                clearInterval(refreshInterval);
            });

            $('#message-input').on('blur', function() {
                var userId = $('#online-users-list li.active').data('user-id') || selectedUserId;
                if (userId) {
                    startRefreshChat(userId);
                }
            });

            $('#online-users-list').on('click', 'li', function() {
                var userId = $(this).data('user-id');
                loadChatHistory(userId, true); // Fetch chat history and user details
                $('#online-users-list li').removeClass('active'); // Remove active class from all
                $(this).addClass('active'); // Add active class to clicked user
                startRefreshChat(userId);
            });

            $('#send-button').click(function() {
                var messageContent = $('#message-input').val();
                var userId = $('#online-users-list li.active').data('user-id') || selectedUserId;

                if (messageContent.trim() !== '') {
                    $.ajax({
                        url: '{{ route("messages.send") }}',
                        type: 'POST',
                        data: {
                            receiver_id: userId,
                            content: messageContent
                        },
                        success: function(response) {
                            var messageElement = `<li class='message-item sender'>${response.data.content}</li>`;
                            $('#message-list').append(messageElement);
                            $('#message-input').val('');
                            loadChatHistory(userId); // Refresh chat history immediately after sending a message
                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending message:', error);
                        }
                    });
                }
            });
        });
    </script>




    {{--<script src="//cdn.jsdelivr.net/npm/laravel-echo/dist/echo.js"></script>
    <script>
        window.authUserId = @json(auth()->user()->id);
        window.routes = {
            sendMessage: '{{ route("messages.send") }}', // Assuming you have a route named send.message
            fetchChatHistory: '{{ route("fetch.chat.history", ["userId" => "REPLACE"]) }}'
        };
    </script>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    @vite('resources/js/chat.js')
--}}
@endsection
