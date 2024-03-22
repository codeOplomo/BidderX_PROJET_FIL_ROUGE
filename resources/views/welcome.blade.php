{{-- Extend the main layout --}}
@extends('layouts.usersLayout.MainLayout')

{{-- Define the content section --}}
@section('content')
<div class="rn-banner-area rn-section-gapTop">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12">
                <div class="slider-style-6 wide-wrapper slick-activation-06 slick-arrow-between">

                    <!-- Start Single Portfolio  -->
                    <div class="slide bg_image bg_image--19">
                        <div class="banner-read-thumb-lg">
                            <h4>The way to find any <br> Digital content</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores expedita beatae exercitationem quasi ullam esse?</p>
                            <div class="button-group">
                                {{-- Check if the user is not authenticated --}}
                                @guest
                                    <a href="{{ route('register') }}" class="btn btn-large btn-primary mr--15">Get Started</a>
                                @endguest

                                {{-- Check if the user is authenticated --}}
                                @auth
                                    {{-- Check if the user is an owner --}}
                                    @if(Auth::user()->hasRole('owner'))
                                        <a href="{{ route('owner.auction.auctionCreate') }}" class="btn btn-large btn-primary-alta">Create</a>
                                        {{-- Otherwise, if the user is authenticated (implicitly a bidder in this case) --}}
                                    @else
                                        <a href="{{ route('auctionsExplore') }}" class="btn btn-large btn-primary">Explore</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>

                    <!-- Start Single Portfolio  -->

                    <!-- Start Single Portfolio  -->
                    <div class="slide bg_image bg_image--18">
                        <div class="banner-read-thumb-lg">
                            <h4>The way to find any <br> Digital content</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores expedita beatae
                                exercitationem quasi ullam esse?</p>
                            <div class="button-group">
                                {{-- Check if the user is not authenticated --}}
                                @guest
                                    <a href="{{ route('register') }}" class="btn btn-large btn-primary mr--15">Get Started</a>
                                @endguest

                                {{-- Check if the user is authenticated --}}
                                @auth
                                    {{-- Check if the user is an owner --}}
                                    @if(Auth::user()->hasRole('owner'))
                                        <a href="{{ route('owner.auction.auctionCreate') }}" class="btn btn-large btn-primary-alta">Create</a>
                                        {{-- Otherwise, if the user is authenticated (implicitly a bidder in this case) --}}
                                    @else
                                        <a href="{{ route('auctionsExplore') }}" class="btn btn-large btn-primary">Explore</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                    <!-- Start Single Portfolio  -->



                    <!-- Start Single Portfolio  -->
                    <div class="slide bg_image bg_image--20">
                        <div class="banner-read-thumb-lg">
                            <h4>The way to find any <br> Digital content</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores expedita beatae
                                exercitationem quasi ullam esse?</p>
                            <div class="button-group">
                                {{-- Check if the user is not authenticated --}}
                                @guest
                                    <a href="{{ route('register') }}" class="btn btn-large btn-primary mr--15">Get Started</a>
                                @endguest

                                {{-- Check if the user is authenticated --}}
                                @auth
                                    {{-- Check if the user is an owner --}}
                                    @if(Auth::user()->hasRole('owner'))
                                        <a href="{{ route('owner.auction.auctionCreate') }}" class="btn btn-large btn-primary-alta">Create</a>
                                        {{-- Otherwise, if the user is authenticated (implicitly a bidder in this case) --}}
                                    @else
                                        <a href="{{ route('auctionsExplore') }}" class="btn btn-large btn-primary">Explore</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                    <!-- Start Single Portfolio  -->

                </div>
            </div>
        </div>
    </div>
</div>

<!-- collection area Start -->
<div class="rn-collection-area rn-section-gapTop">
    <div class="container">
        <div class="row mb--50 align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Top Collection</h3>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--15">
                <div class="view-more-btn text-start text-sm-end" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <a class="btn-transparent" href="#">VIEW ALL<i data-feather="arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <!-- start single collention -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
                <a href="product-details.html" class="rn-collection-inner-one">
                    <div class="collection-wrapper">
                        <div class="collection-big-thumbnail">
                            <img src="assets/images/collection/collection-lg-01.jpg" alt="Nft_Profile">
                        </div>
                        <div class="collenction-small-thumbnail">
                            <img src="assets/images/collection/collection-sm-01.jpg" alt="Nft_Profile">
                            <img src="assets/images/collection/collection-sm-02.jpg" alt="Nft_Profile">
                            <img src="assets/images/collection/collection-sm-03.jpg" alt="Nft_Profile">
                        </div>
                        <div class="collection-profile">
                            <img src="assets/images/client/client-15.png" alt="Nft_Profile">
                        </div>
                        <div class="collection-deg">
                            <h6 class="title">Cubic Trad</h6>
                            <span class="items">27 Items</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- End single collention -->
            <!-- start single collention -->
            <div data-sal="slide-up" data-sal-delay="200" data-sal-duration="800" class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
                <a href="product-details.html" class="rn-collection-inner-one">
                    <div class="collection-wrapper">
                        <div class="collection-big-thumbnail">
                            <img src="assets/images/collection/collection-lg-03.jpg" alt="Nft_Profile">
                        </div>
                        <div class="collenction-small-thumbnail">
                            <img src="assets/images/collection/collection-sm-04.jpg" alt="Nft_Profile">
                            <img src="assets/images/collection/collection-sm-05.jpg" alt="Nft_Profile">
                            <img src="assets/images/collection/collection-sm-06.jpg" alt="Nft_Profile">
                        </div>
                        <div class="collection-profile">
                            <img src="assets/images/client/client-12.png" alt="Nft_Profile">
                        </div>
                        <div class="collection-deg">
                            <h6 class="title">Diamond Dog</h6>
                            <span class="items">20 Items</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- End single collention -->
            <!-- start single collention -->
            <div data-sal="slide-up" data-sal-delay="250" data-sal-duration="800" class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
                <a href="product-details.html" class="rn-collection-inner-one">
                    <div class="collection-wrapper">
                        <div class="collection-big-thumbnail">
                            <img src="assets/images/collection/collection-lg-02.jpg" alt="Nft_Profile">
                        </div>
                        <div class="collenction-small-thumbnail">
                            <img src="assets/images/collection/collection-sm-07.jpg" alt="Nft_Profile">
                            <img src="assets/images/collection/collection-sm-08.jpg" alt="Nft_Profile">
                            <img src="assets/images/collection/collection-sm-09.jpg" alt="Nft_Profile">
                        </div>
                        <div class="collection-profile">
                            <img src="assets/images/client/client-13.png" alt="Nft_Profile">
                        </div>
                        <div class="collection-deg">
                            <h6 class="title">Morgan11</h6>
                            <span class="items">15 Items</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- End single collention -->
            <!-- start single collention -->
            <div data-sal="slide-up" data-sal-delay="350" data-sal-duration="800" class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
                <a href="product-details.html" class="rn-collection-inner-one">
                    <div class="collection-wrapper">
                        <div class="collection-big-thumbnail">
                            <img src="assets/images/collection/collection-lg-04.jpg" alt="Nft_Profile">
                        </div>
                        <div class="collenction-small-thumbnail">
                            <img src="assets/images/collection/collection-sm-10.jpg" alt="Nft_Profile">
                            <img src="assets/images/collection/collection-sm-11.jpg" alt="Nft_Profile">
                            <img src="assets/images/collection/collection-sm-12.jpg" alt="Nft_Profile">
                        </div>
                        <div class="collection-profile">
                            <img src="assets/images/client/client-14.png" alt="Nft_Profile">
                        </div>
                        <div class="collection-deg">
                            <h6 class="title">Orthogon#720</h6>
                            <span class="items">10 Items</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- End single collention -->
        </div>
    </div>
</div>


<!-- New items Start -->
<div class="rn-new-items rn-section-gapTop">
    <div class="container">
        <div class="row mb--50 align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Newest Items</h3>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--15">
                <div class="view-more-btn text-start text-sm-end" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <a class="btn-transparent" href="#">VIEW ALL<i data-feather="arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row g-5">
            @foreach($newestAuctions as $auction)
                @include('component.auction-card')
            @endforeach
            <!-- end single product -->
        </div>
    </div>
</div>
<!-- New items End -->


<!-- top top-seller start -->
<div class="rn-top-top-seller-area nice-selector-transparent rn-section-gapTop">
    <div class="container">
        <div class="row  mb--30">
            <div class="col-12 justify-sm-center d-flex">
                <h3 class="title" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Top Seller in</h3>
                    <select id="timeframeSelect" name="timeframe" onchange="fetchTopOwners(this.value)">
                        <option value="1">1 day</option>
                        <option value="7">7 days</option>
                        <option value="15">15 days</option>
                        <option value="30">30 days</option>
                    </select>

            </div>
        </div>
        <div class="row justify-sm-center g-5 top-seller-list-wrapper" id="topSellersContainer">
            <!-- start single top-seller -->
            @foreach($topSellers as $owner)

                @include('component.top-owner')
            <!-- End single top-seller -->
            @endforeach

        </div>
    </div>
</div>
<!-- top top-seller end -->


<!-- start subscribe area -->
<div class="nu-subscribe-area rn-section-gapTop" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="subscribe-wrapper_1 text-center">
                    <h3 class="title mb--10">Join our newsletter</h3>
                    <p class="subtitle">Weekly FREE UI resource stroight to your inbox</p>
                    <div class="subscribe-input-wrapper">
                        <div class="input-group">
                            <input type="email" class="form-control bg-color--2" placeholder="Your email" aria-label="Recipient's email">
                            <div class="input-group-append">
                                <button class="btn btn-primary-alta btn-outline-secondary" type="button">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end subscribe area -->

<div class="footer-top">
    <div class="container">
        <div class="row">
            <ul class="nu-brand-area">
                <li><img src="assets/images/brand/brand-01.png" alt="nuron-brand_nft"></li>

                <li><img src="assets/images/brand/brand-03.png" alt="nuron-brand_nft"></li>
                <li><img src="assets/images/brand/brand-06.png" alt="nuron-brand_nft"></li>
                <li><img src="assets/images/brand/brand-07.png" alt="nuron-brand_nft"></li>
                <li><img src="assets/images/brand/brand-04.png" alt="nuron-brand_nft"></li>
                <li><img src="assets/images/brand/brand-02.png" alt="nuron-brand_nft"></li>
                <li><img src="assets/images/brand/brand-01.png" alt="nuron-brand_nft"></li>

                <li><img src="assets/images/brand/brand-03.png" alt="nuron-brand_nft"></li>
            </ul>
        </div>
    </div>
</div>



<script>
    // Function to fetch top owners based on selected timeframe
    function fetchTopOwners(timeframe) {
        // Get the URL to send the AJAX request
        const url = "{{ route('topOwners') }}?timeframe=" + encodeURIComponent(timeframe);

        // Send AJAX request using fetch API
        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token if using Laravel CSRF protection
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse response JSON
            })
            .then(data => {
                console.log('Received response:', data); // Handle response data
                // Update the content of topSellersContainer with the new data
                const topSellersContainer = document.getElementById('topSellersContainer');
                topSellersContainer.innerHTML = ''; // Clear existing content
                data.forEach(owner => {
                    // Create HTML markup for each owner
                    const ownerHTML = `
                <div class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                    <div class="top-seller-inner-one">
                        <div class="top-seller-wrapper">
                            <div class="thumbnail varified">
                                <a href="author.html"><img src="assets/images/client/client-12.png" alt="Nft_Profile"></a>
                            </div>
                            <div class="top-seller-content">
                                <a href="author.html">
                                    <h6 class="name">${owner.firstname} ${owner.lastname}</h6>
                                </a>
                                <span class="count-number">
                                    $${owner.total_bid_price}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                    // Append ownerHTML to topSellersContainer
                    topSellersContainer.insertAdjacentHTML('beforeend', ownerHTML);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

</script>

@endsection

{{-- Optional: Custom Styles for the Welcome Page --}}
@push('styles')
<style>
    .welcome-page {
        text-align: center;
        padding: 50px 0;
    }
    .navigation-links {
        margin-top: 20px;
    }
    .btn {
        margin: 0 10px;
    }
</style>
@endpush
