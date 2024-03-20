@extends('layouts.usersLayout.MainLayout')

@section('content')

<!-- Start product area -->
<div class="rn-product-area rn-section-gapTop">
    <div class="container">
        <div class="row mb--50 align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Explore Product</h3>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--15">
                <div class="view-more-btn text-start text-sm-end" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <button class="discover-filter-button discover-filter-activation btn btn-primary">Filter<i class="feather-filter"></i></button>
                </div>
            </div>
        </div>

        <div class="default-exp-wrapper default-exp-expand">
            <div class="inner">
                <div class="filter-select-option">
                    <label class="filter-leble">LIKES</label>
                    <select>
                        <option data-display="Most liked">Most liked</option>
                        <option value="1">Least liked</option>
                    </select>
                </div>

                <div class="filter-select-option">
                    <label class="filter-leble">Category</label>
                    <select>
                        <option data-display="Category">Category</option>
                        <option value="1">Art</option>
                        <option value="1">Photograph</option>
                        <option value="2">Metaverses</option>
                        <option value="4">Potato</option>
                        <option value="4">Photos</option>
                    </select>
                </div>

                <div class="filter-select-option">
                    <label class="filter-leble">Collections</label>
                    <select>
                        <option data-display="Collections">Collections</option>
                        <option value="1">BoredApeYachtClub</option>
                        <option value="2">MutantApeYachtClub</option>
                        <option value="4">Art Blocks Factory</option>
                    </select>
                </div>

                <div class="filter-select-option">
                    <label class="filter-leble">Sale type</label>
                    <select>
                        <option data-display="Sale type">Sale type</option>
                        <option value="1">Fixed price</option>
                        <option value="2">Timed auction</option>
                        <option value="4">Not for sale</option>
                        <option value="4">Open for offers</option>
                    </select>
                </div>

                <div class="filter-select-option">
                    <label class="filter-leble">Price Range</label>
                    <div class="price_filter s-filter clear">
                        <form action="#" method="GET">
                            <div id="slider-range"></div>
                            <div class="slider__range--output">
                                <div class="price__output--wrap">
                                    <div class="price--output">
                                        <span>Price :</span><input type="text" id="amount" readonly>
                                    </div>
                                    <div class="price--filter">
                                        <a class="btn btn-primary btn-small" href="#">Filter</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <!-- Loop through your products to display them dynamically -->
            @foreach($auctions as $auction)
            <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="product-style-one no-overlay  with-placeBid">
                    <div class="card-thumbnail">
                        <a href="{{ route('product.details', $auction->id) }}"><img src="{{ asset($auction->image) }}" alt="{{ $auction->name }}"></a>
                        <a href="{{ route('product.details', $auction->id) }}" class="btn btn-primary">Place Bid</a>
                    </div>
                    <div class="product-share-wrapper">
                        <div class="profile-share">
                            <a href="author.html" class="avatar" data-tooltip="Jone lee"><img src="assets/images/client/client-1.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Jone Due"><img src="assets/images/client/client-2.png" alt="Nft_Profile"></a>
                            <a href="author.html" class="avatar" data-tooltip="Nisat Tara"><img src="assets/images/client/client-3.png" alt="Nft_Profile"></a>
                            <a class="more-author-text" href="#">
                                {{ $auction->uniqueBidderCount - 1 }}+ Place Bit.
                            </a>
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
                    <a href="{{ route('product.details', $auction->id) }}"><span class="product-name">{{ $auction->product->title }}</span></a>
                    <span class="latest-bid">Highest bid {{ $auction->current_bid_price }}/{{ $auction->total_bids }}</span>
                    <div class="bid-react-area">
                        <div class="last-bid">{{ $auction->current_bid_price }}</div>
                        <div class="react-area" onclick="toggleReaction({{ $auction->id }}, this)">
                            @include('component.react-icon')
                            <span class="number" id="reactCount-{{ $auction->id }}">
            {{ $auction->total_reactions }}
        </span> {{-- Display the total reactions dynamically --}}
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
            <!-- End loop -->
        </div>
    </div>
</div>
<!-- End product area -->





@endsection
