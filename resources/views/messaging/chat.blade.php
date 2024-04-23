@extends('layouts.usersLayout.MainLayout')

@section('content')

    <style>
        .message-item {
            padding: 5px 10px;
            margin: 5px;
            border-radius: 10px;
        }

        .sender {
            background-color: #DCF8C6; /* Light green for sender */
            text-align: right;
            float: right;
            clear: both;
        }

        .receiver {
            background-color: #ECECEC; /* Light grey for receiver */
            text-align: left;
            float: left;
            clear: both;
        }

        .chat {
            display: flex;
            flex-direction: column;
            height: 100%; /* Adjust based on your layout requirements */
        }

        .chat-history {
            overflow-y: auto;
            flex-grow: 1; /* Makes the chat history take up all available space */
            padding: 10px;
            margin-bottom: 10px; /* Space between history and message input */
        }

        .chat-message {
            width: 100%;
        }

        .input-group {
            width: 100%;
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
                            @foreach ($activeUsers as $user)
                                <li data-user-id="{{ $user->id }}" onclick="fetchChatHistory({{ $user->id }})">
                                    <a href="javascript:void(0);" class="col-lg-12 user-item d-flex align-items-center" style="text-decoration: none; color: inherit;">
                                        <img src="{{ asset('assets/images/client/client-1.png') }}" class="chat-thumbnail" alt="avatar">
                                        <div class="chat-about">
                                            <h6 class="m-b-0">{{ $user->firstname }} {{ $user->lastname }}</h6>
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
                                <div class="col-lg-12 d-flex">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="" id="chat-user-image" class="chat-thumbnail" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        {{--<h6 class="m-b-0" id="chat-user-name">Select a user to start chatting</h6>--}}
                                        <h6 class="m-b-0" id="chat-user-name">{{ $user->firstname }} {{ $user->lastname }}</h6>
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
                                <input id="message-input" name="content" type="text" class="form-control col-lg-12" placeholder="Enter text here...">
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
        var loggedInUserId = {{ auth()->id() }};
    </script>

    <script>
        function fetchUserDetailsFromServer(userId) {
            $.ajax({
                url: '/get-user-details/' + userId,
                type: 'GET',
                success: function(user) {
                    console.log("Fetched user details:", user);
                    var fullName = user.firstname + ' ' + user.lastname; // Concatenate firstname and lastname
                    var imageUrl = user.imageUrl || 'path/to/default/image.jpg'; // Provide a default or check for imageUrl
                    updateUserDetails(fullName, imageUrl);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch user details:', error);
                }
            });
        }

        function updateUserDetails(fullName, imageUrl = 'path/to/default/image.jpg') {
            console.log("Updating user details:", fullName, imageUrl);  // Log to confirm update attempt
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
console.log(fetchUserDetails);
                    if (fetchUserDetails) {
                        fetchUserDetailsFromServer(userId);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch chat history:', error);
                }
            });
        }




        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#online-users-list').on('click', 'li', function() {
                $('#online-users-list li').removeClass('active'); // Remove active class from all users
                $(this).addClass('active'); // Add active class to the clicked user
                var selectedUserId = $(this).data('user-id');
                loadChatHistory(selectedUserId, true); // Also fetch user details
            });


            $('#send-button').click(function() {
                var messageContent = $('#message-input').val();
                var userId = $('#online-users-list li.active').data('user-id') || '{{ $user->id }}'; // Get active user or default

                if (messageContent.trim() !== '') {
                    $.ajax({
                        url: '{{ route("messages.send") }}',
                        type: 'POST',
                        data: {
                            receiver_id: userId,
                            content: messageContent
                        },
                        success: function(response) {
                            console.log('Message sent:', response.data.content);
                            var messageElement = `<li class='message-item sender'>${response.data.content}</li>`;
                            $('#message-list').append(messageElement);
                            $('#message-input').val(''); // Clear the input field after sending
                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending message:', xhr.responseJSON.error);
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
