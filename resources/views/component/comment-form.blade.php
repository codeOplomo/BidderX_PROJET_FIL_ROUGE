<div class="inner">
    <div class="section-title">
        <span class="subtitle">Have a Comment?</span>
        <h2 class="title">Leave a Reply</h2>
    </div>
    <form id="comment-form" class="mt--40">
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
                    <button id="submit-comment" type="button" class="btn btn-primary-alta btn-large w-100">
                        <span>SEND COMMENT</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Ensure jQuery is loaded before your custom script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Your custom JavaScript code -->
<script>
    $(document).ready(function() {
        // Verify click event binding
        console.log('Document is ready. Click event bound.');

        // Submit comment form using AJAX
        $('#submit-comment').click(function(event) {
            event.preventDefault();
            console.log('Submitting comment form...');

            // Log serialized form data
            var formData = $('#comment-form').serialize();
            console.log('Form data:', formData);

            // Add CSRF token to the request headers
            var csrfToken = '{{ csrf_token() }}';

            $.ajax({
                type: 'POST',
                url: "{{ route('comments.store') }}",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    console.log('AJAX request successful:', response);
                    // Clear textarea after successful submission
                    $('textarea[name="comment"]').val('');

                    // Append the new comment or reply to the comment container
                    if (response.comment) {
                        $('#comment-container').append(response.comment);
                    }
                    if (response.reply) {
                        $('#comment-' + response.reply.parent_id + ' .children').append(response.reply);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request error:', xhr.responseText);
                }
            });
        });
    });
</script>


