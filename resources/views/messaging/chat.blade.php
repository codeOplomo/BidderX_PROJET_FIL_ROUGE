@extends('layouts.usersLayout.MainLayout')

@section('content')

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
                                <li data-user-id="{{ $user->id }}">
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
                                        <h6 class="m-b-0" id="chat-user-name">Select a user to start chatting</h6>
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



    <script src="//cdn.jsdelivr.net/npm/laravel-echo/dist/echo.js"></script>
    <script>
        window.authUserId = @json(auth()->user()->id);
        window.routes = {
            sendMessage: '{{ route("messages.send") }}', // Assuming you have a route named send.message
            fetchChatHistory: '{{ route("fetch.chat.history", ["userId" => "REPLACE"]) }}'
        };
    </script>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    @vite('resources/js/chat.js')


@endsection
