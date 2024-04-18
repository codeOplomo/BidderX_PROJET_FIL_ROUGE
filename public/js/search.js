
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
                data: { query: searchQuery },
                headers: { 'X-CSRF-TOKEN': getCsrfToken() },
                success: function(response) {
                    console.log("Response received:", response);  // Debug: log the entire response
                    if (response.success && response.auctions.length > 0) {
                        $('#auctions-section').empty();
                        response.auctions.forEach(function(auction) {
                            var reactAreaHtml = auction.canReact ?
                                `<div class="react-count-display">
                        <i class="feather-heart"></i> <span>${auction.total_reactions}</span>
                    </div>` :
                                 `<div class="react-area" onclick="toggleReaction(${auction.id}, this)">
<svg viewBox="0 0 17 16" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN kBvkOu">
    <path d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z" stroke="currentColor" stroke-width="2"></path>
</svg>
<span class="number" id="reactCount- ${auction.id} ">${auction.total_reactions}</span>
                    </div>`;

                            var bidsHtml = auction.bids.map(bid => `
                    <a href="#" class="avatar" data-tooltip="${bid.user.firstname} ${bid.user.lastname}">
                        <img src="${bid.user.profile_image || '/assets/images/client/client-1.png'}" alt="Profile Image">
                    </a>
                `).join('');

                            var auctionTypeText = auction.winner_id ? `Owned by ${auction.winner.firstname} ${auction.winner.lastname}` :
                                auction.is_instant ? 'Instant Auction' : 'Normal Auction';

                            var auctionCardHtml = `
                    <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12" style="opacity: unset">
                        <div class="product-style-one no-overlay with-placeBid">
                            <div class="card-thumbnail">
                                <a href="/auctions/${auction.id}">
                                    <img src="${auction.product.picture || '/assets/images/default-avatar.png'}" alt="${auction.product.title}">
                                </a>
                            </div>
                            <div class="product-share-wrapper">
                                <div class="profile-share">${bidsHtml}</div>
                                <div class="share-btn share-btn-activation dropdown">
                                    <button class="icon" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="feather-more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Share</a>
                                        <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-details">
                                <a href="/auctions/${auction.id}">
                                    <span class="product-name">${auction.product.title}</span>
                                </a>
                                <span class="auction-type">${auctionTypeText}</span>
                                <div class="bid-react-area">
                                       <div class="last-bid">${auction.current_bid_price} $</div>
                                       ${reactAreaHtml}
                                </div>
                            </div>
                        </div>
                    </div>`;
                            $('#auctions-section').append(auctionCardHtml);
                        });
                    } else {
                        $('#auctions-section').html(`<div class="col-12 text-center"><p>No auctions found or ${response.message}</p></div>`);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error during AJAX request:', status, error);
                    $('#auctions-section').html(`<div class="col-12 text-center"><p>Error fetching data</p></div>`);
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
