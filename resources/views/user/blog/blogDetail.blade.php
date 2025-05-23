@extends('user.layouts.master')

@section('content')
@include('user.section.navBar')

<!-- Header Start -->
<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
            <h3 class="display-4 text-white text-uppercase">Blog Detail</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('user#home') }}">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase"><a href="{{ route('user#blog#list') }}" class="text-white">Blog List</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase text-primary">Blog Detail</p>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

    <!-- Detail Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <label for="" class=" form-label text-primary h5">Blog Title</label>
                                    <p>{{ $blogDetail->lesson_title }}</p>
                                </div>
                                <div class="col-3">
                                    <label for="" class=" form-label text-primary h5">Duration</label>
                                    <p>{{ $blogDetail->duration }}</p>
                                </div>
                                <div class="col-3">
                                    <label for="" class=" form-label text-primary h5">Rating</label>
                                    <div class=" rating-css">
                                        <?php
                                            $star = number_format($countStar);
                                        ?>

                                        @for ($i = 1; $i <= $star; $i++)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @endfor
                                        @for ($j = $star + 1; $j <= 5 ; $j++)
                                            <i class="bi bi-star text-warning"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="" class=" form-label text-primary h5">Date</label>
                                    <p>{{ $blogDetail->updated_at->format('d-M-Y') }}</p>
                                </div>
                                <div class="col-12">
                                    @auth
                                        @if(auth()->user()->cart->contains($blogDetail))
                                            <form action="{{ route('user#blog#deleteFromCart', $blogDetail) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100">
                                                    <i class="bi bi-bookmark-x-fill mr-2"></i>UnSave
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('user#blog#saveToCart', $blogDetail) }}" method="POST" class="d-inline">
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

                <div class="col-lg-7">
                    <div class="mb-5">
                        <h3 class="text-uppercase mb-3" style="letter-spacing: 5px;">Blog Image</h3>
                        <img src="{{ asset('LessonImage/' . $blogDetail->image) }}" alt="" class="img-fluid w-100">
                        <h5 class=" my-3">{{ $blogDetail->blog_title }}</h5>
                        <p class=" my-2">{{ $blogDetail->lesson_description }}</p>
                        @if ( $blogDetail->blog_description == null )
                        <p class=" d-none my-2">{{ $blogDetail->blog_description }}</p>
                        @else
                        <p class=" my-2">{{ $blogDetail->blog_description }}</p>
                        @endif
                    </div>

                <!-- Comment Start -->
                <!-- Comment List Start -->
                <div class="mb-5">
                    <h3 class="text-uppercase comments mb-4" style="letter-spacing: 5px;">{{ count($comment) }} Comments</h3>
                    @foreach($comment as $item)
                        @if(!$item->parent_id)
                            @include('user.comment.comments', ['comment' => $item])
                        @endif
                    @endforeach
                </div>
                <!-- Comment List End -->

                <!-- Comment Form Start -->
                <div class="bg-secondary rounded p-5">
                    <h3 class="text-uppercase mb-4" style="letter-spacing: 5px;">Leave a comment</h3>
                    <form action="{{ route('user#comment#create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="lesson_id" value="{{ $blogDetail->id }}">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control border-0" id="name"
                                value="{{ Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control border-0" id="email"
                                value="{{ Auth::user()->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea name="message" id="message" cols="30" rows="5"
                                class="form-control border-0 @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                            @error('message')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold w-100"><i
                                    class="bi bi-chat-left-dots-fill mr-2"></i>Leave Comment</button>
                        </div>
                    </form>
                </div>
                <!-- Comment Form End -->
                <!-- Comment End -->
                </div>

                <div class="col-lg-5 mt-5 mt-lg-0">
                    <!-- Search Form -->
                    {{-- <div class="mb-5">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" placeholder="Keyword">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary"><i
                                            class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </form>
                    </div> --}}

                    <!-- Sub Category List -->
                    <div class="mb-5">
                        <h3 class="text-uppercase mb-3" style="letter-spacing: 5px;">Sub Categories</h3>
                        <span class=" btn btn-info">{{ $blogDetail->sub_category_name }}</span>
                    </div>

                    <!-- Recent Post -->
                    <div class="mb-5">
                        <h3 class="text-uppercase" style="letter-spacing: 5px;">Related Blog</h3>
                        @if ( count($relatedBlog) == 0)
                            <h5 class=" text-danger">There is no related blog</h5>
                        @else
                            @foreach ($relatedBlog as $item)
                            <a class="text-decoration-none" href="{{ route('user#blog#detail', $item->id) }}">
                                <small>{{ $item->updated_at->format('d-M-Y') }}</small>
                                <h5 class="">{{ $item->lesson_title }}</h5>
                                <img class="img-fluid rounded w-100" src="{{ asset('LessonImage/' . $item->image) }}" alt="">
                            </a>
                            @endforeach
                        @endif
                    </div>

                    <!-- Rating -->
                    <div class="mb-5">
                        <h3 class="text-uppercase mb-4" style="letter-spacing: 5px;">Your Rating</h3>
                        <div class="d-flex flex-wrap m-n1">
                            <button class="btn btn-primary w-100"
                                type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-star-fill text-white mr-2"></i>Rate this product
                            </button>
                            <form action="{{ route('user#rating#create') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mtext-105 cl-5" id="exampleModalLabel">Rating
                                                </h5>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"> X </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="rating-css">
                                                    <input type="hidden" name="lessonId" value="{{ $blogDetail->id }}">
                                                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                                        <div class="star-icon">
                                                            @if ( $userRating == 0 )
                                                                <input type="radio" value="1" name="productRating"
                                                                    checked id="rating1">
                                                                <label for="rating1" class="fa fa-star"></label>
                                                                <input type="radio" value="2" name="productRating"
                                                                    id="rating2">
                                                                <label for="rating2" class="fa fa-star"></label>
                                                                <input type="radio" value="3" name="productRating"
                                                                    id="rating3">
                                                                <label for="rating3" class="fa fa-star"></label>
                                                                <input type="radio" value="4" name="productRating"
                                                                    id="rating4">
                                                                <label for="rating4" class="fa fa-star"></label>
                                                                <input type="radio" value="5" name="productRating"
                                                                    id="rating5">
                                                                <label for="rating5" class="fa fa-star"></label>
                                                            @else
                                                            <?php
                                                                $star = number_format($userRating);
                                                            ?>
                                                                @for ($i = 1; $i <= $star ; $i++)
                                                                    <input type="radio" value="{{ $i }}" name="productRating"
                                                                        checked id="rating{{ $i }}">
                                                                    <label for="rating{{ $i }}" class="fa fa-star"></label>
                                                                @endfor
                                                                @for ($j = $star + 1; $j <= 5 ; $j++)
                                                                    <input type="radio" value="{{ $j }}" name="productRating"
                                                                        id="rating{{ $j }}">
                                                                    <label for="rating{{ $j }}" class="fa fa-star"></label>
                                                                @endfor
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button"
                                                    class=" btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit"
                                                    class="btn btn-success">Rating</button>
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
    <!-- Detail End -->

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
