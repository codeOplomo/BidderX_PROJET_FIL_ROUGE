
$(document).ready(function() {
    var currentUrl = window.location.pathname;

    function getCsrfToken() {
        return $('meta[name="csrf-token"]').attr('content');
    }

    if (currentUrl.includes("/blogs")) {
        $('#search-form').submit(function(event) {
            event.preventDefault();

            var searchQuery = $('#search-input').val();

            $.ajax({
                url: "{{ route('search.blogs.sp') }}",
                method: 'GET',
                data: {
                    query: searchQuery
                },
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                success: function(response) {
                    if (response.success) {
                        $('#blog-posts').empty();

                        $.each(response.blogPosts, function(index, blogPost) {
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

                            // Append the blog card HTML to the search results container
                            $('#blog-posts').append(blogCardHtml);
                        });
                    } else {
                        // Handle unsuccessful search (optional)
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    } else if (currentUrl.includes("/blog")) {
        var searchUrl;
        searchUrl = "{{ route('blogs') }}";
        $('#search-form').attr('action', searchUrl);

    } else if (currentUrl.includes("/auctions-explore")) {
        $('#search-form').submit(function(event) {
            event.preventDefault();

            var searchQuery = $('#search-input').val();

            $.ajax({
                url: "{{ route('search.auctions.sp') }}",
                method: 'GET',
                data: {
                    query: searchQuery
                },
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                success: function(response) {
                    if (response.success) {
                        $('#auctions-section').empty();

                        $.each(response.auctions, function(index, auction) {
                            var auctionCardHtml = `
                <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12" style="opacity: unset">
                    <div class="product-style-one no-overlay with-placeBid">
                        <div class="card-thumbnail">
                            <a href="{{ route('product.details', $auction->id) }}"><img src="${auction.product_picture}" alt="NFT_portfolio"></a>
                        </div>
                        <a href="{{ route('product.details', $auction->id) }}"><span class="product-name">${auction.title}</span></a>
                        <span class="auction-type"></span>
                        <span class="auction-type">
                            ${auction.winner_id ? `Owned by ${auction.winner_firstname} ${auction.winner_lastname}` : auction.is_instant ? 'Instant Auction' : 'Normal Auction'}
                        </span>
                        <div class="bid-react-area">
                            <div class="last-bid">${auction.current_bid_price} $</div>
                            <div class="react-count-display">
                                ${auction.total_reactions}
                            </div>
                        </div>
                    </div>
                </div>
            `;

                            $('#auctions-section').append(auctionCardHtml);
                        });
                    } else {
                        // Handle unsuccessful search (optional)
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                }
            });
        });
    } else if (currentUrl.includes("auction")) {
        var searchUrl;
        searchUrl = "{{ route('auctionsExplore') }}";
        $('#search-form').attr('action', searchUrl);

    } else {
        $('.search-form-wrapper').hide();
    }
});
