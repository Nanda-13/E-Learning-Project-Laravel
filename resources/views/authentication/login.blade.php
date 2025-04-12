@extends('authentication.layouts.master')


@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-5 col-12 mx-auto">
                <form class="custom-form login-form" method="post" action="{{ route('login') }}">
                    @csrf
                    <h3 class="hero-title text-center mb-4 pb-2">Welcome To Online Learning</h3>

                    <div class="form-floating mb-4 p-0">
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email address" value="{{ old('email') }}">
                            @error('email')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                        <label for="email">Email address</label>
                    </div>

                    <div class="form-floating p-0">
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password">
                            @error('password')
                                <small class="invalid-feedback mb-5">{{ $message }}</small>
                            @enderror

                        <label for="password">Password</label>
                    </div>

                    {{-- <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                        <label class="form-check-label" for="flexCheckDefault">
                            Remember me
                        </label>
                    </div> --}}

                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5 col-12">
                            <button type="submit" class="form-control">Login</button>
                        </div>

                        <div class="col-lg-5 col-12">
                            <a href="{{ route('register') }}" class="btn custom-btn custom-border-btn">Register</a>
                        </div>
                    </div>

                    <div class="row justify-content-center align-items-center mt-4">

                        <div class="col-12 text-center">
                            <h6 class="text-white mb-4">Or Login With</h6>
                        </div>

                        <div class="col-lg-4 col-12">
                            <a href="{{ url('/auth/facebook/redirect') }}" class="btn btn-primary w-100"
                                style="border-radius: var(--border-radius-large)">
                                <i class="bi bi-facebook me-2"></i> Facebook
                            </a>
                        </div>

                        <div class="col-lg-4 col-12">
                            <a href="{{ url('/auth/google/redirect') }}" class="btn btn-danger w-100"
                                style="border-radius: var(--border-radius-large)">
                                <i class="bi bi-google me-2"></i> Google
                            </a>
                        </div>

                        <div class="col-lg-4 col-12">
                            <a href="" class="btn btn-dark w-100" style="border-radius: var(--border-radius-large)">
                                <i class="bi bi-github me-2"></i> GitHub
                            </a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
