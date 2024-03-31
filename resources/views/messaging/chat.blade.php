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
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            <!-- Replace the content of this list with your dynamic content -->
                            <li class="clearfix">
                                <img src="{{ asset('assets/images/client/client-1.png') }}" class="chat-thumbnail" alt="avatar">
                                <div class="about">
                                    <div class="name">Vincent Porter</div>
                                    <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>
                                </div>
                            </li>
                            <!-- Add more list items as needed -->
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
                            <ul class="m-b-0">
                                <li class="clearfix">
                                    <div class="message-data text-right d-flex">
                                        <span class="message-data-time">10:10 AM, Today</span>

                                            <img src="{{ asset('assets/images/client/client-7.png') }}" class="chat-thumbnail" alt="avatar">
                                    </div>
                                    <div class="message other-message float-right bg-color--2"> Hi Aiden, how are you? How is the project coming along? </div>
                                </li>
                                <li class="clearfix">
                                    <div class="message-data text-left d-flex">
                                        <span class="message-data-time">10:10 AM, Today</span>
                                        <img src="{{ asset('assets/images/client/client-7.png') }}" class="chat-thumbnail" alt="avatar">
                                    </div>
                                    <div class="message other-message float-right bg-color--4"> Hi Aiden, how are you? How is the project coming along? </div>
                                </li>
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0 col-lg-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </div>
                                <input type="text" class="form-control col-lg-12" placeholder="Enter text here...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
