{{-- Extend the main layout --}}
@extends('layouts.usersLayout.MainLayout')

{{-- Define the content section --}}
@section('content')
<div class="welcome-page">
    <div class="container">
        <h1>Welcome to Our Application!</h1>
        <p>This is a simple welcome page for our Laravel application.</p>

        {{-- Navigation Links --}}
        <div class="navigation-links">
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-success">Register</a>
        </div>
    </div>
</div>
@endsection

{{-- Optional: Custom Styles for the Welcome Page --}}
@push('styles')
<style>
    .welcome-page {
        text-align: center;
        padding: 50px 0;
    }
    .navigation-links {
        margin-top: 20px;
    }
    .btn {
        margin: 0 10px;
    }
</style>
@endpush
