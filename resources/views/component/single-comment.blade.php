<ul class="comment-list">
    @foreach($comments as $comment)
        {{-- Check if the comment is not a reply (i.e., it has no parent) --}}
        @if(is_null($comment->parent_id))
            <div id="comment-{{ $comment->id }}" class="comment-container"> <!-- Unique identifier for each comment -->
                <li class="comment parent" data-comment-id="{{ $comment->id }}">
                    <div class="single-comment">
                        <div class="comment-author comment-img">
                            <img class="comment-avatar" src="{{ $comment->user->getFirstMediaUrl("product_picture") ?: asset('assets/images/client/client-1.png') }}" alt="Comment Image">
                            <div class="m-b-20">
                                <div class="commenter">{{ $comment->user->firstname }} {{ $comment->user->lasttname }}</div>
                                <div class="time-spent">{{ $comment->created_at->format('F d, Y \a\t h:i a') }}</div>
                            </div>
                        </div>
                        <div class="comment-text">
                            <p>{{ $comment->comment }}</p>
                        </div>
                        <div class="reply-edit">
                            <div class="reply">
                                <a class="comment-reply-link" href="#">
                                    <i class="rbt feather-corner-down-right"></i>
                                    Reply
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Subform for replying -->
                    <div class="subform" style="display: none;">
                        <form class="reply-form" action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="blog_post_id" value="{{ $blog->id }}">
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <input type="hidden" name="reply_flag" value="1"> <!-- Hidden input for indicating it's a reply -->
                            <div class="rnform-group">
                                <textarea name="comment" placeholder="Your reply..."></textarea>
                            </div>
                            <div class="rnform-group">
                                <button type="submit">Reply</button>
                            </div>
                        </form>
                    </div>
                    <!-- End Subform -->

                    <!-- Check if the comment has children (replies) -->
                    @if($comment->children->isNotEmpty())
                        <ul class="children">
                            @foreach($comment->children as $child)
                                <li class="comment byuser">
                                    <div class="single-comment">
                                        <div class="comment-author comment-img">
                                            <img class="comment-avatar"  src="{{ $child->user->getFirstMediaUrl("product_picture") ?: asset('assets/images/client/client-1.png') }}" alt="Comment Image">
                                            <div class="m-b-20">
                                                <div class="commenter">{{ $child->user->firstname }} {{ $child->user->lasttname }}</div>
                                                <div class="time-spent">{{ $child->created_at->format('F d, Y \a\t h:i a') }}</div>
                                            </div>
                                        </div>
                                        <div class="comment-text">
                                            <p>{{ $child->comment }}</p>
                                        </div>
                                        <div class="reply-edit">
                                            <div class="reply">
                                                <a class="comment-reply-link" href="#">
                                                    <i class="rbt feather-corner-down-right"></i>
                                                    Reply
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <!-- End Check -->
                </li>
            </div>
        @endif
    @endforeach
</ul>

