<header class="rn-header haeder-default header--sticky">
    <div class="container">
        <div class="header-inner">
            <div class="header-left">
                <div class="logo-thumbnail logo-custom-css">
                    <img src="path_to_your_logo_image" alt="BidderXBidder Logo">
                </div>
                <div class="mainmenu-wrapper">
                    <nav id="sideNav" class="mainmenu-nav d-none d-xl-block">
                        <ul class="mainmenu">
                            @auth
                                @if (Auth::user()->roles->contains('id', 3))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('ownerProfile') }}">My Profile</a>
                                    </li>
                                @elseif(Auth::user()->roles->contains('id', 2))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('bidderProfile') }}">My Profile</a>
                                    </li>
                                @endif
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
                                    <a href="#">Services</a>
                                    <ul class="submenu">
                                        <li><a href="#">Service 1</a></li>
                                        <li><a href="#">Service 2</a></li>
                                        <li><a href="#">Service 3</a></li>
                                    </ul>
                                </li>
                                <li class="has-droupdown has-menu-child-item">
                                    <a href="{{ route('auctionsExplore') }}">Explore</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('timedAuctions') }}">Timed Auctions</a></li>
                                        <li><a href="{{ route('instantAuctions') }}">Instant Auctions</a></li>
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
                        <div class="icon-box">
                            <a id="connectbtn" class="btn btn-primary-alta btn-small" href="{{ route('wallet.connect') }}">Wallet connect</a>
                        </div>
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
                    <a href="#" class="icon-link">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="main-grid-item-icon" fill="none" stroke="#E9E0CE" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" onmouseover="this.style.stroke='#766161';"
                            onmouseout="this.style.stroke='#E9E0CE';">
                            <circle cx="12" cy="12" r="5" />
                            <line x1="12" x2="12" y1="1" y2="3" />
                            <line x1="12" x2="12" y1="21" y2="23" />
                            <line x1="4.22" x2="5.64" y1="4.22" y2="5.64" />
                            <line x1="18.36" x2="19.78" y1="18.36" y2="19.78" />
                            <line x1="1" x2="3" y1="12" y2="12" />
                            <line x1="21" x2="23" y1="12" y2="12" />
                            <line x1="4.22" x2="5.64" y1="19.78" y2="18.36" />
                            <line x1="18.36" x2="19.78" y1="5.64" y2="4.22" />
                        </svg>
                    </a>
                    <!-- Moon Icon -->
                    <a href="#" class="icon-link">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="main-grid-item-icon" fill="none" stroke="#766161" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" onmouseover="this.style.stroke='#E9E0CE';"
                            onmouseout="this.style.stroke='#766161';">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>


<div class="popup-mobile-menu">
    <div class="inner">
        <div class="header-top">
            <div class="logo logo-custom-css">
                <a class="logo-light" href="index.html"><img src="assets/images/logo/logo-white.png"
                        alt="nft-logo"></a>
                <a class="logo-dark" href="index.html"><img src="assets/images/logo/logo-dark.png"
                        alt="nft-logo"></a>
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
                <li class="has-droupdown">
                    <a class="nav-link its_new" href="#">Home</a>
                    <ul class="submenu">
                        <li><a href="index.html">Home page - 01 <i class="feather-home"></i></a></li>
                        <li><a href="index-two.html">Home page - 02<i class="feather-home"></i></a></li>
                        <li><a href="index-three.html">Home page - 03<i class="feather-home"></i></a></li>
                        <li><a href="index-four.html">Home page - 04<i class="feather-home"></i></a></li>
                        <li><a href="index-five.html">Home page - 05<i class="feather-home"></i></a></li>
                        <li><a href="index-six.html">Home page - 06<i class="feather-home"></i></a></li>
                        <li><a href="index-seven.html">Home page - 07<i class="feather-home"></i></a></li>
                        <li><a href="index-eight.html">Home page - 08<i class="feather-home"></i></a></li>
                        <li><a href="index-nine.html">Home page - 09<i class="feather-home"></i></a></li>
                        <li><a href="index-ten.html">Home page - 10<i class="feather-home"></i></a></li>
                        <li><a href="index-eleven.html">Home page - 11<i class="feather-home"></i></a></li>
                        <li><a href="index-twelve.html">Home page - 12<i class="feather-home"></i></a></li>
                        <li><a href="index-thirteen.html">Home page - 13<i class="feather-home"></i></a></li>
                        <li><a href="index-fourteen.html">Home page - 14<i class="feather-home"></i></a></li>
                        <li><a href="index-fifteen.html">Home page - 15<i class="feather-home"></i></a></li>
                        <li><a href="index-sixteen.html">Home page - 16<i class="feather-home"></i></a></li>
                        <li><a href="index-seventeen.html">Home page - 17<i class="feather-home"></i></a></li>
                        <li><a href="index-eighteen.html">Home page - 18<i class="feather-home"></i></a></li>
                    </ul>
                </li>
                <li><a href="about.html">About</a>
                </li>
                <li class="has-droupdown">
                    <a class="nav-link its_new" href="#">Explore</a>
                    <ul class="submenu">
                        <li><a href="explore-one.html">Explore Filter<i class="feather-fast-forward"></i></a></li>
                        <li><a href="explore-two.html">Explore Isotop<i class="feather-fast-forward"></i></a></li>
                        <li><a href="explore-three.html">Explore Carousel<i class="feather-fast-forward"></i></a></li>
                        <li><a href="explore-four.html">Explore Simple<i class="feather-fast-forward"></i></a></li>
                        <li><a href="explore-five.html">Explore Place Bid<i class="feather-fast-forward"></i></a></li>
                        <li><a href="explore-six.html">Place Bid With Filter<i class="feather-fast-forward"></i></a>
                        </li>
                        <li><a href="explore-seven.html">Place Bid With Isotop<i class="feather-fast-forward"></i></a>
                        </li>
                        <li><a href="explore-eight.html">Place Bid With Carousel<i
                                    class="feather-fast-forward"></i></a></li>
                        <li><a href="explore-list-style.html">Explore Style List<i
                                    class="feather-fast-forward"></i></a></li>
                        <li><a href="explore-list-column-two.html">Explore List Col-Two<i
                                    class="feather-fast-forward"></i></a></li>
                        <li><a href="explore-left-filter.html">Explore Left Filter<i
                                    class="feather-fast-forward"></i></a></li>
                        <li><a class="live-expo" href="explore-live.html">Live Explore</a></li>
                        <li><a class="live-expo" href="explore-live-two.html">Live Explore Carousel</a></li>
                        <li><a class="live-expo" href="explore-live-three.html">Live With Place Bid</a></li>
                    </ul>
                </li>
                <li class="with-megamenu">
                    <a class="nav-link its_new" href="#">Pages</a>
                    <div class="rn-megamenu">
                        <div class="wrapper">
                            <div class="row row--0">
                                <div class="col-lg-3 single-mega-item">
                                    <ul class="mega-menu-item">
                                        <li>
                                            <a href="create.html">Create NFT<i data-feather="file-plus"></i></a>
                                        </li>
                                        <li>
                                            <a href="upload-variants.html">Upload Type<i
                                                    data-feather="layers"></i></a>
                                        </li>
                                        <li><a href="activity.html">Activity<i data-feather="activity"></i></a></li>
                                        <li>
                                            <a href="creator.html">Creators<i data-feather="users"></i></a>
                                        </li>
                                        <li><a href="collection.html">Our Collection<i data-feather="package"></i></a>
                                        </li>
                                        <li><a href="upcoming_projects.html">Upcoming Projects<i
                                                    data-feather="loader"></i></a></li>
                                        <li><a href="create-collection.html">Create Collection<i
                                                    data-feather="edit-3"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 single-mega-item">
                                    <ul class="mega-menu-item">
                                        <li><a href="login.html">Log In <i data-feather="log-in"></i></a></li>
                                        <li><a href="sign-up.html">Registration <i data-feather="user-plus"></i></a>
                                        </li>
                                        <li><a href="forget.html">Forget Password <i data-feather="key"></i></a></li>
                                        <li>
                                            <a href="author.html">Author/Profile(User) <i data-feather="user"></i></a>
                                        </li>
                                        <li>
                                            <a href="connect.html">Connect to Wallet <i data-feather="pocket"></i></a>
                                        </li>
                                        <li><a href="privacy-policy.html">Privacy Policy <i
                                                    data-feather="file-text"></i></a></li>
                                        <li><a href="newsletter.html">Newsletter<i data-feather="book-open"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 single-mega-item">
                                    <ul class="mega-menu-item">

                                        <li><a href="product.html">Product<i data-feather="folder"></i></a></li>
                                        <li><a href="product-details.html">Product Details <i
                                                    data-feather="layout"></i></a></li>
                                        <li><a href="ranking.html">NFT Ranking<i data-feather="trending-up"></i></a>
                                        </li>
                                        <li><a href="blog.html">Our News <i data-feather="message-square"></i></a>
                                        </li>
                                        <li><a href="blog-details.html">Blog Details<i
                                                    data-feather="book-open"></i></a></li>
                                        <li><a href="404.html">404 <i data-feather="alert-triangle"></i></a></li>
                                        <li><a href="forum-community.html">Forum & Community<i
                                                    data-feather="message-circle"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 single-mega-item">
                                    <ul class="mega-menu-item">
                                        <li><a href="about.html">About Us<i data-feather="award"></i></a></li>
                                        <li><a href="contact.html">Contact <i data-feather="headphones"></i></a></li>
                                        <li><a href="support.html">Support/FAQ <i data-feather="help-circle"></i></a>
                                        </li>
                                        <li><a href="terms-condition.html">Terms & Condition <i
                                                    data-feather="list"></i></a></li>
                                        <li><a href="coming-soon.html">Coming Soon <i data-feather="clock"></i></a>
                                        </li>
                                        <li><a href="maintenance.html">Maintenance <i data-feather="cpu"></i></a></li>
                                        <li><a href="forum-details.html">Forum Details <i
                                                    data-feather="message-circle"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="has-droupdown has-menu-child-item">
                    <a class="nav-link its_new" href="blog.html">Blog</a>
                    <ul class="submenu">
                        <li><a href="blog-single-col.html">Blog Single Column<i class="feather-fast-forward"></i></a>
                        </li>
                        <li><a href="blog-col-two.html">Blog Two Column<i class="feather-fast-forward"></i></a></li>
                        <li><a href="blog-col-three.html">Blog Three Column<i class="feather-fast-forward"></i></a>
                        </li>
                        <li><a href="blog.html">Blog Four Column<i class="feather-fast-forward"></i></a></li>
                        <li><a href="blog-details.html">Blog Details<i class="feather-fast-forward"></i></a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
            <!-- End Mainmanu Nav -->
        </nav>
    </div>
</div>
