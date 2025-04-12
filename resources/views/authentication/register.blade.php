@extends('authentication.layouts.master')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-12 mx-auto">
                <form class="custom-form" method="post" action="{{ route('register') }}">
                    @csrf
                    <h2 class="hero-title text-center mb-4 pb-2">Create an account</h2>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating">
                                <input type="text" name="name" id="full-name" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Full Name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror

                                <label for="floatingInput">Full Name</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating mb-4 p-0">
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email address" value="{{ old('email') }}">
                                @error('email')
                                    <small class=" invalid-feedback">{{ $message }}</small>
                                @enderror

                                <label for="email">Email address</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-floating p-0">
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password">
                                @error('password')
                                    <small class=" invalid-feedback">{{ $message }}</small>
                                @enderror

                                <label for="password">Password</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-floating p-0">
                                <input type="password" name="password_confirmation" id="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Confirm Password" value="{{ old('') }}">
                                @error('password_confirmation')
                                    <small class=" invalid-feedback">{{ $message }}</small>
                                @enderror

                                <label for="password">Confirm Password</label>
                            </div>
                        </div>

                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-5 col-md-5 col-5 ms-auto">
                                <button type="submit" class="form-control">Submit</button>
                            </div>

                            <div class="col-lg-6 col-md-6 col-7">
                                <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="ms-2">Login</a></p>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
