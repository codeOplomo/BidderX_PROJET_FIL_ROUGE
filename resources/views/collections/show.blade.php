@extends('layouts.usersLayout.MainLayout')


@section('content')

<div class="rn-collection-area rn-section-gapTop">
    <div class="container">
        <div class="row mb--50 align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h3 class="title mb--0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800" style="opacity: unset">Explore {{ $collection->name }} Collection</h3>
            </div>
        </div>

        <div class="row g-5">

            @foreach($collection->products as $product)
                @include('component.product-card')
            @endforeach
        </div>
    </div>
</div>

@endsection
