{{-- Extend the main layout --}}
@extends('layouts.usersLayout.MainLayout')

{{-- Define the content section --}}
@section('content')
<div class="registration-form">
    <div class="form-container">
        {{-- Form action points to Laravel's login route --}}
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf {{-- Include CSRF token for security --}}

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="error-message" role="alert">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                @error('password')
                    <span class="error-message" role="alert">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember Me Checkbox --}}
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }}> Remember me
                    </label>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="submit-button">Login</button>
                @if (Route::has('password.request'))
                <a class="btn start-button" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
                @endif
            </div>

            {{-- Registration Link --}}
            <div class="create-account">
                <a href="{{ route('register') }}" class="btn start-button">Don't have an account?</a>
            </div>
        </form>
    </div>
    <div class="image-container">
        <h3 class="text-center" style="color: #E9E0CE">Login</h3>
        <img src="https://picsum.photos/200" alt="Random Image from Lorem Picsum">
    </div>
</div>
@endsection
