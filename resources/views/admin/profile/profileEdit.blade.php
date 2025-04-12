@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <a href="{{ route('admin#profile#page') }}" class=" text-dark text-decoration-none">Profile</a> / <span class="text-primary">Edit Profile</span>
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
                                                    <h3 class="card-title text-center">Edit Personal Details</h3>
                                                </div>
                                                <form action="{{ route('admin#profile#edit') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-4 mx-5">
                                                                <img src="{{ asset( Auth::user()->profile != null ? '/ProfileImage/' . Auth::user()->profile : 'MasterImage/undraw_profile.svg' ) }}" class=" img-fluid w-100 rounded-circle" id="output">
                                                                <input type="file" name="profile" onchange="loadFile(event)" class="form-control mt-3" @error('profile') is-invalid @enderror >
                                                                @error('profile')
                                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="col-6">

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Name</label>
                                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Enter User Name...">
                                                                    @error('name')
                                                                        <small class=" invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Email</label>
                                                                    @if ( Auth::user()->role == 'superadmin' )
                                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Enter User Email...">
                                                                        @error('email')
                                                                            <small class=" invalid-feedback">{{ $message }}</small>
                                                                        @enderror
                                                                    @else
                                                                        <input type="email" class="form-control bg-light @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Enter User Email..." readonly>
                                                                        @error('email')
                                                                            <small class=" invalid-feedback">{{ $message }}</small>
                                                                        @enderror
                                                                    @endif
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Phone</label>
                                                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Enter User Phone...">
                                                                    @error('phone')
                                                                        <small class=" invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Address</label>
                                                                    <textarea name="address" cols="10" rows="5" class="form-control @error('address') is-invalid @enderror" placeholder="Enter User Address...">{{ old('address', Auth::user()->address) }}</textarea>
                                                                    @error('address')
                                                                        <small class=" invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="col">
                                                                    <button type="submit" class="btn btn-warning my-3 w-100">
                                                                        Update Profile
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

<script>
    function loadFile(event){
        var reader = new FileReader()
        reader.onload = function(){
            var output = document.getElementById("output")
            output.src = reader.result
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
