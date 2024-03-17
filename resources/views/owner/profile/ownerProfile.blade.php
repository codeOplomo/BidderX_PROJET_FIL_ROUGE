@extends('layouts.usersLayout.MainLayout')


<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
<link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/slick.css">
    <link rel="stylesheet" href="assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="assets/css/vendor/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/feature.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/vendor/odometer.css">

    <!-- Style css -->
    <link rel="stylesheet" href="assets/css/style.css">

@section('content')
    <div class="rn-author-bg-area bg_image--9 bg_image ptb--150">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </div>
    <div class="rn-author-area mb--30 mt_dec--120">
        <div class="container">
            <div class="row padding-tb-50 align-items-center d-flex">
                <div class="col-lg-12">
                    <div class="author-wrapper">
                        <div class="author-inner">
                            <div class="user-thumbnail">
                                <img src="{{ asset('assets/images/slider/banner-06.png') }}" alt="">
                            </div>
                            <div class="rn-author-info-content">
                                <h4 class="title">{{ $ownerData->firstname }} {{ $ownerData->lastname }}</h4>

                                <a href="#" class="social-follw">
                                    <i data-feather="twitter"></i>
                                    <span class="user-name">it0bsession</span>
                                </a>
                                <div class="follow-area">
                                    <div class="follow followers">
                                        <span>186k <a href="#" class="color-body">followers</a></span>
                                    </div>
                                    <div class="follow following">
                                        <span>156 <a href="#" class="color-body">following</a></span>
                                    </div>
                                </div>
                                <div class="author-button-area">
                                    <a href="{{ route('owner.auction.auctionCreate') }}"
                                        class="btn at-follw follow-button"><i data-feather="plus"></i> Create Auction</a>
                                    <span class="btn at-follw share-button" data-bs-toggle="modal"
                                        data-bs-target="#shareModal"><i data-feather="share-2"></i></span>
                                    <div class="count at-follw">
                                        <div class="share-btn share-btn-activation dropdown">
                                            <button class="icon" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <svg viewBox="0 0 14 4" fill="none" width="16" height="16"
                                                    class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </button>

                                            <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                                <button type="button" class="btn-setting-text report-text"
                                                    data-bs-toggle="modal" data-bs-target="#reportModal">
                                                    Report
                                                </button>
                                                <button type="button" class="btn-setting-text report-text">
                                                    Claim Owenership
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('owner.profile.edit') }}"
                                        class="btn at-follw follow-button edit-btn"><i data-feather="edit"></i></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="rn-authore-profile-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-wrapper-one">
                        <nav class="tab-button-one">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach (['On Sale', 'Owned', 'Created', 'Liked'] as $index => $tabTitle)
                                    <button class="nav-link {{ $index == 1 ? 'active' : '' }}"
                                        id="nav-tab-{{ $index }}" data-bs-toggle="tab"
                                        data-bs-target="#nav-{{ Str::slug($tabTitle) }}" type="button" role="tab"
                                        aria-controls="nav-{{ Str::slug($tabTitle) }}"
                                        aria-selected="{{ $index == 1 ? 'true' : 'false' }}">{{ $tabTitle }}</button>
                                @endforeach
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="tab-content rn-bid-content" id="nav-tabContent">
                <div class="tab-pane row g-5 d-flex fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="product-style-one no-overlay with-placeBid">
                            <div class="card-thumbnail">
                                <a href="">
                                    <img src="" alt="product_image">
                                </a>
                                <a href="" class="btn btn-primary">Place Bid</a>
                            </div>
                            <div class="product-share-wrapper">
                                <div class="profile-share">
                                    <a href="" class="avatar" data-tooltip="Sadikur Ali"><img
                                            src="{{ asset('assets/images/client/client-2.png') }}" alt="Nft_Profile"></a>
                                    <a href="" class="avatar" data-tooltip="Ali"><img
                                            src="{{ asset('assets/images/client/client-3.png') }}" alt="Nft_Profile"></a>
                                    <a href="" class="avatar" data-tooltip="Sadikur"><img
                                            src="{{ asset('assets/images/client/client-4.png') }}" alt="Nft_Profile"></a>
                                    <a class="more-author-text" href="#">9+ Place Bit.</a>
                                </div>
                                <div class="share-btn share-btn-activation dropdown">
                                    <button class="icon" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <svg viewBox="0 0 14 4" fill="none" width="16" height="16"
                                            class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </button>
                                    <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                        <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            Share
                                        </button>
                                        <button type="button" class="btn-setting-text report-text"
                                            data-bs-toggle="modal" data-bs-target="#reportModal">
                                            Report
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <a href=""><span class="product-name">BadBo66</span></a>
                            <span class="latest-bid">Highest bid 6/20</span>
                            <div class="bid-react-area">
                                <div class="last-bid">0.234wETH</div>
                                <div class="react-area">
                                    <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                        class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                        <path
                                            d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                            stroke="currentColor" stroke-width="2"></path>
                                    </svg>
                                    <span class="number">322</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane row g-5 d-flex fade show active" id="nav-profile" role="tabpanel"
                    aria-labelledby="nav-profile-tab">
                    <div class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="product-style-one no-overlay with-placeBid">
                            <div class="card-thumbnail">
                                <a href="">
                                    <img src="" alt="NFT_portfolio">
                                </a>
                                <a href="" class="btn btn-primary">Place Bid</a>
                            </div>
                            <div class="product-share-wrapper">
                                <div class="profile-share">
                                    <a href="" class="avatar" data-tooltip="Sadikur Ali"><img
                                            src="{{ asset('assets/images/client/client-2.png') }}" alt="Nft_Profile"></a>
                                    <a href="" class="avatar" data-tooltip="Ali"><img
                                            src="{{ asset('assets/images/client/client-3.png') }}" alt="Nft_Profile"></a>
                                    <a href="" class="avatar" data-tooltip="Sadikur"><img
                                            src="{{ asset('assets/images/client/client-4.png') }}" alt="Nft_Profile"></a>
                                    <a class="more-author-text" href="#">9+ Place Bit.</a>
                                </div>
                                <div class="share-btn share-btn-activation dropdown">
                                    <button class="icon" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <svg viewBox="0 0 14 4" fill="none" width="16" height="16"
                                            class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </button>
                                    <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                        <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            Share
                                        </button>
                                        <button type="button" class="btn-setting-text report-text"
                                            data-bs-toggle="modal" data-bs-target="#reportModal">
                                            Report
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <a href=""><span class="product-name">BadBo66</span></a>
                            <span class="latest-bid">Highest bid 6/20</span>
                            <div class="bid-react-area">
                                <div class="last-bid">0.234wETH</div>
                                <div class="react-area">
                                    <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                        class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                        <path
                                            d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                            stroke="currentColor" stroke-width="2"></path>
                                    </svg>
                                    <span class="number">322</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane row g-5 d-flex fade" id="nav-created" role="tabpanel"
                    aria-labelledby="nav-created-tab">

                    @foreach ($auctionedProducts as $product)
                        <div class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-style-one no-overlay with-placeBid">
                                <div class="card-thumbnail">
                                    <a href="#">
                                        @if ($product->getFirstMedia('product_picture'))
                                            {{-- @dd($product->getFirstMedia('product_picture')) --}}
                                            <img src="{{ $product->getFirstMediaUrl('product_picture') }}"
                                                alt="Product Image">
                                            {{-- {{ $product->getFirstMedia('product_picture')}} --}}
                                        @else
                                            <!-- Provide a placeholder image or default image -->
                                            <img src="{{ asset('assets/images/portfolio/portfolio-09.jpg') }}"
                                                alt="Placeholder Image">
                                        @endif
                                    </a>
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                                <div class="product-share-wrapper">
                                    <div class="profile-share">
                                        <a href="" class="avatar" data-tooltip="Sadikur Ali"><img src=""
                                                alt="Profile"></a>
                                        <a href="" class="avatar" data-tooltip="Ali"><img src=""
                                                alt="Profile"></a>
                                        <a href="" class="avatar" data-tooltip="Sadikur"><img src=""
                                                alt="Profile"></a>
                                        <a class="more-author-text" href="#">9+ Place Bit.</a>
                                    </div>
                                    <div class="share-btn share-btn-activation dropdown">
                                        <button class="icon" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <svg viewBox="0 0 14 4" fill="none" width="16" height="16"
                                                class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </button>
                                        <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                            <button type="button" class="btn-setting-text share-text"
                                                data-bs-toggle="modal" data-bs-target="#shareModal">
                                                Share
                                            </button>
                                            <button type="button" class="btn-setting-text report-text"
                                                data-bs-toggle="modal" data-bs-target="#reportModal">
                                                Report
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <a href="#"><span class="product-name">{{ $product->title }}</span></a>
                                <span class="latest-bid">Highest bid 6/20</span>
                                <div class="bid-react-area">
                                    <div class="last-bid">0.234wETH</div>
                                    <div class="react-area">
                                        <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                            class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                            <path
                                                d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                                stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                        <span class="number">322</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>



                <div class="tab-pane row g-5 d-flex fade" id="nav-liked" role="tabpanel"
                    aria-labelledby="nav-contact-tab">
                    <div class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="product-style-one no-overlay with-placeBid">
                            <div class="card-thumbnail">
                                <a href="">
                                    <img src="" alt="NFT_portfolio">
                                </a>
                                <a href="" class="btn btn-primary">Place Bid</a>
                            </div>
                            <div class="product-share-wrapper">
                                <div class="profile-share">
                                    <a href="" class="avatar" data-tooltip="Sadikur Ali"><img
                                            src="{{ asset('assets/images/client/client-2.png') }}" alt="Nft_Profile"></a>
                                    <a href="" class="avatar" data-tooltip="Ali"><img
                                            src="{{ asset('assets/images/client/client-3.png') }}" alt="Nft_Profile"></a>
                                    <a href="" class="avatar" data-tooltip="Sadikur"><img
                                            src="{{ asset('assets/images/client/client-4.png') }}" alt="Nft_Profile"></a>
                                    <a class="more-author-text" href="#">9+ Place Bit.</a>
                                </div>
                                <div class="share-btn share-btn-activation dropdown">
                                    <button class="icon" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <svg viewBox="0 0 14 4" fill="none" width="16" height="16"
                                            class="sc-bdnxRM sc-hKFxyN hOiKLt">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </button>
                                    <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                                        <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            Share
                                        </button>
                                        <button type="button" class="btn-setting-text report-text"
                                            data-bs-toggle="modal" data-bs-target="#reportModal">
                                            Report
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <a href=""><span class="product-name">BadBo66</span></a>
                            <span class="latest-bid">Highest bid 6/20</span>
                            <div class="bid-react-area">
                                <div class="last-bid">0.234wETH</div>
                                <div class="react-area">
                                    <svg viewBox="0 0 17 16" fill="none" width="16" height="16"
                                        class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                        <path
                                            d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z"
                                            stroke="currentColor" stroke-width="2"></path>
                                    </svg>
                                    <span class="number">322</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="rn-popup-modal share-modal-wrapper modal fade" id="shareModal" tabindex="-1"
                aria-hidden="true">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        data-feather="x"></i></button>
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content share-wrapper">
                        <div class="modal-header share-area">
                            <h5 class="modal-title">Share this NFT</h5>
                        </div>
                        <div class="modal-body">
                            <ul class="social-share-default">
                                <li><a href="#"><span class="icon"><i data-feather="facebook"></i></span><span
                                            class="text">facebook</span></a></li>
                                <li><a href="#"><span class="icon"><i data-feather="twitter"></i></span><span
                                            class="text">twitter</span></a></li>
                                <li><a href="#"><span class="icon"><i data-feather="linkedin"></i></span><span
                                            class="text">linkedin</span></a></li>
                                <li><a href="#"><span class="icon"><i data-feather="instagram"></i></span><span
                                            class="text">instagram</span></a></li>
                                <li><a href="#"><span class="icon"><i data-feather="youtube"></i></span><span
                                            class="text">youtube</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="rn-popup-modal report-modal-wrapper modal fade" id="reportModal" tabindex="-1"
                aria-hidden="true">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        data-feather="x"></i></button>
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content report-content-wrapper">
                        <div class="modal-header report-modal-header">
                            <h5 class="modal-title">Why are you reporting?
                            </h5>
                        </div>
                        <div class="modal-body">
                            <p>Describe why you think this item should be removed from marketplace</p>
                            <div class="report-form-box">
                                <h6 class="title">Message</h6>
                                <textarea name="message" placeholder="Write issues"></textarea>
                                <div class="report-button">
                                    <button type="button" class="btn btn-primary mr--10 w-auto">Report</button>
                                    <button type="button" class="btn btn-primary-alta w-auto"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor/jquery.js"></script>
    <script src="assets/js/vendor/jquery.nice-select.min.js"></script>
    <script src="assets/js/vendor/jquery-ui.js"></script>
    <script src="assets/js/vendor/modernizer.min.js"></script>
    <script src="assets/js/vendor/feather.min.js"></script>
    <script src="assets/js/vendor/slick.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/sal.min.js"></script>
    <script src="assets/js/vendor/particles.js"></script>
    <script src="assets/js/vendor/jquery.style.swicher.js"></script>
    <script src="assets/js/vendor/js.cookie.js"></script>
    <script src="assets/js/vendor/count-down.js"></script>
    <script src="assets/js/vendor/isotop.js"></script>
    <script src="assets/js/vendor/imageloaded.js"></script>
    <script src="assets/js/vendor/backtoTop.js"></script>
    <script src="assets/js/vendor/odometer.js"></script>
    <script src="assets/js/vendor/jquery-appear.js"></script>
    <script src="assets/js/vendor/scrolltrigger.js"></script>
    <script src="assets/js/vendor/jquery.custom-file-input.js"></script>
    <script src="assets/js/vendor/savePopup.js"></script>
    <script src="assets/js/vendor/vanilla.tilt.js"></script>

    <!-- main JS -->
    <script src="assets/js/main.js"></script>
    <!-- Meta Mask  -->
    <script src="assets/js/vendor/web3.min.js"></script>
    <script src="assets/js/vendor/maralis.js"></script>
    <script src="assets/js/vendor/nft.js"></script>
@endsection
