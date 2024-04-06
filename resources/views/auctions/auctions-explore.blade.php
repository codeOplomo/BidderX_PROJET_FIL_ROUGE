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

        <div class="row g-5" id="auctions-section">
            <!-- Loop through your products to display them dynamically -->
            @foreach($auctions as $auction)
                @include('component.auction-card')
            @endforeach
            <!-- End loop -->
        </div>
    </div>
</div>
<!-- End product area -->





@endsection
