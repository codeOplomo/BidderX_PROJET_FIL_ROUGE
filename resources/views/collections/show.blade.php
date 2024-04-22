@extends('layouts.usersLayout.MainLayout')


@section('content')
    <style>
        .about-fluidimg {
            position: relative;
            border: 30px solid #231A00;
        }

        .logo-image-wrapper {
            position: absolute;
            bottom: 50px;
            left: 50px;
            width: 250px;
        }

        .logo-image-wrapper img {
            border-radius: 50% !important;
            border: 10px solid #231A00;
            width: 100%;
            height: auto;
        }
    </style>


    <div class="rn-collection-area">
        <div class="container">
            <div class="rn-about-banner-area">
                <div class="container mb--30">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="title about-title-m" data-sal="slide-up" data-sal-duration="800" data-sal-delay="150" style="opacity: unset">Explore <span style="color: #e17009"> {{ $collection->name }} </span>Collection</h2>
                        </div>
                    </div>
                </div>
                <div class="about-fluidimg" style="background-image: url('{{ $collection->getFirstMediaUrl('blog_cover_image') ?: asset('assets/images/default-cover-image.jpg') }}'); height: 500px; background-size: cover; background-repeat: no-repeat; background-position: center;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 offset-md-6 collection-big-thumbnail">
                                <!-- Wrapper for the logo image for positioning -->
                                <div class="logo-image-wrapper">
                                    <img src="{{ $collection->getFirstMediaUrl('blog_logo_image') ?: asset('assets/images/default-logo-image.jpg') }}" class="img-fluid rounded" alt="Logo Image">
                                </div>
                            </div>
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
