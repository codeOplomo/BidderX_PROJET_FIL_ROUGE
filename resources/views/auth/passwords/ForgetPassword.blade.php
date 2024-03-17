@extends('layouts.usersLayout.MainLayout')


@section('content')

<div class="forget-password-area rn-section-gapTop">
    <div class="container">
        <div class="row g-5">
            <div class="offset-lg-4 col-lg-4">
                <div class="form-wrapper-one">

                    <div class="logo-thumbnail logo-custom-css mb--50">
                        <a class="logo-light" href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/logo-white.png') }}" alt="nft-logo"></a>
                        <a class="logo-dark" href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="nft-logo"></a>
                    </div>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-5">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" id="exampleInputEmail1" name="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="mb-5">
                            <input type="checkbox" class="rn-check-box-input" id="exampleCheck1">
                            <label class="rn-check-box-label" for="exampleCheck1">I agree to the <a href="{{ url('privacy-policy') }}">privacy policy</a></label>
                        </div>

                        <div class="mb-5">
                            <button type="submit" class="btn btn-large btn-primary">Send</button>
                        </div>
                    </form>

                    <span class="mt--20 notice">Note: We will send a password reset link to your email</span>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection