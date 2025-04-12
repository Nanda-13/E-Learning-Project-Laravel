@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <a href="{{ route('admin#lesson#blog#list') }}"
                class=" text-dark text-decoration-none">Lesson Blog List</a> / <span class="text-primary">Lesson Blog Edit</span>
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
                                                    <h3 class="card-title fs-4 fw-semibold">Lesson Blog Edit</h3>
                                                    <a href="{{ route('admin#lesson#blog#list') }}" class=" btn btn-secondary"><i
                                                            class="bi bi-list-task"></i> Lesson Blog List</a>
                                                </div>
                                                <form action="{{ route('admin#lesson#blog#edit') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">

                                                                    <div class="col-4">
                                                                        <div class="mb-3">
                                                                            <input type="hidden" name="id" value="{{ $lessonBlogEdit->id }}">
                                                                            <input type="hidden" name="oldImage" value="{{ $lessonBlogEdit->blog_image }}">
                                                                            <label for=""
                                                                                class="form-label">Category Name</label>
                                                                            <select name="categoryId"
                                                                                class=" form-select @error('categoryId') is-invalid @enderror"
                                                                                id="categoryId">
                                                                                <option value="" selected>
                                                                                    Select a category</option>
                                                                                <option
                                                                                    value="{{ $lessonBlogEdit->category_id }}" selected>
                                                                                    {{ $lessonBlogEdit->category_name }}
                                                                                </option>
                                                                            </select>
                                                                            @error('categoryId')
                                                                                <small
                                                                                    class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Sub
                                                                                Category Name</label>
                                                                            <select name="subCategoryId"
                                                                                class=" form-select @error('subCategoryId') is-invalid @enderror"
                                                                                id="subCategoryId">
                                                                                <option value="" selected>
                                                                                    Select a subcategory</option>
                                                                                <option value="{{ $lessonBlogEdit->sub_category_id }}" selected>
                                                                                    {{ $lessonBlogEdit->sub_category_name }}
                                                                                </option>
                                                                            </select>
                                                                            @error('subCategoryId')
                                                                                <small
                                                                                    class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson
                                                                                Name</label>
                                                                            <select name="lessonId"
                                                                                class=" form-select @error('lessonId') is-invalid @enderror"
                                                                                id="lessonId">
                                                                                <option value="" selected>
                                                                                    Select a lesson</option>
                                                                                <option value="{{ $lessonBlogEdit->lesson_id }}" selected>
                                                                                    {{ $lessonBlogEdit->lesson_title }}
                                                                                </option>
                                                                            </select>
                                                                            @error('lessonId')
                                                                                <small
                                                                                    class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson Blog Status</label>
                                                                            <input type="text" name="status" value="{{ old('status', $lessonBlogEdit->blog_status) }}" class="form-control @error('status') is-invalid @enderror" placeholder="Enter Lesson Blog Status...">
                                                                            @error('status')
                                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Blog
                                                                                Title</label>
                                                                            <input type="text"
                                                                                class="form-control @error('blogTitle') is-invalid @enderror"
                                                                                name="blogTitle"
                                                                                placeholder="Enter Blog Name..."
                                                                                value="{{ old('blogTitle', $lessonBlogEdit->blog_title) }}">
                                                                            @error('blogTitle')
                                                                                <small
                                                                                    class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson Blog
                                                                                Description</label>
                                                                            <textarea name="blogDescription" class="form-control @error('blogDescription') is-invalid @enderror" cols="30" rows="10">{{ old('blogDescription', $lessonBlogEdit->blog_description) }}</textarea>
                                                                            @error('blogDescription')
                                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson Blog Image</label>
                                                                            <img src="{{ asset( $lessonBlogEdit->blog_image == null ? 'MasterImage/default_Image.jpg' : 'LessonBlogImage/' . $lessonBlogEdit->blog_image ) }}" class=" img-thumbnail w-100" style="height: 300px;" id="output">
                                                                            <input type="file" name="image" value="{{ old('image') }}" class="form-control @error('image') is-invalid @enderror" onchange="loadFile(event)">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="col-12">
                                                                    <button type="submit"
                                                                        class="btn btn-primary my-3 w-100">
                                                                        Lesson Blog Update
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
                "progressBar": true,
                "closeButton": true,
            }
            toastr.success("{{ Session::get('success') }}", 'Success!', {
                timeout: 12000
            });
        </script>
    @endif

<script>
    function loadFile(event) {
        var reader = new FileReader()
        reader.onload = function() {
            var output = document.getElementById("output")
            output.src = reader.result
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<script>
    $(document).ready(function() {
        $('#categoryId').on('change', function() {
            var categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: '/admin/lesson/getSubcategories/' + categoryId,
                    type: 'GET',

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Dynamically fetch CSRF token
                    },

                    success: function(data) {

                        console.log(data);
                        $('#subCategoryId').empty(); // Clear previous options
                        $('#subCategoryId').append(
                            '<option value="" disabled selected>Select a subcategory</option>'
                            );

                        $.each(data, function(key, value) {
                            $('#subCategoryId').append('<option value="' + parseInt(
                                value.id) + '">' + value.name + '</option>');
                        });
                    },
                    error: function() {
                        alert('Failed to load subcategories.');
                    }
                });
            } else {
                $('#subCategoryId').empty();
                $('#subCategoryId').append(
                    '<option value="" disabled selected>Select a subcategory</option>');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#subCategoryId').on('change', function() {
            var subCategoryId = $(this).val();

            if (subCategoryId) {
                $.ajax({
                    url: '/admin/lesson/course/getLesson/' + subCategoryId,
                    type: 'GET',

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Dynamically fetch CSRF token
                    },

                    success: function(data) {

                        console.log(data);
                        $('#lessonId').empty(); // Clear previous options
                        $('#lessonId').append(
                            '<option value="" disabled selected>Select a lesson</option>'
                            );

                        $.each(data, function(key, value) {
                            $('#lessonId').append('<option value="' + parseInt(value
                                .id) + '">' + value.title + '</option>');
                        });
                    },
                    error: function() {
                        alert('Failed to load lessons.');
                    }
                });
            } else {
                $('#lessonId').empty();
                $('#lessonId').append('<option value="" disabled selected>Select a lesson</option>');
            }
        });
    });
</script>

@endsection
