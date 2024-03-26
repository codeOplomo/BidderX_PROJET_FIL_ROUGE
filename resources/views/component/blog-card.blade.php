<div class="rn-blog single-column mb--30" data-toggle="modal" data-target="#exampleModalCenters" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
    <div class="inner">
        <div class="thumbnail">
            <a href="{{ route('blog.details', $blog->id) }}">
                <img src="{{$blog->getFirstMediaUrl("blog_images")}}">
            </a>
        </div>
        <div class="content">
            <div class="category-info">
                <div class="category-list">
                    <a href="{{ route('blog.details', $blog->id) }}">{{ $blog->category->name }}</a>
                </div>
                <div class="meta">
                    <span><i class="feather-clock"></i> {{ $blog->created_at->diffInMinutes(now()) }} min read</span>
                </div>
            </div>
            <h4 class="title"><a href="{{ route('blog.details', $blog->id) }}">{{ $blog->title }} <i class="feather-arrow-up-right"></i></a></h4>
        </div>
    </div>
</div>

