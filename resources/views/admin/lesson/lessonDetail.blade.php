@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <a href="{{ route('admin#lesson#list') }}" class=" text-dark text-decoration-none">Lesson List</a> / <span class="text-primary">Lesson Detail</span>
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
                                        <div class="col-12">
                                            <div class="card shadow mb-4">
                                                <div class="card-header d-flex justify-content-between">
                                                    <h3 class="card-title fs-4 fw-semibold">Lesson Detail</h3>
                                                    <a href="{{ route('admin#lesson#list') }}" class=" btn btn-secondary"><i class="bi bi-list-task"></i> Lesson List</a>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">

                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson Name</label>
                                                                        <input type="text" class="form-control" readonly value="{{ $lessonDetail->title }}">
                                                                    </div>
                                                                </div>

                                                                @if ($lessonChapter[0]['lesson_chapter'] == null)
                                                                <div class="d-none"></div>
                                                                @else
                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson Chapter</label>
                                                                        @foreach ($lessonChapter as $item)
                                                                            <input type="text" class="form-control mb-2" readonly value="{{ $item->lesson_chapter }}">
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                <div class="col-4">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson Level</label>
                                                                        <?php
                                                                            $lessonLevel = Str::ucfirst($lessonDetail->lesson_level)
                                                                        ?>
                                                                        <input type="text" name="" class="form-control" readonly value="{{ $lessonLevel }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Category Name</label>
                                                                        <input type="text" name="" class="form-control" readonly value="{{ $lessonDetail->category_name }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Sub Category Name</label>
                                                                        <input type="text" name="" class="form-control" readonly value="{{ $lessonDetail->sub_category_name }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson Price (MMK)</label>
                                                                        <?php
                                                                            $price = number_format($lessonDetail->price);
                                                                        ?>
                                                                        <input type="text" class="form-control" readonly value="{{ $price }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson Duration</label>
                                                                        <input type="text" name="" class="form-control" readonly value="{{ $lessonDetail->duration }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson Description</label>
                                                                        <textarea name="description" id="" cols="30" rows="10" class="form-control" readonly>{{ $lessonDetail->description }}</textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson Image</label>
                                                                        <img src="{{ asset('LessonImage/' . $lessonDetail->image) }}" class=" w-100 img-thumbnail" style="height: 300px" id="output">
                                                                    </div>
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

    @if (Session::has('detail'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.warning("{{ Session::get('detail') }}", 'Detail!', {
                timeout: 12000
            });
        </script>
    @endif


@endsection
