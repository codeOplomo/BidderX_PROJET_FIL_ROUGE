
$(document).ready(function() {
    console.log("Search script loaded");
    var currentUrl = window.location.pathname;
    var form = $('#search-form');

    function getCsrfToken() {
        return $('meta[name="csrf-token"]').attr('content');
    }

    if (currentUrl.includes("/blogs")) {
        $('#search-form').submit(function(event) {
            console.log("Form submission intercepted");
            event.preventDefault();

            var searchQuery = $('#search-input').val();

            $.ajax({
                url: routes.searchBlogs,
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
        form.attr('action', routes.blogs);

    } else if (currentUrl.includes("/auctions-explore")) {
        $('#search-form').submit(function(event) {
            console.log("Form submission intercepted");
            event.preventDefault();

            var searchQuery = $('#search-input').val();

            $.ajax({
                url: routes.searchAuctions,
                method: 'GET',
                data: {
                    query: searchQuery
                },
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                success: function(response) {
                    if (response.success) {
                        $('#auctions-section').empty(); // Clear previous results

                        response.auctions.forEach(function(auction) {
                            var auctionCardHtml = `
                            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12" style="opacity: unset">
                                <div class="product-style-one no-overlay with-placeBid">
                                    <div class="card-thumbnail">
                                        <a href="/auctions/${auction.id}">
                                            <img src="${auction.product.picture || '/assets/images/default-avatar.png'}" alt="${auction.product.title}">
                                        </a>
                                    </div>
                                    <a href="/auctions/${auction.id}"><span class="product-name">${auction.product.title}</span></a>
                                    <span class="auction-type">${auction.is_instant ? 'Instant Auction' : 'Normal Auction'}</span>
                                    <div class="bid-react-area">
                                        <div class="last-bid">${auction.current_bid_price} $</div>
                                        <div class="react-count-display">${auction.total_reactions}</div>
                                    </div>
                                </div>
                            </div>
                        `;
                            $('#auctions-section').append(auctionCardHtml);
                        });
                    }else {
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
        form.attr('action', routes.auctionsExplore);

    } else if (currentUrl.includes("/creators")) {
        $('#search-form').submit(function(event) {
            console.log("Form submission intercepted");
            event.preventDefault();
            var searchQuery = $('#search-input').val();

            $.ajax({
                url: routes.searchCreators,
                method: 'GET',
                data: {
                    query: searchQuery
                },
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                success: function(response) {
                    if (response.success) {
                        $('#creators-section').empty();

                        $.each(response.creators, function(index, creator) {
                            var creatorCardHtml = `
    <div class="creator-single col-lg-3 col-md-4 col-sm-6" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" style="opacity: unset">
        <a href="/profile/${creator.id}">

            <div class="top-seller-inner-one explore">
                <div class="top-seller-wrapper">
                    <div class="thumbnail verified">
                        <a href="/profile/${creator.id}">
                            <img src="${creator.avatar || 'assets/images/default-avatar.png'}" alt="Nft_Profile">
                        </a>
                    </div>
                    <div class="top-seller-content">
                        <a href="/profile/${creator.id}">
                            <h6 class="name">${creator.firstname} ${creator.lastname}</h6>
                        </a>
                        <span class="count-number">
                            $${creator.total_revenue ? Number(creator.total_revenue).toFixed(2) : '0.00'}
                        </span>
                    </div>
                </div>
                <a class="over-link" href="/profile/${creator.id}"></a>
            </div>

        </a>
    </div>
`;


                            $('#creators-section').append(creatorCardHtml);  // Ensure this ID matches your HTML structure
                        });
                    } else {
                        console.log("No creators found.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching creators: ", error);
                }
            });
        });
    } else {
        $('.search-form-wrapper').hide();
    }
});
