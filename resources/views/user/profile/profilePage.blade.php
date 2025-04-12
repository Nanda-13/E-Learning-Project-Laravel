@extends('user.layouts.master')

@section('content')
@include('user.section.navBar')

<!-- Header Start -->
<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
            <h3 class="display-4 text-white text-uppercase">Profile</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('user#home') }}">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Profile</p>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<div class="container-fluid pt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center text-primary">Personal Detail</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <img class="img-fluid rounded mb-4 mb-lg-0 w-100 h-100" src="{{ asset( Auth::user()->profile == null ? 'MasterImage/profile.jpg' : 'ProfileImage/' . Auth::user()->profile ) }}" alt="">
                            </div>
                            <div class="col-7">
                                <div class="mb-3">
                                    <label for="" class="form-label h5">Full Name</label>
                                    <input type="text" class="form-control bg-light"
                                    value="{{ Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name }}" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label h5">Email</label>
                                    <input type="text" class="form-control bg-light"
                                    value="{{ Auth::user()->email }}" readonly />
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2">
                                            <label for="" class="form-label h5">Phone</label>
                                            <input type="text" class="form-control bg-light"
                                            value="{{ Auth::user()->phone }}" readonly />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-2">
                                            <?php
                                                $login = Str::ucfirst(Auth::user()->provider);
                                            ?>

                                            @if ( $login == 'Simple' )
                                                <label for="" class="form-label h5">Login</label>
                                                <input type="text" class="form-control bg-success text-white"
                                                value="{{ $login }}" readonly />
                                            @elseif ( $login == 'Google' )
                                                <label for="" class="form-label h5">Login</label>
                                                <input type="text" class="form-control bg-danger text-white"
                                                value="{{ $login }}" readonly />
                                            @elseif ( $login == 'Facebook' )
                                                <label for="" class="form-label h5">Login</label>
                                                <input type="text" class="form-control text-white" style="background-color: #1877F2"
                                                value="{{ $login }}" readonly />
                                            @else
                                                <label for="" class="form-label h5">Login</label>
                                                <input type="text" class="form-control bg-dark text-white"
                                                value="{{ $login }}" readonly />
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="" class="form-label h5">Address</label>
                                    <textarea class="form-control bg-light" rows="3" readonly >{{ Auth::user()->address }}</textarea>
                                </div>

                                @if ( Auth::user()->provider == 'simple' )
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('user#profile#edit#page') }}" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2 w-100"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit Profile</a>
                                        </div>

                                        <div class="col">
                                            <a href="{{ route('user#profile#changePassword#page') }}" class="btn btn-dark py-md-2 px-md-4 font-weight-semi-bold mt-2 w-100"><i class="fa-solid fa-unlock-keyhole mr-2"></i>Change Password</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('user#profile#edit#page') }}" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2 w-100"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit Profile</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection

@section('js-content')

    @if (Session::has('update'))

    <script>
        toastr.options = {
            "progressBar" : true ,
            "closeButton" : true ,
        }
        toastr.warning("{{ Session::get('update') }}", 'Update!', { timeout: 12000 });
    </script>

    @endif

    @if (Session::has('pwSuccess'))

    <script>
        toastr.options = {
            "progressBar" : true ,
            "closeButton" : true ,
        }
        toastr.info("{{ Session::get('pwSuccess') }}", 'Success Change Password!', { timeout: 12000 });
    </script>

    @endif

@endsection
