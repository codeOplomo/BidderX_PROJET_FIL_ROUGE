{{-- Extend the main layout --}}
@extends('layouts.usersLayout.MainLayout')

{{-- Define the content section --}}
@section('content')
<div class="registration-form">
    <div class="image-container">
        <h3 class="text-center" style="color: #E9E0CE">Registration Info</h3>
        <img src="https://picsum.photos/200" alt="Random Image from Lorem Picsum">
    </div>
    <div class="form-container">
        {{-- Form action points to the route handling registration (web.php) --}}
        <form action="{{ route('register.submit') }}" method="POST">
            @csrf {{-- Include CSRF token for security --}}

            {{-- First Name --}}
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input id="firstname" name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                @error('firstname')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Last Name --}}
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input id="lastname" name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" required autocomplete="lastname">
                @error('lastname')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password Confirmation --}}
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required autocomplete="new-password">
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="submit-button">Register</button>
                <div class="already-have-account">
                    <a href="{{ route('login') }}" class="btn start-button">Already have an account?</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
