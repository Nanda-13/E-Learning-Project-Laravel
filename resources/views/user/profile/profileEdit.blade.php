@extends('user.layouts.master')

@section('content')
@include('user.section.navBar')

<!-- Header Start -->
<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
            <h3 class="display-4 text-white text-uppercase">Profile Edit</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('user#home') }}">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase"><a  class="text-white" href="{{ route('user#profile#page') }}">Profile</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Profile Edit</p>
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
                        <h2 class="text-center text-primary">Personal Edit</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user#profile#edit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-5">
                                    <img class="img-fluid rounded mb-4 mb-lg-1 w-100" src="{{ asset('MasterImage/profile.jpg') }}" alt="" id="output">
                                    <input type="file" name="profile" class="form-control" onchange="loadFile(event)">
                                </div>
                                <div class="col-7">
                                    <div class="mb-3">
                                        <label for="" class="form-label h5">Full Name</label>
                                        <input type="text" class="form-control bg-light @error('name') is-invalid @enderror" name="name" placeholder="Enter Full Name..."
                                        value="{{ old('name', Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name ) }}" />
                                        @error('name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    @if ( Auth::user()->provider == 'simple' )
                                        <div class="mb-3">
                                            <label for="" class="form-label h5">Email</label>
                                            <input type="text" class="form-control bg-light @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email', Auth::user()->email) }}" />
                                            @error('email')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <label for="" class="form-label h5">Email</label>
                                            <input type="text" class="form-control bg-light" name="email"
                                            value="{{ Auth::user()->email }}" readonly />
                                    @endif

                                    <div class="my-3">
                                        <label for="" class="form-label h5">Phone</label>
                                        <input type="text" class="form-control bg-light @error('phone') is-invalid @enderror" name="phone" placeholder="Enter Phone Number..."
                                        value="{{ old('phone', Auth::user()->phone) }}" />
                                        @error('phone')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="my-3">
                                        <label for="" class="form-label h5">Address</label>
                                        <textarea class="form-control bg-light @error('address') is-invalid @enderror" rows="4" name="address" placeholder="Enter Address..." >{{ old('address', Auth::user()->address) }}</textarea>
                                        @error('address')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2 w-100"><i class="fa-solid fa-pen-to-square mr-2"></i>Profile Update</button>
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

<script>
    function loadFile(event) {
        var reader = new FileReader()
        reader.onload = function() {
            var output = document.getElementById('output')
            output.src = reader.result
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
