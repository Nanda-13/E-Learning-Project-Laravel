@extends('user.layouts.master')

@section('content')
@include('user.section.navBar')

<!-- Header Start -->
<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
            <h3 class="display-4 text-white text-uppercase">Blog List</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('user#home') }}">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase text-primary">Blog</p>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Blogs Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Blogs</h5>
            <h1>Article, Blog and Resource</h1>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex">
                    <form action="{{ url('user/blog/list') }}" method="GET">
                        <div class="d-flex">
                            <select name="level"
                            class=" form-control bg-secondary cursor-pointer" style="width: 150px">
                                <option value="">All</option>
                                <option value="beginner" {{ request('level') == 'beginner' ? 'selected' : ''  }}>Beginner</option>
                                <option value="intermediate" {{ request('level') == 'intermediate' ? 'selected' : ''  }}>Intermediate</option>
                                <option value="advance" {{ request('level') == 'advance' ? 'selected' : ''  }}>Advance</option>
                            </select>
                            <input type="submit" value="Find" class=" search btn btn-primary mr-5">
                        </div>
                    </form>
                <form action="{{ url('user/blog/list') }}" method="GET">
                    <input type="text" name="searchKey" class=" ml-5 form-control border-primary rounded" style="width: 600px"
                            placeholder="Search Blog Name..."
                            value="{{ request()->searchKey }}">
                </form>
                </div>
            </div>

            <div class="col-12 mb-5">
                <a href="{{ url('user/blog/list') }}" class=" btn btn-danger mr-2 @if( !request('subCategoryId') ) active @endif"><span class="">All Blog</span></a>

                @foreach ($subCategoryList as $item)
                    <a href="{{ url('user/blog/list?subCategoryId=' . $item->id) }}" class="btn btn-info mr-2 @if( request('subCategoryId') ) active @endif"><span class="">{{ $item->name }}</span></a>
                @endforeach
            </div>
        </div>

        <div class="row">
            @foreach ($blogList as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rounded overflow-hidden mb-2">
                    <img class="img-fluid w-100" src="{{ asset('LessonImage/' . $item->image) }}" style="height: 200px">
                    <div class="bg-secondary p-4">
                        <div class="d-flex justify-content-between mb-3" >
                            <small class="m-0"><i class="fa fa-users text-primary mr-2"></i>25 Views</small>
                            <small class="m-0"><i class="far fa-clock text-primary mr-2"></i>{{ $item->duration }}</small>
                        </div>
                        <a class="h5" href="{{ route('user#blog#detail', $item->id) }}">{{ $item->title }}</a>
                        <p class=" mt-3">{{ Str::words($item->description, 5, '...') }}</p>
                        <div class="border-top mt-4 pt-4">
                            <div class="d-flex justify-content-between">
                            <?php
                                $star = number_format($item->avg_rating, 1);
                            ?>
                            <h6 class="m-0"><i class="fa fa-star text-warning"></i>@if( $star != null ) {{ $star }} @else 0 @endif<small class=" m-2 p-2 text-white bg-info" style="border: 1px solid var(--secondary); border-radius: 10px;">{{ $item->sub_category_name }}</small></h6>
                                <?php
                                    $level = Str::ucfirst($item->lesson_level)
                                ?>
                                <span class="m-0">{{ $level }}</span>
                            </div>
                            <div class="mt-4">
                                @auth
                                @if(auth()->user()->cart->contains($item))
                                    <form action="{{ route('user#blog#deleteFromCart', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="bi bi-bookmark-x-fill mr-2"></i>UnSave
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('user#blog#saveToCart', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-bookmark-plus-fill mr-2"></i>Read Later
                                        </button>
                                    </form>
                                @endif
                            @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Courses End -->

@endsection

@section('js-content')

@endsection
