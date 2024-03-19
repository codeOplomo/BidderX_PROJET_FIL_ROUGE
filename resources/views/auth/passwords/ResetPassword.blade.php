@extends('layouts.usersLayout.MainLayout')

@section('content')

<div class="reset-password-area rn-section-gapTop">
    <div class="container">
        <div class="row g-5">
            <div class="offset-lg-4 col-lg-4">
                <div class="form-wrapper-one">

                    <div class="logo-thumbnail logo-custom-css mb--50">
                        <a class="logo-light" href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/logo-white.png') }}" alt="nft-logo"></a>
                        <a class="logo-dark" href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="nft-logo"></a>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your new password">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your new password">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-large w-100">Reset Password</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
