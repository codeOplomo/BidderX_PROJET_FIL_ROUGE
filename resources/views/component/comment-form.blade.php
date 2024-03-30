<div class="inner">
    <div class="section-title">
        <span class="subtitle">Have a Comment?</span>
        <h2 class="title">Leave a Reply</h2>
    </div>
    <form id="comment-form" class="mt--40" action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="blog_post_id" value="{{ $blog->id }}">
        <input type="hidden" name="parent_id" value="{{ $parentCommentId ?? null }}">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="rnform-group">
                    <textarea name="comment" placeholder="Comment"></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="blog-btn">
                    <button id="submit-comment" class="btn btn-primary-alta btn-large w-100">
                        <span>SEND COMMENT</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>



