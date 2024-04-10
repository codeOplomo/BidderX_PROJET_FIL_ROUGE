@extends('layouts.usersLayout.MainLayout')

@section('content')

    <div class="rn-not-found-area rn-section-gapTop">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rn-not-found-wrapper">
                        <h2 class="large-title">Unauthorized</h2>
                        <h3 class="title"></h3>
                        <p>You are not allowed to access this page.</p>
                        <a href="index.html" class="btn btn-primary btn-large">Go Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
