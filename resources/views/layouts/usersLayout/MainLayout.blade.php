<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS, consider using a Vue wrapper for SweetAlert2 instead -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <!-- CSS
            ============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/feature.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/odometer.css') }}">

    <!-- Style css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">




    <style>
        .navbar {
            background-color: transparent;
            transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
            backdrop-filter: blur(0);
            justify-content: center;
            align-items: center;
            padding: 5px 0;
        }

        .navbar.sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .navbar-inner {
            display: flex;
            gap: 20%;
            width: 95%;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            max-height: 40px;
            margin-right: 20px;
        }

        .nav-link {
            text-decoration: none;
            font-weight: bold;
            color: #E9E0CE;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #ACACAC;
        }

        .nav-symbol {
            font-size: 1.2rem;
            position: absolute;
            top: 50%;
            right: -8px;
            transform: translateY(-50%);
            color: #E9E0CE;
        }

        .search-input {
            width: 200px;
            padding: 8px;
            border: 1px solid #ACACAC;
            border-radius: 5px;
            background-color: transparent;
            color: #E9E0CE;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #E25444;
            box-shadow: none;
            background-color: transparent !important;
        }

        .input-group-text {
            border: 1px solid #ACACAC;
            border-radius: 0 5px 5px 0;
            background-color: transparent;
            color: #ACACAC;
        }

        .search-input:focus+.input-group-text {
            border-color: #E25444;
        }

        .dropdown-menu {
            background-color: #237676;
        }

        .dropdown-item {
            color: #E9E0CE !important;
        }

        .start-button {
            background-color: #231A00;
            color: #E9E0CE;
            border: 1px solid #231A00;
            border-radius: 5px;
            padding: 8px 15px;
            transition: border-color 0.3s ease, color 0.3s ease;
        }

        .start-button:hover {
            background-color: #231A00;
            border-color: #E25444;
            color: #E25444;
        }

        .icon-link {
            cursor: pointer;
            transition: color 0.3s ease;
            margin-right: 10px;
            /* Add margin between icons */
        }

        .icon-link:last-child {
            margin-right: 0;
            /* Remove margin from the last icon */
        }

        .icon-link:hover {
            color: #766161;
        }



        /* Common styles for the sun and moon icons */
        .icon-link svg {
            border-radius: 50%;
            /* Add circular border */
            border: 1px solid #ACACAC;
            /* Optional: Add border color */
            box-sizing: content-box;
            /* Keep content-box sizing */
            padding: 8px;
            /* Add padding for spacing */
        }

        .direct-teams-for-your-dedicated-dreams-EtK {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
        }

        .divbgimage-22-Y8K {
            width: 100%;
            height: auto;
            display: block;
        }

        .divrow-qt7 {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .divrn-about-card-yjR,
        .divrn-about-card-dDd {
            flex: 0 0 48%;
        }

        .why-we-do-this-eKm,
        .helping-you-grow-in-every-stage-vCj {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .link-HGF {
            color: #E25444;
            cursor: pointer;
        }

        .divrow-C3m {
            padding: 20px;
            text-align: center;
        }

        .create-sell-well-collect-your-wonderful-nfts-at-nuron-very-fast-iH1 {
            font-size: 24px;
            font-weight: bold;
            color: #E9E0CE;
            margin-bottom: 20px;
        }

        .user-actions,
        .cart {
            margin-left: auto;
        }

        .search-input::placeholder {
            color: #ACACAC;
        }

        .container {
            max-width: 95%;
            margin: 0 auto;
            padding: 20px;
        }

        .divrn-about-wrapper-NsM {
            max-width: 800px;
            margin: 0 auto;
            color: #E9E0CE;
        }


        /* Styles for the main navbar */
        .offcanvas-body .navbar-nav {
            text-align: center;
            width: 100%;
        }

        .offcanvas-body .nav-item {
            display: inline-block;
        }

        .offcanvas-body .nav-link {
            padding: 0.5rem 1rem;
        }

        /* Styles for the dropdown menu */
        .offcanvas-body .dropdown-menu {
            background-color: #002d2d;
            /* Adjust background color as needed */
            border: none;
            width: auto;
        }

        .offcanvas-body .dropdown-item {
            color: #E9E0CE !important;
        }

        .offcanvas-body .dropdown-item:hover {
            background-color: #237676;
            /* Adjust background color on hover as needed */
        }

        .offcanvas-body .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Common styles for all screen sizes */
        .nav-section {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            width: auto;
            /* Adjust width as needed */
        }

        .d-flex.align-items-center {
            display: flex;
            align-items: center;
        }

        /* Responsive styles for screen sizes up to 425px */
        @media (max-width: 425px) {
            .nav-section {
                flex-direction: column !important;
            }

            .logo-section {
                width: 100%;
                order: 1;
                justify-content: center;
            }

            .d-flex.align-items-center {
                order: 2;
            }
        }

        /* Responsive styles for screens 768px to 1024px */
        @media (min-width: 768px) and (max-width: 1024px) {
            .navbar-nav {
                display: none;
            }

            .icon-link {
                display: block;
            }
        }

        .btn-subscribe {
            background-color: #231A00;
            color: #E9E0CE;
            border-color: #231A00;
        }

        /* Hover styles for the subscribe button */
        .btn-subscribe:hover {
            color: #E25444;
            /* Orange color */
            border-color: #E25444;
        }

        .email-input::placeholder {
            color: #ACACAC;
        }

        .email-input:focus {
            border-color: #E25444;
        }


        .error-message {
            color: red;
            font-size: 0.8em;
        }

        .already-have-account {
            text-align: center;
            margin-top: 20px;
        }

        .already-have-account a {
            color: #E25444;
            text-decoration: none;
        }

        .already-have-account a:hover {
            text-decoration: underline;
        }

        .registration-form {
            display: flex;
            flex-wrap: wrap;
            padding: 5vw;
            gap: 20px;
            /* Creates space between image and form */
        }

        .image-container {
            flex: 1;
            /* Equal width for both containers */
            background-color: #122b22;
            padding: 20px;
            /* Padding around the image to create a frame */
            box-sizing: border-box;
            border-radius: 5px;
            display: flex;
            /* Use flexbox */
            flex-direction: column;
            /* Stack items vertically */
            justify-content: center;
            /* Center items vertically */
            align-items: center;
            /* Center items horizontally */
        }

        .image-container img {
            width: 100%;
            /* Makes the image responsive */
            height: auto;
            border-radius: 5px;
        }

        .form-container {
            flex: 1;
            /* Equal width for both containers */
            background-color: #122b22;
            padding: 3vw;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            color: #E9E0CE;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            background-color: #231A00;
            border: 1px solid #000;
            color: #E9E0CE;
            border-radius: 4px;
            /* Slight radius for the inputs */
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #E25444;
        }

        .submit-button {
            background-color: #E25444;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            /* Slight radius for the button */
        }

        .submit-button:hover,
        .submit-button:focus {
            border: 1px solid #231A00;
            color: #231A00;
        }

        @media (max-width: 768px) {
            .registration-form {
                flex-direction: column;
            }

            .image-container,
            .form-container {
                flex: none;
                /* Allows the image and form to stack on small screens */
                width: 100%;
            }
        }

        .registration-form {
            display: flex;
            flex-wrap: wrap;
            padding: 5vw;
            gap: 20px;
        }

        .image-container {
            flex: 1;
            background-color: #122b22;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .form-container {
            flex: 1;
            background-color: #122b22;
            padding: 3vw;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Center form vertically */
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            color: #E9E0CE;
            display: inline-block;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            background-color: #231A00;
            border: 1px solid #000;
            color: #E9E0CE;
            border-radius: 4px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #E25444;
        }

        .submit-button {
            background-color: #E25444;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .submit-button:hover,
        .submit-button:focus {
            border: 1px solid #231A00;
            color: #231A00;
        }

        .create-account {
            text-align: center;
            margin-top: 20px;
        }

        .create-account a {
            color: #E25444;
            text-decoration: none;
        }

        .create-account a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .registration-form {
                flex-direction: column-reverse;
                /* Reverse the order of flex items on phone-width screens */
            }

            .image-container,
            .form-container {
                flex: none;
                width: 100%;
            }
        }


        /* auction card detail */
        .nav-pills {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #122b22;
            border: 2px solid #E25444;
            border-radius: 8px;
            padding: 5px;
        }

        .nav-pills ul {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .nav-pills .nav-item {
            border: 2px dashed #E25444;
            border-radius: 8px;
            margin-right: 10px;
        }

        .nav-pills .nav-item a {
            color: #E9E0CE;
            text-decoration: none;
            padding: 8px 12px;
            transition: background-color 0.3s ease;
        }

        .nav-pills .nav-item a.active,
        .nav-pills .nav-item a:hover {
            background-color: #231A00;
            color: #E25444;
        }
    </style>

</head>

<body class="template-color-1 nft-body-connect">

    <div class="main-layout">
        @include('layouts.usersLayout.partials.NavbarSection')

        <main>
            @yield('content')
        </main>

        @include('layouts.usersLayout.partials.FooterSection')

        <!-- SweetAlert Success Message -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: true,
                    background: 'red',
                    timer: 5000
                });
            </script>
        @endif

        <!-- SweetAlert Error Message -->
        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endif
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>



        function formatTimeDiff(time) {
            const now = new Date();
            const diff = Math.abs(now - new Date(time));

            const minutes = Math.floor(diff / 60000);

            if (minutes < 60) {
                return `${minutes} minutes ago`;
            } else if (minutes < 1440) {
                return `${Math.floor(minutes / 60)} hour ago`;
            } else {
                return `${Math.floor(minutes / 1440)} day ago`;
            }
        }

        $(document).ready(function() {
            var currentUrl = window.location.pathname;

            function getCsrfToken() {
                return $('meta[name="csrf-token"]').attr('content');
            }

            if (currentUrl.includes("/blogs")) {
                $('#search-form').submit(function(event) {
                    event.preventDefault();

                    var searchQuery = $('#search-input').val();

                    $.ajax({
                        url: "{{ route('search.blogs.sp') }}",
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
                // Handle other blog pages here
                //$('#search-form').attr('method', 'GET');
                //$('#search-form').attr('action', "{{ route('search.blogs.redirect') }}");
            } else if (currentUrl.includes("/auctions-explore")) {
                $('#search-form').submit(function(event) {
                    event.preventDefault();

                    var searchQuery = $('#search-input').val();

                    $.ajax({
                        url: "{{ route('search.explore') }}",
                        method: 'GET',
                        data: {
                            query: searchQuery
                        },
                        headers: {
                            'X-CSRF-TOKEN': getCsrfToken()
                        },
                        success: function(response) {
                            // Handle the response
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                        }
                    });
                });
            } else if (currentUrl.includes("/auction/")) {
                $('#search-form').attr('method', 'GET');
               // $('#search-form').attr('action', "{{ route('search.auctions') }}?_token=" + getCsrfToken());
               // $('#search-form').append('<input type="hidden" name="_token" value="' + getCsrfToken() + '">');
            } else {
                $('.search-form-wrapper').hide();
            }
        });



        console.log('Hello from the main layout!');
        Echo.join(`presence-user-presence.${userId}`)
            .here((users) => {
                console.log('Initial list of online users:', users);
            })
            .joining((user) => {
                console.log('User joined:', user);
            })
            .leaving((user) => {
                console.log('User left:', user);
            });

        function toggleReaction(auctionId, element) {
            fetch(`/auctions/${auctionId}/react`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ liked: true })
            })
                .then(response => response.json())
                .then(data => {
                    // Update the UI based on the response
                    if (data.success) {
                        const reactCountElement = document.getElementById(`reactCount-${auctionId}`);
                        reactCountElement.textContent = data.newCount;
                    }
                })
                .catch(error => console.error('Error:', error));
        }


    </script>

    <!-- Scripts -->
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

    {{-- Blade JavaScript file --}}
    <script src="assets/js/vendor/nft.js.blade.php"></script>


    <script type="module" src="/src/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
