@extends('layouts.usersLayout.MainLayout')

@section('content')
    <style>
        .btn.disabled, .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>

    <div class="product-details-area rn-section-gapTop">
        <div class="container">
            <div class="row g-5">

                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="product-tab-wrapper rbt-sticky-top-adjust">
                        <div class="pd-tab-inner">
                            <div class="nav rn-pd-nav rn-pd-rt-content nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-bids-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-bids" type="button" role="tab"
                                    aria-controls="v-pills-bids" aria-selected="true">
                                    <span class="rn-pd-sm-thumbnail">
                                        <img src="assets/images/portfolio/sm/portfolio-01.jpg" alt="Nft_Profile">
                                    </span>
                                </button>
                                <button class="nav-link" id="v-pills-details-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-details" type="button" role="tab"
                                    aria-controls="v-pills-details" aria-selected="false">
                                    <span class="rn-pd-sm-thumbnail">
                                        <img src="assets/images/portfolio/sm/portfolio-02.jpg" alt="Nft_Profile2">
                                    </span>
                                </button>
                                <button class="nav-link" id="v-pills-history-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-history" type="button" role="tab"
                                    aria-controls="v-pills-history" aria-selected="false">
                                    <span class="rn-pd-sm-thumbnail">
                                        <img src="assets/images/portfolio/sm/portfolio-03.jpg" alt="Nft_Profile3">
                                    </span>
                                </button>
                            </div>

                            <div class="tab-content rn-pd-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-bids" role="tabpanel"
                                    aria-labelledby="v-pills-bids-tab">
                                    <div class="rn-pd-thumbnail">
                                        <img src="assets/images/portfolio/lg/portfolio-01.jpg" alt="Nft_Profile">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-details" role="tabpanel"
                                    aria-labelledby="v-pills-details-tab">
                                    <div class="rn-pd-thumbnail">
                                        <img src="assets/images/portfolio/lg/portfolio-02.jpg" alt="Nft_Profile">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-history" role="tabpanel"
                                    aria-labelledby="v-pills-history-tab">
                                    <div class="rn-pd-thumbnail">
                                        <img src="assets/images/portfolio/lg/portfolio-03.jpg" alt="Nft_Profile">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- product image area end -->

                <div class="col-lg-5 col-md-12 col-sm-12 mt_md--50 mt_sm--60">
                    <div class="rn-pd-content-area">
                        <div class="pd-title-area">
                            <h4 class="title">{{ $auction->product->title }}</h4>
                            <div class="pd-react-area">
                                <div class="heart-count" onclick="toggleReaction({{ $auction->id }}, this)">
                                    @include('component.react-icon')
                                    <span class="number" id="reactCount-{{ $auction->id }}">{{ $auction->total_reactions }}</span>
                                </div>
                                <div class="count">
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
                            </div>
                        </div>

                        <span class="bid">Highest bid <span
                                class="price">{{ $auction->current_bid_price }}</span></span>
                        <div class="catagory-collection">
                            <div class="catagory">
                                <span>Owner </span>
                                <div class="top-seller-inner-one">
                                    <div class="top-seller-wrapper">
                                        <div class="thumbnail">
                                            <a href="#"><img src="assets/images/client/client-1.png"
                                                    alt="Nft_Profile"></a>
                                        </div>
                                        <div class="top-seller-content">
                                            <a href="#">
                                                <h6 class="ownerName">{{ $auction->owner->firstname }} {{ $auction->owner->lastname }}</h6>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @foreach($auction->product->collections as $collection)
                                <div class="collection">
                                    <span>Collection</span>
                                    <div class="top-seller-inner-one">
                                        <div class="top-seller-wrapper">
                                            <div class="thumbnail">
                                                <a href="#"><img src="assets/images/client/client-2.png" alt="Nft_Profile"></a>
                                            </div>
                                            <div class="top-seller-content">
                                                <a href="#">
                                                    <h6 class="name">{{ $collection->name }}</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <a class="btn btn-primary-alta" href="#">Unlockable content included</a>
                        <div class="rn-bid-details">
                            <div class="tab-wrapper-one">
                                <nav class="tab-button-one">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link" id="nav-bids-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-bids" type="button" role="tab"
                                            aria-controls="nav-bids" aria-selected="false">Bids</button>
                                        <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-details" type="button" role="tab"
                                            aria-controls="nav-details" aria-selected="true">Details</button>
                                        <button class="nav-link" id="nav-history-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-history" type="button" role="tab"
                                            aria-controls="nav-history" aria-selected="false">History</button>
                                    </div>
                                </nav>
                                <div class="tab-content rn-bid-content" id="nav-tabContent">
                                    <div class="tab-pane fade" id="nav-bids" role="tabpanel"
                                        aria-labelledby="nav-bids-tab">
                                        @if ($allBids && !$allBids->isEmpty())
                                            @foreach ($allBids as $bid)
                                                <div class="top-seller-inner-one">
                                                    <div class="top-seller-wrapper">
                                                        <div class="thumbnail">
                                                            <a href="#"><img
                                                                    src="{{ asset('assets/images/client/client-3.png') }}"
                                                                    alt="Profile"></a>
                                                        </div>
                                                        <div class="top-seller-content">
                                                            <span>{{ $bid->amount }}$ by <a
                                                                    href="#">{{ $bid->user->firstname }}
                                                                    {{ $bid->user->lastname }}</a></span>
                                                            <span class="count-number">
                                                                {{ $bid->created_at->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No bids have been placed for this auction.</p>
                                        @endif
                                    </div>

                                    <div class="tab-pane fade show active" id="nav-details" role="tabpanel"
                                        aria-labelledby="nav-details-tab">
                                        <!-- Content for the Details tab -->
                                        <!-- You've already included the details content in your provided HTML -->
                                    </div>
                                    <div class="tab-pane fade" id="nav-history" role="tabpanel"
                                        aria-labelledby="nav-history-tab">
                                        @if ($userBidHistory && !$userBidHistory->isEmpty())
                                            @foreach ($userBidHistory as $bid)
                                                <div class="top-seller-inner-one">
                                                    <div class="top-seller-wrapper">
                                                        <div class="thumbnail">
                                                            <a href="#"><img
                                                                    src="{{ asset('assets/images/client/client-3.png') }}"
                                                                    alt="Profile"></a>
                                                        </div>
                                                        <div class="top-seller-content">
                                                            <span>{{ $bid->amount }}$ by <a
                                                                    href="#">{{ $bid->user->firstname }}
                                                                    {{ $bid->user->lastname }}</a></span>
                                                            <span class="count-number">
                                                                {{ $bid->created_at->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No bid history.</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="place-bet-area">
                                <div class="rn-bet-create">
                                    @if ($winningBid)
                                        <div class="bid-list winning-bid">
                                            <h6 class="title">Winning Bid</h6>
                                            <div class="top-seller-inner-one">
                                                <div class="top-seller-wrapper">
                                                    <div class="thumbnail">
                                                        <a href="#"><img src="assets/images/client/client-7.png"
                                                                alt="Bidder Profile"></a>
                                                    </div>
                                                    <div class="top-seller-content">
                                                        <span class="heighest-bid">Highest bid by <a
                                                                href="#">{{ $winningBid->user->firstname }}
                                                                {{ $winningBid->user->lastname }}</a></span>
                                                        <span class="count-number">
                                                            {{ $winningBid->amount }}$
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <p>No bids have been placed.</p>
                                    @endif


                                    @php
                                        use Carbon\Carbon;
                                    @endphp

                                    @if (!$auction->is_instant)
                                            <div class="bid-list left-bid" id="auctionCountdown" data-end-time="{{ $auction->end_time }}">
                                                <h6 class="title">Auction ends in:</h6>
                                                <div class="countdown mt--15">
                                                    <!-- Countdown Timer Placeholder -->
                                                    <div class="countdown-container days">
                                                        <span class="countdown-value days-value">0</span>
                                                        <span class="countdown-heading">Days</span>
                                                    </div>
                                                    <div class="countdown-container hours">
                                                        <span class="countdown-value hours-value">0</span>
                                                        <span class="countdown-heading">Hours</span>
                                                    </div>
                                                    <div class="countdown-container minutes">
                                                        <span class="countdown-value minutes-value">0</span>
                                                        <span class="countdown-heading">Minutes</span>
                                                    </div>
                                                    <div class="countdown-container seconds">
                                                        <span class="countdown-value seconds-value">0</span>
                                                        <span class="countdown-heading">Seconds</span>
                                                    </div>
                                                </div>
                                            </div>


                                        @elseif($auction->is_instant)
                                        <p>This is an instant sale item.</p>
                                    @else
                                        <p>Auction end time is not set.</p>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-primary-alta mt--30" id="placeBidButton" data-bs-toggle="modal"
                                        data-bs-target="#placebidModal" data-auction-id="{{ $auction->id }}"
                                        data-is-instant="{{ $auction->is_instant ? 'true' : 'false' }}"
                                        data-current-bid-price="{{ $auction->current_bid_price }}"
                                        data-starting-bid-price="{{ $auction->starting_bid_price }}">
                                    Place a Bid
                                </button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="rn-popup-modal placebid-modal-wrapper modal fade" id="placebidModal" tabindex="-1" aria-hidden="true">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                data-feather="x"></i></button>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('bid.place') }}" method="POST">
                    @csrf <!-- CSRF token for security -->
                    <div class="modal-header">
                        <h3 class="modal-title">Place a bid</h3>
                    </div>
                    <div class="modal-body">
                        <p>You are about to place a bid on This Product from BidderX.</p>
                        <div class="placebid-form-box">
                            <h5 class="title">Your bid</h5>
                            <div class="bid-content">
                                <div class="bid-content-top">
                                    <div class="bid-content-left">
                                        <input id="amountInput" type="number" name="amount" required min="0.1"
                                            step="0.01">
                                        <span>$</span>
                                    </div>
                                </div>
                                <!-- Hidden input for auction_id or product_id -->
                                <input type="hidden" name="auction_id" id="auctionId" value="">
                                <div class="bid-content-mid">
                                    <div class="bid-content-left">
                                        <span>Your Balance</span>
                                        <span>Service fee</span>
                                        <span>Total bid amount</span>
                                    </div>
                                    <div class="bid-content-right">
                                        <span>{{ auth()->user()->walletBalance }} $ </span>
                                        <span>10 $</span>
                                        <span id="totalBidAmount">9588 $</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bit-continue-button">
                                <button type="submit" class="btn btn-primary w-100">Place a bid</button>
                                <button type="button" class="btn btn-primary-alta mt--10"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var placeBidButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-auction-id]');

        placeBidButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const auctionId = button.getAttribute('data-auction-id');
                const isInstant = button.getAttribute('data-is-instant') === 'true'; // Ensure this data attribute is set in the HTML button element
                const currentBidPrice = parseFloat(button.getAttribute('data-current-bid-price'));
                const startingBidPrice = parseFloat(button.getAttribute('data-starting-bid-price')); // Ensure this data attribute is also set

                const inputAuctionId = document.getElementById('auctionId');
                const amountInput = document.getElementById('amountInput'); // Get the input for the bid amount

                if (inputAuctionId) {
                    inputAuctionId.value = auctionId;
                }

                if (amountInput) {
                    if (isInstant) {
                        amountInput.value = currentBidPrice ? currentBidPrice + 1 : startingBidPrice + 1;
                    } else {
                        amountInput.value = currentBidPrice ? currentBidPrice + 0.1 : 0.1;
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const countdownElement = document.getElementById('auctionCountdown');
            const placeBidButton = document.getElementById('placeBidButton');
            const isInstant = {{ $auction->is_instant ? 'true' : 'false' }};
            const hasCurrentBidPrice = {{ is_null($auction->current_bid_price) ? 'false' : 'true' }};

            const bidAmountInput = document.getElementById('amountInput');
            const totalBidDisplay = document.getElementById('totalBidAmount');
            const serviceFee = 10;

            function updateTotalBid() {
                const bidAmount = parseFloat(bidAmountInput.value);
                if (!isNaN(bidAmount)) {
                    const totalBidAmount = bidAmount + serviceFee;
                    totalBidDisplay.textContent = `${totalBidAmount.toFixed(2)} $`; // Format to 2 decimal places
                } else {
                    totalBidDisplay.textContent = `0.00 $`; // Default display if input is not a number
                }
            }

            bidAmountInput.addEventListener('input', updateTotalBid);

            updateTotalBid();

            if (isInstant && hasCurrentBidPrice) {
                placeBidButton.disabled = true;
                placeBidButton.classList.add('disabled');
            }

            if (!countdownElement) return;

            const endTime = new Date(countdownElement.getAttribute('data-end-time')).getTime();

            function updateCountdown() {
                const now = new Date().getTime();
                const timeLeft = endTime - now;

                if (timeLeft >= 0) {
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    document.querySelector('.days-value').innerText = days;
                    document.querySelector('.hours-value').innerText = hours;
                    document.querySelector('.minutes-value').innerText = minutes;
                    document.querySelector('.seconds-value').innerText = seconds;
                } else {
                    clearInterval(countdownTimer);
                    countdownElement.innerHTML = "<p>Auction has ended.</p>";
                    placeBidButton.disabled = true;
                    placeBidButton.classList.add('disabled');
                }
            }

            // Update the countdown every 1 second
            const countdownTimer = setInterval(updateCountdown, 1000);

            // Initialize immediately
            updateCountdown();
        });
    </script>
@endsection
