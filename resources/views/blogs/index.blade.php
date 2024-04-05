@extends('layouts.usersLayout.MainLayout')

@section('content')

    <div class="rn-blog-area rn-blog-details-default rn-section-gapTop">
        <div class="container">
            <div class="row g-5 flex-wrap">
                <!-- start single blog -->
                <div class="col-xl-8 col-lg-8" id="blog-posts">
                    @foreach($blogPosts as $blog)
                        @include('component.blog-card')
                    @endforeach
                </div>
                <!-- end single blog -->
                <div class="col-xl-4 col-lg-4 mt_md--40 mt_sm--40">
                    @include('component.side-blog')
                </div>

                <!-- navigation Pagination -->
                <div class="row">
                    <div class="col-lg-8" data-sal="slide-up" data-sal-delay="550" data-sal-duration="800">
                        <nav class="pagination-wrapper" aria-label="Page navigation example">
                            <ul class="pagination single-column-blog">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- navigation Pagination End-->
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        function formatTimeDiff(time) {
            const now = new Date();
            const diff = Math.abs(now - new Date(time));

            const minutes = Math.floor(diff / 60000);

            if (minutes < 60) {
                return `${minutes} minutes ago`;
            } else if (minutes < 1440) {
                return `${Math.floor(minutes / 60)} hour ago`;
            } else {
                return `${Math.floor(minutes / 1440)} day ago`;
            }
        }


        $(document).ready(function() {
            $('.tag-link').click(function(e) {
                e.preventDefault();
                var tag = $(this).data('tag');
                $.get('{{ route("blogs.by.tag", ["tag" => ":tag"]) }}'.replace(':tag', tag), function(data) {
                    updateBlogPosts(data.blogPosts);
                });
            });

            $('.category-link').click(function(e) {
                e.preventDefault();
                var category = $(this).data('category');
                $.get('{{ route("blogs.by.category", ["category" => ":category"]) }}'.replace(':category', category), function(data) {
                    updateBlogPosts(data.blogPosts);
                });
            });

            function updateBlogPosts(blogPosts) {
                $('#blog-posts').empty();

                $.each(blogPosts, function(index, blogPost) {
                    var formattedTimeDiff = formatTimeDiff(blogPost.created_at);

                    var blogCardHtml = `
            <div class="rn-blog single-column mb--30" data-toggle="modal" data-target="#exampleModalCenters" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" style="opacity: unset;">
                <div class="inner">
                    <div class="thumbnail">
                        <a href="/blog/${blogPost.id}">
                            <img src="${blogPost.image}">
                        </a>
                    </div>
                    <div class="content">
                        <div class="category-info">
                            <div class="category-list">
                                <a href="/blog/${blogPost.id}">${blogPost.category}</a>
                            </div>
                            <div class="meta">
                                <span><i class="feather-clock"></i> ${formattedTimeDiff} </span>
                            </div>
                        </div>
                        <h4 class="title"><a href="/blog/${blogPost.id}">${blogPost.title} <i class="feather-arrow-up-right"></i></a></h4>
                    </div>
                </div>
            </div>
        `;
                    $('#blog-posts').append(blogCardHtml);
                });
            }


        });

    </script>
@endsection
