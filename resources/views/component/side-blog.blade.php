<aside class="rwt-sidebar">

    <div class="rbt-single-widget widget_categories">
        <h3 class="title">Categories</h3>
        <div class="inner">
            <ul class="category-list">
                @foreach($categories as $category)
                    <li><a href="#" class="category-link" data-category="{{ $category->id }}"><span class="left-content">{{ $category->name }}</span><span class="count-text">({{ $category->blogPosts->count() }})</span></a></li>
                @endforeach
            </ul>
        </div>
    </div>


    <div class="rbt-single-widget widget_recent_entries mt--40">
        <h3 class="title">Recent Posts</h3>
        <div class="inner">
            <ul>
                @foreach($recentBlogPosts as $blog)
                    <li>
                        <a class="d-block" href="{{ route('blog.details', $blog->id) }}">
                            {{ $blog->title }}
                        </a>
                        <span class="cate">{{ $blog->category->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>


    <div class="rbt-single-widget widget_tag_cloud mt--40">
        <h3 class="title">Tags</h3>
        <div class="inner mt--20">
            <div class="tagcloud">
                @foreach($tags as $tag)
                    <a href="#" class="tag-link" data-tag="{{ $tag->name }}">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
    </div>

</aside>
