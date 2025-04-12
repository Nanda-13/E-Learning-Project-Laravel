@extends('user.layouts.master')

@section('content')
@include('user.section.navBar')

<!-- Header Start -->
<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
            <h3 class="display-4 text-white text-uppercase">Change Password</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('user#home') }}">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase"><a  class="text-white" href="{{ route('user#profile#page') }}">Profile</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Change Password</p>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<div class="container-fluid pt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col" style="margin: 0px 200px">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center text-primary">Change Password</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user#profile#changePassword') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label h5">Current Password</label>
                                        <input type="password" class="form-control bg-light @error('currentPassword') is-invalid @enderror" name="currentPassword" placeholder="Enter Current Password..." />
                                        @error('currentPassword')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label h5">New Password</label>
                                        <input type="password" class="form-control bg-light @error('newPassword') is-invalid @enderror" name="newPassword" placeholder="Enter New Password..." />
                                        @error('newPassword')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label h5">Confirm Password</label>
                                        <input type="password" class="form-control bg-light @error('confirmPassword') is-invalid @enderror" name="confirmPassword" placeholder="Enter Confirm Password..." />
                                        @error('confirmPassword')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-dark py-md-2 px-md-4 font-weight-semi-bold mt-2 w-100"><i class="fa-solid fa-unlock-keyhole mr-2"></i>Change Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection

@section('js-content')

@if (Session::has('pwError'))

    <script>
        toastr.options = {
            "progressBar" : true ,
            "closeButton" : true ,
        }
        toastr.error("{{ Session::get('pwError') }}", 'Fail Change Password!', { timeout: 12000 });
    </script>

@endif

@endsection
