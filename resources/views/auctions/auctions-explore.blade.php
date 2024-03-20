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
                        <!-- Your dynamic author and share buttons -->
                    </div>
                    <a href="{{ route('product.details', $auction->id) }}"><span class="product-name">{{ $auction->product->title }}</span></a>
                    <span class="latest-bid">Highest bid {{ $auction->current_bid_price }}/{{ $auction->total_bids }}</span>
                    <div class="bid-react-area">
                        <div class="last-bid">{{ $auction->current_bid_price }}</div>
                        <div class="react-area" onclick="toggleReaction({{ $auction->id }}, this)">
                            <svg viewBox="0 0 17 16" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN kBvkOu">
                                <path d="M8.2112 14L12.1056 9.69231L14.1853 7.39185C15.2497 6.21455 15.3683 4.46116 14.4723 3.15121V3.15121C13.3207 1.46757 10.9637 1.15351 9.41139 2.47685L8.2112 3.5L6.95566 2.42966C5.40738 1.10976 3.06841 1.3603 1.83482 2.97819V2.97819C0.777858 4.36443 0.885104 6.31329 2.08779 7.57518L8.2112 14Z" stroke="currentColor" stroke-width="2"></path>
                            </svg>
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
