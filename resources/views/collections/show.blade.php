@extends('layouts.usersLayout.MainLayout')


@section('content')

    <div class="rn-collection-area rn-section-gapTop">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h3 class="title mb-0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800" style="opacity: unset">Explore {{ $collection->name }} Collection</h3>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <img src="{{ $collection->getFirstMediaUrl('blog_cover_image') ?: asset('assets/images/default-cover-image.jpg') }}" class="img-fluid rounded" alt="Cover Image">
                        </div>
                        <div class="col-md-6">
                            <img src="{{ $collection->getFirstMediaUrl('blog_logo_image') ?: asset('assets/images/default-logo-image.jpg') }}" class="img-fluid rounded" alt="Logo Image">
                        </div>
                    </div>
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
