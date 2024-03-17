
@extends('layouts.usersLayout.MainLayout')


@section('content')
<div class="login-area rn-section-gapTop">
    <div class="container">
        <div class="row g-5">
            <div class=" offset-2 col-lg-4 col-md-6 ml_md--0 ml_sm--0 col-sm-12">
                <div class="form-wrapper-one">
                    <h4>Login</h4>
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf {{-- Include CSRF token for security --}}
                        <div class="mb-5">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" id="exampleInputEmail1" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="error-message" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" id="exampleInputPassword1" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                            @error('password')
                                <span class="error-message" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5 rn-check-box">
                            <input type="checkbox" class="rn-check-box-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="rn-check-box-label" for="remember">Remember me later</label>
                        </div>
                        <div class="mb-5">
                            <a class="btn start-button" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                        <button type="submit" class="btn btn-primary mr--15">Log In</button>
                        <a href="{{ route('register') }}" class="btn btn-primary-alta">Sign Up</a>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="social-share-media form-wrapper-one">
                    <h6>Another way to log in</h6>
                    <p> Lorem ipsum dolor sit, amet sectetur adipisicing elit.cumque.</p>
                    <button class="another-login login-facebook"> <img class="small-image" src="assets/images/icons/google.png" alt=""> <span>Log in with Google</span></button>
                    <button class="another-login login-facebook"> <img class="small-image" src="assets/images/icons/facebook.png" alt=""> <span>Log in with Facebook</span></button>
                    <button class="another-login login-twitter"> <img class="small-image" src="assets/images/icons/tweeter.png" alt=""> <span>Log in with Twitter</span></button>
                    <button class="another-login login-linkedin"> <img class="small-image" src="assets/images/icons/linkedin.png" alt=""> <span>Log in with LinkedIn</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- Submit Button --}}
{{-- <div class="d-flex justify-content-between mt-4">
    <button type="submit" class="submit-button">Login</button>
    @if (Route::has('password.request'))
    <a class="btn start-button" href="{{ route('password.request') }}">
        Forgot Your Password?
    </a>
    @endif
</div> --}}