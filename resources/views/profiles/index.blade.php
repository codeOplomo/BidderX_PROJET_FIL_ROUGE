@extends('layouts.usersLayout.MainLayout')


<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendor/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/feature.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendor/odometer.css') }}">


<style>
    .rn-collection-inner-one .collection-wrapper {
        position: relative;
        padding: 18px;
        background: var(--background-color-1);
        border-radius: 5px;
    }
    .rn-collection-inner-one .collection-wrapper .collection-big-thumbnail {
        overflow: hidden;
        border-radius: 5px;
    }
    .rn-collection-inner-one .collection-wrapper .collection-big-thumbnail img {
        border-radius: 5px;
        object-fit: cover;
        width: 100%;
        height: auto;
        transition: var(--transition);
    }
    .rn-collection-inner-one .collection-wrapper .collenction-small-thumbnail {
        display: flex;
        justify-content: space-between;
        margin: -4px;
        margin-top: 4px;
    }
    .rn-collection-inner-one .collection-wrapper .collenction-small-thumbnail img {
        display: inline-block;
        width: 33.33%;
        padding: 4px;
        border-radius: 10px;
    }
    .rn-collection-inner-one .collection-wrapper .collection-profile {
        position: absolute;
        top: 48%;
        left: 50%;
        transform: translate(-50%, 0);
    }
</style>

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
                                <img src="{{ $user->getFirstMediaUrl("profile_images") ?: asset('assets/images/slider/banner-06.png') }}" alt="">
                            </div>
                            <div class="rn-author-info-content">
                                <h4 class="title">{{ $user->firstname }} {{ $user->lastname }}</h4>
                                @if($user->google_id)
                                    <a href="#" class="social-follow">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span class="user-name">{{ $user->email }}</span>
                                    </a>
                                @endif

                                <div class="author-info pt-4 pb-2">
                                    <p>{{ $user->bio ?: 'No bio available.' }}</p>
                                </div>

                                <div class="follow-area">
                                    <div class="follow followers">
                                        <span>186k <a href="#" class="color-body">followers</a></span>
                                    </div>
                                    <div class="follow following">
                                        <span>156 <a href="#" class="color-body">following</a></span>
                                    </div>
                                </div>
                                <div class="author-button-area">
                                    @if(auth()->user()->id == $user->id && auth()->user()->hasRole('owner'))
                                        <a href="{{ route('owner.auction.auctionCreate') }}" class="btn at-follw follow-button"><i data-feather="plus"></i> Create Auction</a>
                                        <a href="{{ route('owner.collections.create') }}" class="btn at-follw follow-button"><i data-feather="plus"></i> Create Collection</a>
                                    @endif
                                    <span class="btn at-follw share-button" data-bs-toggle="modal" data-bs-target="#shareModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg></span>
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
                                        @if(auth()->user()->id == $user->id)
                                        <a href="{{ route('user.profile.edit') }}"
                                           class="btn at-follw follow-button edit-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                                        @else
                                            <a href="{{ route('chat.start', ['userId' => $user->id]) }}" class="btn at-follw follow-button message-btn d-flex justify-content-center align-items-center p-2" style="width: 40px; height: 40px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10z"></path>
                                                </svg>
                                            </a>
                                        @endif
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
                                @foreach ($tabTitles as $index => $tabTitle)
                                    <button class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                            id="nav-tab-{{ Str::slug($tabTitle) }}" data-bs-toggle="tab"
                                            data-bs-target="#nav-{{ Str::slug($tabTitle) }}" type="button" role="tab"
                                            aria-controls="nav-{{ Str::slug($tabTitle) }}"
                                            aria-selected="{{ $index == 0 ? 'true' : 'false' }}">{{ ucfirst($tabTitle) }}</button>
                                @endforeach
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="tab-content rn-bid-content" id="nav-tabContent">
                @foreach($tabTitles as $tabName)
                    <div class="tab-pane row g-5 d-flex fade {{ $loop->first ? 'show active' : '' }}" id="nav-{{ Str::slug($tabName) }}" role="tabpanel" aria-labelledby="nav-{{ Str::slug($tabName) }}-tab">
                        @if (array_key_exists($tabName, $data))
                            @foreach($data[$tabName] as $item)
                                @if ($tabName == 'collection')
                                    @include('component.collection-card', ['collection' => $item])
                                @else
                                    @include('component.auction-card', ['auction' => $item])
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endforeach
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

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                var chatLinks = document.querySelectorAll('.chat-link');

                // Add click event listener to each chat link
                chatLinks.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent default link behavior

                        // Extract the user ID from the data attribute
                        var userId = link.dataset.userId;

                        // Redirect the user to the chat page with the selected user's ID
                        window.location.href = '/chat/' + userId; // Adjust the URL structure as needed
                    });
                });

                var createdTab = document.getElementById("nav-created-tab");
                var createdPane = document.getElementById("nav-created");

                createdTab.classList.add("active");
                createdPane.classList.add("active", "show");
            });
        </script>

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





