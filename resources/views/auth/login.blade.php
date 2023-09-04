@extends('layouts.app')

@section('content')

<link href="{{ asset('css/login-register.css') }}" rel="stylesheet">

<div class="container-fluid py-5 h-100 mb-5 auth-form">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-10">
            <div class="card rounded-3 text-black auth-card">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4 align-items-center" style="height: 100%;">

                            <div class="text-center">

                                <h4 class="mt-2 pb-1">MYCOFFEE Login</h4>
                            </div>
                            <form class="d-flex flex-column justify-content-center" style="height: 100%;" method="POST"
                                action="{{ route('login') }}">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        autofocus />

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="password" class="form-control @error('password')
                                        is-invalid @enderror" name="password" required autocomplete="current-password"
                                        placeholder="Password" />

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row mb-3 align-items-left">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-left pt-1 mb-5 pb-1">
                                    <button class="btn btn-block fa-lg mb-3 login-btn w-100"
                                        type="submit">Login</button>
                                    @if (Route::has('password.request'))
                                    <a class="text-muted" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center justify-content-center pb-4">
                                    <p class="mb-0 me-2">Don't have an account?</p>
                                    <a class="route-btn register-route-btn-width" href="{{ route('register') }}"><span
                                            class="route-btn-text">Register Now</span></a>
                                </div>

                            </form>

                        </div>
                    </div>
                    <div class="col-lg-6 d-flex">
                        <div class="video-wrapper login-video-wrapper-border">
                            <video playsinline autoplay muted loop>
                                <source src="video/video-6.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection