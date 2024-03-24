@extends('layouts.usersLayout.MainLayout')

@section('content')

<!-- About banner area -->
<div class="rn-about-banner-area rn-section-gapTop">
    <div class="container mb--30">
        <div class="row">
            <div class="col-12">
                <h2 class="title about-title-m" data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">Direct Teams. <br>For Your Dadicated Dreams</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid about-fluidimg ">
        <div class="row">
            <div class="img-wrapper">
                <div class="bg_image--22 bg_image">

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="h--100">
                    <div class="rn-about-card mt_dec--50 widge-wrapper rbt-sticky-top-adjust">
                        <div class="inner">
                            <h2 class="title" data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">
                                Why We Do This
                            </h2>
                            <p class="about-disc" data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">
                                Our vintage and unique product auctions offer a gateway to owning one-of-a-kind treasures that embody history, craftsmanship, and rarity. Each item we auction, whether it's a vintage watch, a rare collectible, or a unique artwork, holds a story waiting to be discovered. We believe in connecting enthusiasts with their passions and interests.
                            </p>
                            <a href="blog.html" class="btn btn-primary-alta btn-large sal-animate mt--20" data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">See Our Blog</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="rn-about-card transparent-bg">
                    <div class="inner">
                        <h3 class="title" data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">
                            Helping You <br>Grow In Every Stage.
                        </h3>
                        <p class="about-disc mb--0" data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">
                            At BidderXBidder, we're dedicated to supporting your growth journey at every step. Whether you're just starting out or looking to expand your horizons, we provide the tools, resources, and expertise you need to thrive. From tailored guidance to innovative solutions, we're here to empower you to reach your full potential and achieve success.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About banner area End -->

<div class="rn-about-Quote-area rn-section-gapTop">
    <div class="container">
        <div class="row g-5 d-flex align-items-center">
            <div class="col-lg-6">
                <div class="rn-about-title-wrapper">
                    <h3 class="title" data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">Discover, and Collect Unique Assets with BidderXBidder</h3>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="rn-about-wrapper" data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">
                    <p>Exploring the world of digital assets is an exciting journey with BidderX. Our platform offers a diverse range of unique assets ready to be discovered, and collected. With a focus on innovation and accessibility, we provide a seamless experience for users to explore new opportunities and connect with like-minded collectors. Join us on this journey and unlock the potential of digital ownership.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- rn stastic area -->
<div class="rn-statistick-area rn-section-gapTop">
    <div class="container">
        <div class="row mb--30">
            <div class="col-12 text-center">
                <h3>BidderXBidder Statistics</h3>
            </div>
        </div>
        <div class="row g-5">
            <div class="offset-lg-2 col-lg-4 col-md-6">
                <div class="single-counter-up text-center">
                    <h3 class="counter"><span class="odometer" data-count="{{ $allProducts }}">{{ $allProducts }}</span></h3>
                    <div class="botton-title">XBidder All Products</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-counter-up text-center">
                    <h3 class="counter"><span class="odometer" data-count="{{ $creators }}">{{ $creators }}</span>
                    </h3>
                    <div class="botton-title">All Creators</div>
                </div>
            </div>
            <div class="offset-lg-2 col-lg-4 col-md-6">
                <div class="single-counter-up text-center">
                    <h3 class="counter"><span class="odometer" data-count="{{ $xBidderEarnings }}">{{ $xBidderEarnings }}</span>
                    </h3>
                    <div class="botton-title">XBidder Earning</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-counter-up text-center">
                    <h3 class="counter"><span class="odometer" data-count="{{ $ownersEarning }}">{{ $ownersEarning }}</span>
                    </h3>
                    <div class="botton-title">Owners Earning</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- rn stastic area -->

<!-- call to action area -->
<div class="rn-callto-action rn-section-gapTop">
    <div class="container-fluid about-fluidimg-cta">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg_image--6 bg_image bg-image-border" data-black-overlay="7">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="call-to-action-wrapper">
                                <h3 data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">Discover unique auctions and collect vintage and unique products at BidderXBidder</h3>
                                <p data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">BidderXBidder offers a curated selection of vintage and unique items that you won't find anywhere else. From collectibles to one-of-a-kind artworks, explore our marketplace to find treasures that speak to you.</p>
                                <div class="callto-action-btn-wrapper" data-sal="slide-up" data-sal-duration="800" data-sal-delay="150">
                                    <a href="create.html" class="btn btn-primary btn-large">Create</a>
                                    <a href="{{ route('contact') }}" class="btn btn-primary-alta btn-large">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- call to action area End -->



@endsection
