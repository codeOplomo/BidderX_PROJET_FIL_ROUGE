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
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 mt_md--40 mt_sm--40">
                    @include('component.side-blog')
                </div>
            </div>
        </div>
    </div>

@endsection
