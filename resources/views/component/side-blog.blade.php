<aside class="rwt-sidebar">

    <div class="rbt-single-widget widget_categories">
        <h3 class="title">Categories</h3>
        <div class="inner">
            <ul class="category-list">
                @foreach($categories as $category)
                    <li><a href="#"><span class="left-content">{{ $category->name }}</span><span class="count-text"></span></a></li>
                @endforeach
            </ul>
        </div>
    </div>


    <div class="rbt-single-widget widget_recent_entries mt--40">
        <h3 class="title">Recent Posts</h3>
        <div class="inner">
            <ul>
                <li><a class="d-block" href="#">Best Corporate Tips You Will
                        Read This Year.</a><span class="cate">Music NFT's</span></li>
                <li><a class="d-block" href="#">Should Fixing Corporate Take
                        100 Steps.</a><span class="cate">Digital Arts</span></li>
                <li><a class="d-block" href="#">The Next 100 Things To
                        Immediately Do About.</a><span class="cate">NFT Creators</span></li>
                <li><a class="d-block" href="#">Top 5 Lessons About
                        Corporate
                        To Learn Before.</a><span class="cate">Rare Products</span></li>
            </ul>
        </div>
    </div>


    <div class="rbt-single-widget widget_tag_cloud mt--40">
        <h3 class="title">Tags</h3>
        <div class="inner mt--20">
            <div class="tagcloud">
                @foreach($tags as $tag)
                    <a href="#">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
    </div>

</aside>
