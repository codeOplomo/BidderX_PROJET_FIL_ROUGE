<style>
    .balance-display {
        background-color: #f0f0f0;
        color: #333;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: bold;
        margin-right: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .icon-box:hover .balance-display {
        background-color: #e0e0e0;
    }
</style>

<header class="rn-header haeder-default header--sticky">
    <div class="container">
        <div class="header-inner">
            <div class="header-left">
                <div class="logo-thumbnail logo-custom-css">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo/bidder_logo.png') }}" alt="BidderXBidder Logo">
                    </a>
                </div>
                <div class="mainmenu-wrapper">
                    <nav id="sideNav" class="mainmenu-nav d-none d-xl-block">
                        <ul class="mainmenu">
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile.index') }}">My Profile</a>
                                </li>
                            @endauth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('blogs') }}">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                            </li>
                            @auth
                                <li class="has-droupdown has-menu-child-item">
                                    <a href="{{ route('wallet.connect') }}">Wallets</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('payment.page') }}">Make Deposit</a></li>
                                    </ul>
                                </li>
                                <li class="has-droupdown has-menu-child-item">
                                    <a href="{{ route('auctionsExplore') }}">Explore</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('timedAuctions') }}">Timed Auctions</a></li>
                                        <li><a href="{{ route('instantAuctions') }}">Instant Auctions</a></li>
                                        <li><a href="{{ route('creators.show') }}">Creators</a></li>
                                        <li><a href="{{ route('collectionsExplore') }}">Collections</a></li>
                                    </ul>
                                </li>
                            @endauth
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="header-right">
                <div class="setting-option d-none d-lg-block">
                    <form class="search-form-wrapper" id="search-form" method="GET" action="">
                        @csrf
                        <input type="search" name="query" placeholder="Search Here" aria-label="Search" id="search-input">
                        <div class="search-icon">
                            <button type="submit" id="search-button">
                                <lord-icon src="https://cdn.lordicon.com/kkvxgpti.json" trigger="hover"
                                           colors="primary:#ddd8c4"
                                           style=" width: 20px; height: 20px; max-width: 40px; max-height: 40px;">
                                </lord-icon>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Login/Register Links -->
                @guest
                    <div class="ms-3">
                        <a href="{{ route('register') }}" class="btn start-button">Get Started</a>
                    </div>
                @endguest
                @auth
                    <div class="setting-option header-btn rbt-site-header" id="rbt-site-header">
                        {{-- Check if user has made at least one deposit --}}
                        @if(auth()->user()->walletBalance > 0)
                            <div class="icon-box">
                                <span class="balance-display">Balance: {{ auth()->user()->walletBalance }} $ </span>
                            </div>
                        @else
                            <div class="icon-box">
                                <a id="connectbtn" class="btn btn-primary-alta btn-small" href="{{ route('wallet.connect') }}">Wallet connect</a>
                            </div>
                        @endif
                    </div>

                    @if(!auth()->user()->hasRole('owner'))
                    <div class="icon-box">
                        <a class="btn btn-primary-alta btn-small" href="{{ route('bidder.application') }}">Become a Creator</a>
                    </div>
                    @endif

                    <script src="https://cdn.lordicon.com/lordicon.js"></script>
                    <!-- Inbox Icon Redirect to Chat Page -->
                    <div id="inbox-icon">
                        <a href="{{ route('chat.page') }}" style="color: inherit;">
                            <lord-icon
                                src="https://cdn.lordicon.com/xtnsvhie.json"
                                trigger="hover"
                                colors="primary:#f4c89c"
                                style="width:30px;height:30px">
                            </lord-icon>
                            <span class="badge bg-color-primary" id="unread-messages-count" style="color: white; border-radius: 50%;">0</span>
                        </a>
                    </div>


                    <div class="ms-3">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn start-button">Logout</button>
                        </form>
                    </div>
                @endauth

                <!-- Search icon for mobile -->
                <div class="setting-option rn-icon-list d-block d-lg-none">
                    <div class="icon-box search-mobile-icon">
                        <button>
                            <lord-icon src="https://cdn.lordicon.com/kkvxgpti.json" trigger="hover"
                                colors="primary:#ddd8c4"
                                style=" width: 20px; height: 20px; max-width: 40px; max-height: 40px;">
                            </lord-icon>
                        </button>
                    </div>
                    <form id="header-search-1" action="#" method="GET" class="large-mobile-blog-search">
                        <div class="rn-search-mobile form-group">
                            <button type="submit" class="search-button"><i class="feather-search"></i></button>
                            <input type="text" placeholder="Search ...">
                        </div>
                    </form>
                </div>
                <!-- Hamburger Menu for mobile -->
                <div class="setting-option mobile-menu-bar d-block d-xl-none">
                    <div class="hamberger">
                        <button class="hamberger-button">
                            <i class="feather-menu"></i>
                        </button>
                    </div>
                </div>
                <!-- Sun and Moon icons -->
                <div class="ms-3">
                    <!-- Sun Icon -->

                </div>
            </div>
        </div>
    </div>
</header>


<div class="popup-mobile-menu template-color-1">
    <div class="inner">
        <div class="header-top">
            <div class="logo logo-custom-css">
                <a class="logo-dark" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logo/bidder_logo.png') }}" alt="BidderXBidder Logo">
                </a>
            </div>
            <div class="close-menu">
                <button class="close-button">
                    <i class="feather-x"></i>
                </button>
            </div>
        </div>
        <nav>
            <!-- Start Mainmanu Nav -->
            <ul class="mainmenu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li class="has-droupdown">
                    <a href="#">Explore</a>
                    <ul class="submenu">
                        <li><a href="{{ route('auctionsExplore') }}">Auctions</a></li>
                        <li><a href="{{ route('creators.show') }}">Creators</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="#">User</a>
                    <ul class="submenu">
                        @auth
                            <li><a href="{{ route('profile.index') }}">My Profile</a></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn">Logout</button>
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endguest
                    </ul>
                </li>
            </ul>
            <!-- End Mainmanu Nav -->
        </nav>
    </div>
</div>

