@extends('layouts.usersLayout.MainLayout')

@section('content')

    <div class="rn-not-found-area rn-section-gapTop">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rn-not-found-wrapper">
                        <h2 class="large-title">404</h2>
                        <h3 class="title">Page not found!</h3>
                        <p>The page you are looking for not available.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary btn-large">Go Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
