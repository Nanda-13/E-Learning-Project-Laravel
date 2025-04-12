@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <a href="{{ route('admin#profile#page') }}" class=" text-dark text-decoration-none">Profile</a> / <span class="text-primary">Change Password</span>
        </h3>
    </div>
    <!-- App Hero header ends -->

    <!-- App body starts -->
    <div class="app-body">

        <!-- Row start -->
        <div class="row">
            <div class="col-xxl-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="custom-tabs-container">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                    <!-- Row start -->
                                    <div class="row" style="margin: 0px 200px">
                                        <div class="col-12">
                                            <div class="card shadow mb-4">
                                                <div class="card-header">
                                                    <h3 class="card-title text-center">Change Password</h3>
                                                </div>
                                                <form action="{{ route('admin#profile#changePassword') }}" method="POST">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col">

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Current Password</label>
                                                                    <input type="password" class="form-control @error('currentPassword') is-invalid @enderror" name="currentPassword" placeholder="Enter Current Password...">
                                                                    @error('currentPassword')
                                                                        <small class=" invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">New password</label>
                                                                    <input type="password" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword" placeholder="Enter New Password...">
                                                                    @error('newPassword')
                                                                        <small class=" invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Confirm Password</label>
                                                                    <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" name="confirmPassword" placeholder="Enter Confirm Password...">
                                                                    @error('confirmPassword')
                                                                        <small class=" invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="col">
                                                                    <button type="submit" class="btn btn-danger my-3 w-100">
                                                                        Change Password
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Row end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

    </div>
    <!-- App body ends -->
@endsection

@section('js-content')

    @if (Session::has('pwError'))

    <script>
        toastr.options = {
            "progressBar" : true ,
            "closeButton" : true ,
        }
        toastr.error("{{ Session::get('pwError') }}", 'Error!', { timeout: 12000 });
    </script>

    @endif

@endsection
