@extends('layouts.usersLayout.MainLayout')

@section('content')

    <!-- Start product area -->
    <div class="rn-product-area rn-section-gapTop">
        <div class="container">
            <div class="row mb--50 align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Explore Instant Auctions</h3>
                </div>
            </div>
            <div class="row g-5">
                @foreach($instantAuctions as $auction)
                    @include('component.auction-card')
                @endforeach
            </div>
        </div>
    </div>
    <!-- End product area -->
@endsection
