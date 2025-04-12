@extends('user.layouts.master')

@section('content')
@include('user.section.navBar')

<!-- Header Start -->
<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
            <h3 class="display-4 text-white text-uppercase">Order</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('user#home') }}">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('user#course#list') }}">Course List</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase text-primary">Order</p>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Order Start -->
<?php
    $price = number_format($lesson->price) ;
?>
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Lesson Detail</h4>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('LessonImage/' . $lesson->image) }}" class="img-fluid mb-3">
                        <h4 class="mb-3">{{ $lesson->title }}</h4>
                        <p>{{ $lesson->description }}</p>
                        <hr>
                        <h5>Amount - {{ $price }} MMK</h5>
                        <hr>
                        <span><i class="bi bi-star-fill text-warning mr-2"></i>Life Time Access</span> <br>
                        <span><i class="bi bi-star-fill text-warning mr-2"></i>Unlimited Download</span>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Payment Detail</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h5 class="mb-3">Payment Method</h5>
                        @foreach ($payment as $item)
                            <div class="">
                                <b class="text-info">{{ $item->account_type }}</b> ( <span>{{ $item->account_name }}</span> )
                                <p>Number : {{ $item->account_number }}</p>
                            </div>
                            <hr>
                        @endforeach

                        <h5 class="my-3">Payment Info</h5>
                        <form action="{{ route('user#order') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="lessonId" value="{{ $lesson->id }}">
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="price" value="{{ $lesson->price }}">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control bg-white" value="{{ Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name }}" readonly>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control bg-white" value="{{ Auth::user()->email }}" readonly>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control bg-white @error('phone') is-invalid @enderror" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Enter Phone Number">
                                    @error('phone')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Payment Method</label>
                                    <select name="paymentMethod" id="" class=" form-control @error('paymentId') is-invalid @enderror">
                                        <option value="" selected disabled>Choose Payment Method</option>
                                        @foreach ($payment as $item)
                                            <option value="{{ $item->account_number }}" @if( old('paymentMethod') == $item->account_number ) selected @endif>{{ $item->account_number }} ( {{ $item->account_type }} )</option>
                                        @endforeach
                                    </select>
                                    @error('paymentMethod')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Pay Slip Image</label>
                                    <img src="" class=" img-fluid" id="output">
                                    <input type="file" name="image" class="form-control btn-sm @error('image') is-invalid @enderror" onchange="loadFile(event)">
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-credit-card-2-back-fill mr-2"></i>Purchase Now ( {{ $price }} MMK )</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Order End -->

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
