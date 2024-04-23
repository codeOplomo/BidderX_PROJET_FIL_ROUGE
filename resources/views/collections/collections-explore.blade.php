@extends('layouts.usersLayout.MainLayout')

@section('content')

    <div class="rn-product-area rn-section-gapTop">
        <div class="container">
            <div class="row mb--50 align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Explore Collections</h3>
                </div>
            </div>
    <div class="row g-5" id="auctions-section">
        <!-- Loop through your products to display them dynamically -->
        @foreach($collections as $collection)
            @include('component.collection-card')
        @endforeach
        <!-- End loop -->
    </div>
        </div>
    </div>

@endsection
