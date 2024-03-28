@extends('layouts.usersLayout.MainLayout')

@section('content')

    <div class="rn-blog-area rn-blog-details-default rn-section-gapTop">
        <div class="container">
            <div class="row g-6">
                <div class="col-xl-8 col-lg-8">
                    <div class="rn-blog-listen">
                        <div class="blog-content-top">
                            <h2 class="title">{{ $blog->title }}</h2>
                            <span class="date">{{ $blog->created_at->format('j M, Y') }}</span>
                        </div>
                        <div class="bd-thumbnail">
                            <div class="large-img mb--30">
                                @if($blog->getFirstMedia('blog_images'))
                                    <img class="w-100" src="{{ $blog->getFirstMedia('blog_images')->getUrl() }}" alt="Blog Image">
                                @else
                                    <img class="w-100" src="{{ asset('path/to/your/default/image.jpg') }}" alt="Default Image">
                                @endif
                            </div>
                        </div>
                        <div class="news-details">
                            {!! $blog->content !!}
                        </div>

                        <div class="comments-wrapper pt--40">
                            <div class="comments-area">
                                <div class="trydo-blog-comment">
                                    <h5 class="comment-title mb--40">{{ $commentCount }} replies on “{{ $blog->title }}”</h5>
                                </div>
                            </div>
                        </div>

                        <ul id="comment-container" class="comment-list">
                            @include('component.single-comment', ['comments' => $comments])
                        </ul>


                        <div class="rn-comment-form pt--60">
                            @include('component.comment-form')
                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 mt_md--40 mt_sm--40">
                    @include('component.side-blog')
                </div>
            </div>
        </div>
    </div>


    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.comment-reply-link').click(function(e) {
                e.preventDefault();
                // Hide all existing subforms
                $('.subform').hide();
                // Show subform related to the clicked "Reply" link
                $(this).closest('.comment').find('.subform').show();
            });

            // Hide subform after submitting reply
            $('.reply-form').submit(function() {
                $(this).closest('.subform').hide();
            });

            // Subscribe to Pusher channel and listen for new comments
            var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                encrypted: true
            });

            var channel = pusher.subscribe('comment-channel');
            channel.bind('new-comment', function(data) {
                // Append new comment to comment container
                $('#comment-container').append(data.comment);
            });
        });
    </script>

@endsection
