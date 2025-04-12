@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class="text-dark text-decoration-none">Home</a> / <span class=" text-primary">Profile</span>
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
                                    <div class="row">
                                        <div class=" col-12">
                                            <div class="card shadow mb-4">
                                                <div class="card-header">
                                                    <h3 class="card-title text-center">Personal Details</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4 mx-5">
                                                            <img src="{{ asset( Auth::user()->profile != null ? '/ProfileImage/' . Auth::user()->profile : 'MasterImage/undraw_profile.svg' ) }}" class=" img-fluid rounded-circle w-100">
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Full Name</label>
                                                                <input type="text" class="form-control bg-light" name="name" id="name"
                                                                    value="{{ Auth::user()->name }}" readonly />
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="emailId" class="form-label">Email</label>
                                                                <input type="email" class="form-control bg-light" id="emailId"
                                                                    value="{{ Auth::user()->email }}" readonly />
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="contactNumber"
                                                                    class="form-label">Phone</label>
                                                                <input type="text" class="form-control bg-light" name="phone"
                                                                    id="contactNumber" value="{{ Auth::user()->phone }}" readonly />
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="Role" class="form-label">Role</label>
                                                                <div class="input-group">
                                                                    <input type="email" class="form-control bg-light" id="emailId"
                                                                    value="{{ Auth::user()->role }}" readonly />
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <label class="form-label">Address</label>
                                                                <textarea class="form-control bg-light" rows="3" readonly >{{ Auth::user()->address }}</textarea>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col">
                                                                    <a href="{{ route('admin#profile#edit#page') }}" class="btn btn-warning w-100">
                                                                        Edit Profile
                                                                    </a>
                                                                </div>
                                                                <div class="col">
                                                                    <a href="{{ route('admin#profile#changePassword#page') }}" class="btn btn-danger w-100">
                                                                        Change Password
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
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

    @if (Session::has('message'))

    <script>
        toastr.options = {
            "progressBar" : true ,
            "closeButton" : true ,
        }
        toastr.success("{{ Session::get('message') }}", 'Success!', { timeout: 12000 });
    </script>

    @endif

    @if (Session::has('pwSuccess'))

    <script>
        toastr.options = {
            "progressBar" : true ,
            "closeButton" : true ,
        }
        toastr.success("{{ Session::get('pwSuccess') }}", 'Success!', { timeout: 12000 });
    </script>

    @endif

@endsection
