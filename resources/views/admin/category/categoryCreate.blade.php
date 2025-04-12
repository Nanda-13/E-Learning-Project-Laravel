@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <span class=" text-dark text-decoration-none">Category</span> / <span class="text-primary">Category Create</span>
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
                                                    <h3 class="card-title fs-4 fw-semibold">Category Create</h3>
                                                    <a href="{{ route('admin#category#list') }}" class=" btn btn-secondary"><i class="bi bi-list-task"></i> Category List</a>
                                                </div>
                                                <form action="{{ route('admin#category#create') }}" method="POST">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col">

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Category Name</label>
                                                                    <input type="text" class="form-control @error('categoryName') is-invalid @enderror" name="categoryName" placeholder="Enter Category Name..." value="{{ old('categoryName') }}">
                                                                    @error('categoryName')
                                                                        <small class=" invalid-feedback">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div class="col">
                                                                    <button type="submit" class="btn btn-secondary my-3 w-100">
                                                                        Category Create
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
