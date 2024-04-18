@extends('layouts.usersLayout.MainLayout')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Start product area -->
<div class="rn-product-area rn-section-gapTop">
    <div class="container">
        <div class="row mb--50 align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Explore Product</h3>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--15">
                <div class="view-more-btn text-start text-sm-end" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <button class="discover-filter-button discover-filter-activation btn btn-primary">Filter<i class="feather-filter"></i></button>
                </div>
            </div>
        </div>

        <div class="default-exp-wrapper default-exp-expand">
            <div class="inner">
                <div class="filter-select-option">
                    <label class="filter-leble">LIKES</label>
                    <select name="likes">
                        <option data-display="Most liked" value="0">Most liked</option>
                        <option value="1">Least liked</option>
                    </select>
                </div>

                <div class="filter-select-option">
                    <label class="filter-label">CATEGORY</label>
                    <select name="category">
                        <option data-display="Category">Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-select-option">
                    <label class="filter-label">COLLECTIONS</label>
                    <select name="collection">
                        <option data-display="Select Collection">Select Collection</option>
                        @foreach($collections as $collection)
                            <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-select-option">
                    <label class="filter-leble">Sale type</label>
                    <select name="saleType">
                        <option data-display="Sale type">Sale type</option>
                        <option value="0">Timed auctions</option>
                        <option value="1">Fixed price</option>
                        <option value="4">Ended auctions</option>
                    </select>
                </div>

                <div class="filter-select-option">
                    <label class="filter-leble">Price Range</label>
                    <div id="slider-range"></div>
                    <div class="slider__range--output">
                        <div class="price__output--wrap">
                            <div class="price--output">
                                <span>Price :</span><input type="text" id="amount" readonly>
                            </div>
                            <div class="price--filter">
                                <button id="filter-auctions-button" class="btn btn-primary btn-small">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row g-5" id="auctions-section">
            <!-- Loop through your products to display them dynamically -->
            @foreach($auctions as $auction)
                @include('component.auction-card')
            @endforeach
            <!-- End loop -->
        </div>
    </div>
</div>
<!-- End product area -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        function initializePriceRangeSlider() {
            $.ajax({
                url: "{{ route('price.range') }}", // Make sure this URL is correct
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Destroy the slider if it already exists
                    if ($("#slider-range").hasClass('ui-slider')) {
                        $("#slider-range").slider("destroy");
                    }

                    // Initialize the slider with the fetched price range
                    $("#slider-range").slider({
                        range: true,
                        min: parseInt(response.minPrice, 10),
                        max: parseInt(response.maxPrice, 10),
                        values: [parseInt(response.minPrice, 10), parseInt(response.maxPrice, 10)],
                        slide: function(event, ui) {
                            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                        }
                    });

                    // Set the initial value of the amount input box
                    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                        " - $" + $("#slider-range").slider("values", 1));
                }
            });
        }

        initializePriceRangeSlider();

        $('#auctions-section').on('click', '.react-area', function() {
            var auctionId = $(this).data('auction-id');
            toggleReaction(auctionId, this);
        });

        // Filter auctions
        $('#filter-auctions-button').click(function() {
            console.log('Filtering auctions...');
            var category = $('select[name="category"]').val();
            var collection = $('select[name="collection"]').val();
            var saleType = $('select[name="saleType"]').val();
            var likes = $('select[name="likes"]').val();
            var priceRange = $('#amount').val().split(' - ');
            var minPrice = priceRange[0].replace('$', '');
            var maxPrice = priceRange[1].replace('$', '');

            var data = {
                minPrice: minPrice,
                maxPrice: maxPrice,
            };

            if (category && category !== "Category") {
                data.category = category;
            }

            if (collection && collection !== "Select Collection") {
                data.collection = collection;
            }

            if (saleType && saleType !== "Sale type") {
                data.saleType = saleType;
            }

            if (likes) {
                data.likes = likes;
            }


            console.log('Filtering with:', {category, collection, minPrice, maxPrice});

            $.ajax({
                url: "{{ route('auctions.filter') }}",
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,

                success: function(response) {
                    console.log("Response received:", response);  // Debug: log the entire response
                    if (response.success && response.auctions.length > 0) {
                        $('#auctions-section').empty();
                        response.auctions.forEach(function(auction) {
                            var reactAreaHtml = auction.canReact ?
                                `<div class="react-count-display">
                        <i class="feather-heart"></i> <span>${auction.total_reactions}</span>
                    </div>` :
                                `<div class="react-area" data-auction-id="${auction.id}" onclick="toggleReaction(${auction.id}, this)">
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
    });
</script>



@endsection
