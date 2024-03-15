<header class="rn-header header-default header--sticky">
    <div class="container">
        <div class="header-inner">
            <div class="header-left">
                <div class="logo-thumbnail logo-custom-css">
                    <img src="path_to_your_logo_image" alt="BidderXBidder Logo">
                </div>
                
                <div class="mainmenu-wrapper">
                    <nav id="sideNav" class="mainmenu-nav d-none d-xl-block">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">About</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Services
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                    <li><a class="dropdown-item" href="#">Service 1</a></li>
                                    <li><a class="dropdown-item" href="#">Service 2</a></li>
                                    <li><a class="dropdown-item" href="#">Service 3</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="exploreDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Explore
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="exploreDropdown">
                                    <li><a class="dropdown-item" href="#">Service 1</a></li>
                                    <li><a class="dropdown-item" href="#">Service 2</a></li>
                                    <li><a class="dropdown-item" href="#">Service 3</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="header-right">
                <div class="ms-3 d-none d-md-block">
                    <div class="input-group">
                        <input type="text" class="form-control search-input" placeholder="Search for products..."
                            onfocus="this.style.color='#E9E0CE';" onblur="this.style.color='#ACACAC';" />
                        <button class="btn btn-outline-secondary input-group-text" type="button">
                            <lord-icon src="https://cdn.lordicon.com/kkvxgpti.json" trigger="hover"
                                colors="primary:#ddd8c4"
                                style=" width: 20px; height: 20px; max-width: 40px; max-height: 40px;">
                            </lord-icon>
                        </button>
                    </div>
                </div>

                <!-- Login/Register Links -->
                <div class="ms-3">
                    <a href="{{ route('register') }}" class="btn start-button">Start</a>
                </div>

                <!-- Add the menu icon for small screens -->
                <div class="ms-3 d-lg-none d-xl-none">
                    <a href="#" class="icon-link" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                        <!-- Your Existing Menu Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="main-grid-item-icon" fill="none" stroke="#E9E0CE" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" onmouseover="this.style.stroke='#766161';"
                            onmouseout="this.style.stroke='#E9E0CE';">
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                    </a>
                </div>

                <!-- Add the sun and moon icons with responsive classes -->
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
    
    <!-- Offcanvas sidebar menu -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex justify-content-center">
            <!-- Add your navigation links here -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item" href="#">Service 1</a></li>
                        <li><a class="dropdown-item" href="#">Service 2</a></li>
                        <li><a class="dropdown-item" href="#">Service 3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="exploreDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Explore
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="exploreDropdown">
                        <li><a class="dropdown-item" href="#">Service 1</a></li>
                        <li><a class="dropdown-item" href="#">Service 2</a></li>
                        <li><a class="dropdown-item" href="#">Service 3</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
            </ul>
        </div>
    </div>

</header>
