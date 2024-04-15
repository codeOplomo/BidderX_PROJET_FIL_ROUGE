@extends('layouts.usersLayout.MainLayout')

@section('content')

    <div class="rn-not-found-area rn-section-gapTop">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rn-not-found-wrapper">
                        <h1><b>Unauthorized</b></h1>
                        <h3 class="title"></h3>
                        <p>You are not allowed to access this page.</p>
                        <p>You do not have permission to access this page. Please contact the administrator if you believe this is an error.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary btn-large">Go Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
