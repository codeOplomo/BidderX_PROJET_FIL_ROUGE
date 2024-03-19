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
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores expedita beatae
                                exercitationem quasi ullam esse?</p>
                            <div class="button-group">
                                <a href="{{ route('register') }}" class="btn btn-large btn-primary mr--15">Get Started</a>
                                {{-- <a href="create.html" class="btn btn-large btn-primary-alta">Create</a> --}}
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
                                <a href="create.html" class="btn btn-large btn-primary mr--15">Get Started</a>
                                <a href="create.html" class="btn btn-large btn-primary-alta">Create</a>
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
                                <a href="create.html" class="btn btn-large btn-primary mr--15">Get Started</a>
                                <a href="create.html" class="btn btn-large btn-primary-alta">Create</a>
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
            <!-- start single product -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="product-style-one no-overlay">
                    <div class="card-thumbnail">
                        <a href="product-details.html"><img src="assets/images/portfolio/portfolio-01.jpg" alt="NFT_portfolio"></a>
                    </div>
                    <div class="product-share-wrapper">
                        <div class="profile-share">
                            <a href="author.html" class="avatar" data-tooltip="Jone lee"><img src="assets/images/client/client-1.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Jone Due"><img src="assets/images/client/client-2.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Nisat Tara"><img src="assets/images/client/client-3.png" alt="Nft_Profile"></a>
                            <a class="more-author-text" href="#">9+ Place Bit.</a>
                        </div>
                        <div class="share-btn share-btn-activation dropdown">
                            <button class="icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg viewBox="0 0 14 4" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z" fill="currentColor"></path>
                                </svg>
                            </button>

                            <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal" data-bs-target="#shareModal">
                                    Share
                                </button>
                                <button type="button" class="btn-setting-text report-text" data-bs-toggle="modal" data-bs-target="#reportModal">
                                    Report
                                </button>
                            </div>

                        </div>
                    </div>
                    <a href="product-details.html"><span class="product-name">Preatent</span></a>
                    <span class="latest-bid">Highest bid 1/20</span>
                    <div class="bid-react-area">
                        <div class="last-bid">0.244wETH</div>
                        <div class="react-area">
                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                <path d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z" stroke="currentColor" stroke-width="2"></path>
                            </svg>
                            <span class="number">322</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end single product -->

            <!-- start single product -->
            <div data-sal="slide-up" data-sal-delay="200" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="product-style-one no-overlay">
                    <div class="card-thumbnail">
                        <a href="product-details.html"><img src="assets/images/portfolio/portfolio-02.jpg" alt="NFT_portfolio"></a>
                    </div>
                    <div class="product-share-wrapper">
                        <div class="profile-share">
                            <a href="author.html" class="avatar" data-tooltip="Jone lee"><img src="assets/images/client/client-4.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Nira Ara"><img src="assets/images/client/client-5.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Fatima Afrafy"><img src="assets/images/client/client-6.png" alt="Nft_Profile"></a>
                            <a class="more-author-text" href="#">10+ Place Bit.</a>
                        </div>
                        <div class="share-btn share-btn-activation dropdown">
                            <button class="icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg viewBox="0 0 14 4" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z" fill="currentColor"></path>
                                </svg>
                            </button>

                            <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal" data-bs-target="#shareModal">
                                    Share
                                </button>
                                <button type="button" class="btn-setting-text report-text" data-bs-toggle="modal" data-bs-target="#reportModal">
                                    Report
                                </button>
                            </div>

                        </div>
                    </div>
                    <a href="product-details.html"><span class="product-name">Diamond Dog</span></a>
                    <span class="latest-bid">Highest bid 5/11</span>
                    <div class="bid-react-area">
                        <div class="last-bid">0.892wETH</div>
                        <div class="react-area">
                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                <path d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z" stroke="currentColor" stroke-width="2"></path>
                            </svg>
                            <span class="number">420</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end single product -->

            <!-- start single product -->
            <div data-sal="slide-up" data-sal-delay="250" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="product-style-one no-overlay">
                    <div class="card-thumbnail">
                        <a href="product-details.html"><img src="assets/images/portfolio/portfolio-03.jpg" alt="NFT_portfolio"></a>
                    </div>
                    <div class="product-share-wrapper">
                        <div class="profile-share">
                            <a href="author.html" class="avatar" data-tooltip="Jone lee"><img src="assets/images/client/client-1.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Janin Ara"><img src="assets/images/client/client-8.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Atif Islam"><img src="assets/images/client/client-9.png" alt="Nft_Profile"></a>
                            <a class="more-author-text" href="#">10+ Place Bit.</a>
                        </div>
                        <div class="share-btn share-btn-activation dropdown">
                            <button class="icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg viewBox="0 0 14 4" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z" fill="currentColor"></path>
                                </svg>
                            </button>

                            <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal" data-bs-target="#shareModal">
                                    Share
                                </button>
                                <button type="button" class="btn-setting-text report-text" data-bs-toggle="modal" data-bs-target="#reportModal">
                                    Report
                                </button>
                            </div>

                        </div>
                    </div>
                    <a href="product-details.html"><span class="product-name">OrBid6</span></a>
                    <span class="latest-bid">Highest bid 2/31</span>
                    <div class="bid-react-area">
                        <div class="last-bid">0.2128wETH</div>
                        <div class="react-area">
                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                <path d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z" stroke="currentColor" stroke-width="2"></path>
                            </svg>
                            <span class="number">12</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end single product -->

            <!-- start single product -->
            <div data-sal="slide-up" data-sal-delay="300" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="product-style-one no-overlay">
                    <div class="card-thumbnail">
                        <a href="product-details.html"><img src="assets/images/portfolio/portfolio-04.jpg" alt="NFT_portfolio"></a>
                    </div>
                    <div class="product-share-wrapper">
                        <div class="profile-share">
                            <a href="author.html" class="avatar" data-tooltip="Jone lee"><img src="assets/images/client/client-1.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Jone lee"><img src="assets/images/client/client-3.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Jone lee"><img src="assets/images/client/client-5.png" alt="Nft_Profile"></a>
                            <a class="more-author-text" href="#">8+ Place Bit.</a>
                        </div>
                        <div class="share-btn share-btn-activation dropdown">
                            <button class="icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg viewBox="0 0 14 4" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z" fill="currentColor"></path>
                                </svg>
                            </button>

                            <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal" data-bs-target="#shareModal">
                                    Share
                                </button>
                                <button type="button" class="btn-setting-text report-text" data-bs-toggle="modal" data-bs-target="#reportModal">
                                    Report
                                </button>
                            </div>

                        </div>
                    </div>
                    <a href="product-details.html"><span class="product-name">Morgan11</span></a>
                    <span class="latest-bid">Highest bid 3/16</span>
                    <div class="bid-react-area">
                        <div class="last-bid">0.265wETH</div>
                        <div class="react-area">
                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                <path d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z" stroke="currentColor" stroke-width="2"></path>
                            </svg>
                            <span class="number">20</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end single product -->

            <!-- start single product -->
            <div data-sal="slide-up" data-sal-delay="350" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="product-style-one no-overlay">
                    <div class="card-thumbnail">
                        <a href="product-details.html"><img src="assets/images/portfolio/portfolio-05.jpg" alt="NFT_portfolio"></a>
                    </div>
                    <div class="product-share-wrapper">
                        <div class="profile-share">
                            <a href="author.html" class="avatar" data-tooltip="Jone lee"><img src="assets/images/client/client-2.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Jone lee"><img src="assets/images/client/client-7.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Jone lee"><img src="assets/images/client/client-9.png" alt="Nft_Profile"></a>
                            <a class="more-author-text" href="#">15+ Place Bit.</a>
                        </div>
                        <div class="share-btn share-btn-activation dropdown">
                            <button class="icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg viewBox="0 0 14 4" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z" fill="currentColor"></path>
                                </svg>
                            </button>

                            <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal" data-bs-target="#shareModal">
                                    Share
                                </button>
                                <button type="button" class="btn-setting-text report-text" data-bs-toggle="modal" data-bs-target="#reportModal">
                                    Report
                                </button>
                            </div>

                        </div>
                    </div>
                    <a href="product-details.html"><span class="product-name">mAtal8</span></a>
                    <span class="latest-bid">Highest bid 6/50</span>
                    <div class="bid-react-area">
                        <div class="last-bid">0.244wETH</div>
                        <div class="react-area">
                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                <path d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z" stroke="currentColor" stroke-width="2"></path>
                            </svg>
                            <span class="number">205</span>
                        </div>
                    </div>
                </div>
            </div>
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
                <select>
                    <option data-display="1 day"> 1 day</option>
                    <option value="1">7 Day's</option>
                    <option value="2">15 Day's</option>
                    <option value="4">30 Day's</option>
                </select>
            </div>
        </div>
        <div class="row justify-sm-center g-5 top-seller-list-wrapper">
            <!-- start single top-seller -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list">
                <div class="top-seller-inner-one">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail varified">
                            <a href="author.html"><img src="assets/images/client/client-12.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Brodband</h6>
                            </a>
                            <span class="count-number">
                            $2500,000
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End single top-seller -->

            <!-- start single top-seller -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list">
                <div class="top-seller-inner-one">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail">
                            <a href="author.html"><img src="assets/images/client/client-2.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Ms. Parkline</h6>
                            </a>
                            <span class="count-number">
                            $2300,000
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End single top-seller -->

            <!-- start single top-seller -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list">
                <div class="top-seller-inner-one">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail">
                            <a href="author.html"><img src="assets/images/client/client-3.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Methods</h6>
                            </a>
                            <span class="count-number">
                            $2100,000
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End single top-seller -->

            <!-- start single top-seller -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list">
                <div class="top-seller-inner-one">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail varified">
                            <a href="author.html"><img src="assets/images/client/client-4.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Jone sone</h6>
                            </a>
                            <span class="count-number">
                            $2000,000
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End single top-seller -->

            <!-- start single top-seller -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list">
                <div class="top-seller-inner-one">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail">
                            <a href="author.html"><img src="assets/images/client/client-5.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Siddhart</h6>
                            </a>
                            <span class="count-number">
                            $200,000
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End single top-seller -->

            <!-- start single top-seller -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list">
                <div class="top-seller-inner-one">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail varified">
                            <a href="author.html"><img src="assets/images/client/client-6.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Sobuj Mk</h6>
                            </a>
                            <span class="count-number">
                            $2000,000
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End single top-seller -->

            <!-- start single top-seller -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list">
                <div class="top-seller-inner-one">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail varified">
                            <a href="author.html"><img src="assets/images/client/client-7.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Trodband</h6>
                            </a>
                            <span class="count-number">
                            $2500,000
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End single top-seller -->

            <!-- start single top-seller -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list">
                <div class="top-seller-inner-one">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail">
                            <a href="author.html"><img src="assets/images/client/client-8.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Yash</h6>
                            </a>
                            <span class="count-number">
                            $2500,000
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End single top-seller -->

            <!-- start single top-seller -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list">
                <div class="top-seller-inner-one">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail">
                            <a href="author.html"><img src="assets/images/client/client-9.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">YASHKIB</h6>
                            </a>
                            <span class="count-number">
                            $2500,000
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End single top-seller -->

            <!-- start single top-seller -->
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-3 col-md-4 col-sm-6 top-seller-list">
                <div class="top-seller-inner-one">
                    <div class="top-seller-wrapper">
                        <div class="thumbnail varified">
                            <a href="author.html"><img src="assets/images/client/client-10.png" alt="Nft_Profile"></a>
                        </div>
                        <div class="top-seller-content">
                            <a href="author.html">
                                <h6 class="name">Brodband</h6>
                            </a>
                            <span class="count-number">
                            $2500,000
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End single top-seller -->
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
