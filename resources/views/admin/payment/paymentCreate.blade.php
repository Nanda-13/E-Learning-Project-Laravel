@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <span class=" text-dark text-decoration-none">Payment</span> / <span class="text-primary">Payment Create</span>
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
                                                <div class="card-header d-flex justify-content-between">
                                                    <h3 class="card-title fs-4 fw-semibold">Payment Create</h3>
                                                    <a href="{{ route('admin#payment#list') }}" class=" btn btn-secondary"><i class="bi bi-list-task"></i> Payment List</a>
                                                </div>
                                                <form action="{{ route('admin#payment#create') }}" method="POST">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col">

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Account Holder Name</label>
                                                                    <input type="text" class="form-control @error('accountName') is-invalid @enderror" name="accountName" placeholder="Enter Account Name..." value="{{ old('accountName') }}">
                                                                    @error('accountName')
                                                                        <small class=" invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Account Number</label>
                                                                    <input type="text" class="form-control @error('accountNumber') is-invalid @enderror" name="accountNumber" placeholder="Enter Account Number..." value="{{ old('accountNumber') }}">
                                                                    @error('accountNumber')
                                                                        <small class=" invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Account Type</label>
                                                                    <input type="text" class="form-control @error('accountType') is-invalid @enderror" name="accountType" placeholder="Enter Account Type..." value="{{ old('accountType') }}">
                                                                    @error('accountType')
                                                                        <small class=" invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="col">
                                                                    <button type="submit" class="btn btn-secondary my-3 w-100">
                                                                        Payment Create
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

    @if (Session::has('success'))

    <script>
        toastr.options = {
            "progressBar" : true ,
            "closeButton" : true ,
        }
        toastr.success("{{ Session::get('success') }}", 'Success!', { timeout: 12000 });
    </script>

    @endif

@endsection
