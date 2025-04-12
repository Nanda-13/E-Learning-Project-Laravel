@extends('user.layouts.master')

@section('content')

{{-- Navbar Section --}}
@include('user.section.navBar')


    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active" style="min-height: 300px;">
                    <img class="position-relative w-100" src="img/carousel-1.jpg" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Best Online Courses</h5>
                            <h1 class="display-3 text-white mb-md-4">Best Education From Your Home</h1>
                            <a href="{{ route('user#course#list') }}" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="img/carousel-2.jpg" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Best Online Courses</h5>
                            <h1 class="display-3 text-white mb-md-4">Best Online Learning Platform</h1>
                            <a href="{{ route('user#course#list') }}" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="img/carousel-3.jpg" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Best Online Courses</h5>
                            <h1 class="display-3 text-white mb-md-4">New Way To Learn From Home</h1>
                            <a href="{{ route('user#course#list') }}" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Courses Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Courses</h5>
                <h1>Our Popular Courses</h1>
            </div>
            <div class="row">
                @foreach ($lessonCourseList as $item)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="rounded overflow-hidden mb-2">
                        <img class="img-fluid w-100" src="{{ asset('LessonImage/' . $item->image) }}">
                        <div class="bg-secondary p-4">
                            <div class="d-flex justify-content-between mb-3">
                                <small class="m-0"><i class="fa fa-users text-primary mr-2"></i>25 Students</small>
                                <small class="m-0"><i class="far fa-clock text-primary mr-2"></i>{{ $item->duration }}</small>
                            </div>
                            <a class="h5" href="{{ route('user#course#detail', $item->id) }}">{{ $item->title }}</a>
                            <p class=" mt-3">{{ Str::words($item->description, 30, '...') }}</p>
                            <div class="border-top mt-4 pt-4">
                                <div class="d-flex justify-content-between">
                                    <?php
                                        $star = number_format($item->avg_rating, 1);
                                    ?>
                                    <h6 class="m-0"><i class="fa fa-star text-warning"></i>@if( $star != null ) {{ $star }} @else 0 @endif<small class=" m-2 p-2 text-white bg-info" style="border: 1px solid var(--secondary); border-radius: 10px;">{{ $item->sub_category_name }}</small></h6>
                                    <?php
                                        $price = number_format($item->price) ;
                                    ?>
                                    <h5 class="m-0">MMK {{ $price }}</h5>
                                </div>
                            </div>
                            <div class="mt-4">
                                @auth
                                    @if(auth()->user()->cart->contains($item))
                                        <a href="{{ route('user#course#detail', $item->id) }}" class="btn btn-success w-100"><i class="bi bi-book-fill mr-2"></i>Learn Now</a>
                                    @else
                                        <a href="{{ route('user#order#page', $item->id) }}" class="btn btn-primary w-100"><i class="bi bi-bag-plus-fill mr-2"></i>Enroll Now</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Courses End -->

    <!-- Blogs Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            {{-- @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif --}}
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Blogs</h5>
                <h1>Article, Blog and Resource</h1>
            </div>
            <div class="row">
                @foreach ($lessonBlogList as $item)
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
    <!-- Blogs End -->

    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Testimonial</h5>
                <h1>What Say Our Students</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="owl-carousel testimonial-carousel">
                        @foreach ($commentList as $item)
                        <div class="text-center">
                            <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                            <h4 class="font-weight-normal mb-4">{{ $item->message }}</h4>
                            <img class="img-fluid mx-auto mb-3" src="{{ asset( $item->profile == null ? 'MasterImage/profile.jpg' : 'ProfileImage/' . $item->profile ) }}" alt="">
                            <h5 class="m-0">{{ $item->name == null ? $item->nickname : $item->name }}</h5>
                            <span>Profession</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

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

    @if (Session::has('success'))

    <script>
        toastr.options = {
            "progressBar" : true ,
            "closeButton" : true ,
        }
        toastr.info("{{ Session::get('success') }}", 'Success!', { timeout: 12000 });
    </script>

    @endif

    @if (Session::has('remove'))

    <script>
        toastr.options = {
            "progressBar" : true ,
            "closeButton" : true ,
        }
        toastr.error("{{ Session::get('remove') }}", 'Success!', { timeout: 12000 });
    </script>

    @endif

<script>
    $(document).ready(function () {

        // Read Later button click handler
        $('.save').on('click', function () {
            $blogItem = $(this).parents('.read');

            $id = $blogItem.find('#id').val() ;
            $userId = $blogItem.find('#userId').val() ;

            console.log($id);
            console.log($userId);

            $data = {
                'id' : $id ,
                'userId' : $userId
            };

            $.ajax({
                type : 'get' ,
                url : '/user/blog/saveToCart' ,
                data : $data ,
                dataType: "json" ,
                success: function(response) {
                    if(response.status == 'success') {
                        location.reload() ;
                    }
                }
            })

            // Hide Read Later button, show UnSave button
            $(this).hide();
            $blogItem.find('.remove').show();

            // Optional: Add visual feedback
            $blogItem.addClass('in-save');
        });

        // UnSave button click handler
        $('.remove').on('click', function () {
            $blogItem = $(this).parents('.read');

            $id = $blogItem.find('#id').val() ;
            $userId = $blogItem.find('#userId').val() ;
            $cartId = $blogItem.find('#cartId').val() ;

            // console.log($id);
            // console.log($userId);
            console.log($cartId);

            $data = {
                'cartId' : $cartId
            };

            $.ajax({
                type : 'get' ,
                url : '/user/blog/deleteFromCart' ,
                data : $data ,
                dataType : 'json' ,
                success: function(response) {
                    if (response.status == 'success') {

                        location.reload() ;
                    }
                }

            })

            // Hide UnSave button, show Read Later button
            $(this).hide();
            $blogItem.find('.save').show();

            $blogItem.removeClass('in-save');

        });
    });
</script>

@endsection
