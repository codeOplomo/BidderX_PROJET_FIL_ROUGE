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
                            @include('component.single-comment')
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        // Function to fetch updated comments from the server
        function fetchUpdatedComments() {
            $.ajax({
                type: 'GET',
                url: '{{ route('comments.fetch', ['blogId' => $blog->id]) }}',
                success: function(response) {
                    // Replace the entire comments section with the updated comments
                    $('#comment-container').html(response.comments);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log the response from the server
                }
            });
        }

        // Function to fetch updated comments initially and then set up polling
        function initializeRealTimeUpdates() {
            fetchUpdatedComments(); // Fetch comments initially

            // Set up polling to fetch updated comments every 5 seconds (5000 milliseconds)
            setInterval(function() {
                fetchUpdatedComments();
            }, 5000);
        }

        $(document).ready(function() {

            // Initialize real-time updates when the document is ready
            initializeRealTimeUpdates();

            $('#comment-form').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                // Serialize form data
                var formData = $(this).serialize();

                // Send AJAX request
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    success: function(response) {
                        // Replace the entire comments section with the updated comments
                        $('#comment-container').html(response.comments);
                        // Clear the form fields after submission
                        $('#comment-form')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log the response from the server
                    }
                });
            });

            // Event delegation for reply links
            $('#comment-container').on('click', '.comment-reply-link', function(e) {
                e.preventDefault();
                // Hide all existing subforms
                $('.subform').hide();
                // Show subform related to the clicked "Reply" link
                $(this).closest('.comment').find('.subform').show();
            });

            // Event delegation for reply form submission
            $('#comment-container').on('submit', '.reply-form', function(e) {
                e.preventDefault();
                var formData = $(this).serialize(); // Serialize form data
                var actionUrl = $(this).attr('action'); // Get the form action URL

                // Send AJAX request to submit the reply
                $.ajax({
                    type: 'POST',
                    url: actionUrl,
                    data: formData,
                    success: function(response) {
                        // Replace the entire comments section with the updated comments
                        $('#comment-container').html(response.comments);
                        // Clear the form fields after submission
                        $('.reply-form').find('textarea[name="comment"]').val('');
                        // Hide the reply subform
                        $('.subform').hide();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log the response from the server
                    }
                });
            });
        });


    </script>


@endsection
