@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <span
                class=" text-dark text-decoration-none">Lesson Course</span> / <span class="text-primary">Lesson Course Create</span>
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
                                                    <h3 class="card-title fs-4 fw-semibold">Lesson Course Create</h3>
                                                    <a href="{{ route('admin#lesson#course#list') }}" class=" btn btn-secondary"><i
                                                            class="bi bi-list-task"></i> Lesson Course List</a>
                                                </div>
                                                <form action="{{ route('admin#lesson#course#create') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for=""
                                                                                class="form-label">Category Name</label>
                                                                            <select name="categoryId"
                                                                                class=" form-select @error('categoryId') is-invalid @enderror"
                                                                                id="categoryId">
                                                                                <option value="" disabled selected>
                                                                                    Select a category</option>
                                                                                <option
                                                                                    value="{{ $categoryList[0]['category_id'] }}">
                                                                                    {{ $categoryList[0]['category_name'] }}
                                                                                </option>
                                                                            </select>
                                                                            @error('categoryId')
                                                                                <small
                                                                                    class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Sub
                                                                                Category Name</label>
                                                                            <select name="subCategoryId"
                                                                                class=" form-select @error('subCategoryId') is-invalid @enderror"
                                                                                id="subCategoryId">
                                                                                <option value="" disabled selected>
                                                                                    Select a subcategory</option>
                                                                            </select>
                                                                            @error('subCategoryId')
                                                                                <small
                                                                                    class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson
                                                                                Name</label>
                                                                            <select name="lessonId"
                                                                                class=" form-select @error('lessonId') is-invalid @enderror"
                                                                                id="lessonId">
                                                                                <option value="" disabled selected>
                                                                                    Select a lesson</option>
                                                                            </select>
                                                                            @error('lessonId')
                                                                                <small
                                                                                    class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson
                                                                                Chapter</label>
                                                                            <select name="lessonChapterId"
                                                                                class=" form-select @error('lessonChapterId') is-invalid @enderror"
                                                                                id="lessonChapterId">
                                                                                <option value="" disabled selected>
                                                                                    Select a lesson</option>
                                                                            </select>
                                                                            @error('lessonChapterId')
                                                                                <small
                                                                                    class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson Status</label>
                                                                            <select class="form-select @error('status') is-invalid @enderror" name="status" id="label"
                                                                                data-placeholder="Select a lesson video status">

                                                                                <option selected disabled>Select a lesson Video status</option>

                                                                                <option value="active">Active</option>
                                                                                <option value="unactive">Unactive</option>
                                                                            </select>
                                                                            @error('status')
                                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson
                                                                                Video Title</label>
                                                                            <input type="text"
                                                                                class="form-control @error('videoTitle') is-invalid @enderror"
                                                                                name="videoTitle"
                                                                                placeholder="Enter Lesson Video Name..."
                                                                                value="{{ old('videoTitle') }}">
                                                                            @error('videoTitle')
                                                                                <small
                                                                                    class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson
                                                                                Video URL</label>
                                                                            <input type="text"
                                                                                class="form-control @error('videoUrl') is-invalid @enderror"
                                                                                name="videoUrl"
                                                                                placeholder="Enter Lesson Video URL..."
                                                                                value="{{ old('videoUrl') }}" id="video_url">
                                                                            @error('videoUrl')
                                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson
                                                                                Video</label>
                                                                            <iframe id="videoPreview" style="margin-top: 15px; display: none; width: 100%; height: 400px;"
                                                                                frameborder="0" allowfullscreen></iframe>
                                                                        </div>
                                                                    </div>

                                                                    {{-- <div class="col-12">
                                                                        <label for="video_url" class="form-label">YouTube Video URL</label>
                                                                        <input type="url" class="form-control" name="video_url" id="video_url"
                                                                            placeholder="Enter the YouTube video URL" value="{{ old('video_url') }}" required>
                                                                        <iframe id="videoPreview" style="margin-top: 15px; display: none; width: 100%; height: 400px;"
                                                                            frameborder="0" allowfullscreen></iframe>
                                                                    </div> --}}
                                                                </div>

                                                                <div class="col-12">
                                                                    <button type="submit"
                                                                        class="btn btn-secondary my-3 w-100">
                                                                        Lesson Course Create
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

    {{-- Video Preview --}}
    {{-- <script>
        document.getElementById('video_url').addEventListener('input', function() {
            const videoUrl = this.value; // Get the YouTube URL from the input field
            const videoPreview = document.getElementById('videoPreview'); // Get the iframe element

            if (videoUrl) {
                // Extract YouTube video ID from the URL
                const videoId = extractYouTubeID(videoUrl);
                if (videoId) {
                    // Set the iframe src to embed the YouTube video
                    videoPreview.src = `https://www.youtube.com/embed/${videoId}`;
                    videoPreview.style.display = 'block';
                } else {
                    alert('Invalid YouTube URL');
                    videoPreview.style.display = 'none';
                    videoPreview.src = '';
                }
            } else {
                // Hide the iframe if the input is empty
                videoPreview.style.display = 'none';
                videoPreview.src = '';
            }
        });

        // Function to extract YouTube video ID from URL
        function extractYouTubeID(url) {
            const regex =
                /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
            const match = url.match(regex);
            return match ? match[1] : null;
        }
    </script> --}}

<script>
    document.getElementById('video_url').addEventListener('input', function() {
        const videoUrl = this.value; // Get the YouTube URL from the input field
        const videoPreview = document.getElementById('videoPreview'); // Get the iframe element

        if (videoUrl) {
            // Extract YouTube video ID from the URL
            const videoId = extractId(videoUrl);

            console.log(videoId);

            if (videoId) {
                // Set the iframe src to embed the YouTube video
                videoPreview.src = `https://cybervynx.com/${videoId}`;
                videoPreview.style.display = 'block';
            } else {
                alert('Invalid YouTube URL');
                videoPreview.style.display = 'none';
                videoPreview.src = '';
            }
        } else {
            // Hide the iframe if the input is empty
            videoPreview.style.display = 'none';
            videoPreview.src = '';
        }
    });

    // Function to extract YouTube video ID from URL
    function extractId(url) {
        const regex =
            /(?:https?:\/\/)?(?:cybervynx\.com\/)([a-zA-Z0-9_-]{12})/;
        const match = url.match(regex);
        return match ? match[1] : null;
    }
</script>

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

    <script>
        $(document).ready(function() {
            $('#lessonId').on('change', function() {
                var lessonId = $(this).val();

                if (lessonId) {
                    $.ajax({
                        url: '/admin/lesson/course/getLessonChapter/' + lessonId,
                        type: 'GET',

                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // Dynamically fetch CSRF token
                        },

                        success: function(data) {

                            console.log(data);
                            $('#lessonChapterId').empty(); // Clear previous options
                            $('#lessonChapterId').append(
                                '<option value="" disabled selected>Select a lesson chapter</option>'
                                );

                            $.each(data, function(key, value) {
                                $('#lessonChapterId').append('<option value="' +
                                    parseInt(value.id) + '">' + value.name +
                                    '</option>');
                            });
                        },
                        error: function() {
                            alert('Failed to load lessons.');
                        }
                    });
                } else {
                    $('#lessonChapterId').empty();
                    $('#lessonChapterId').append(
                        '<option value="" disabled selected>Select a lesson Chapter</option>');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Add new input field for course goal
            $('#addChapterInput').on('click', function(e) {
                e.preventDefault(); // Prevent default behavior

                $('#chapterContainer').append(`
            <div class="d-flex mt-2">
                <input type="text" class="form-control @error('chapter') is-invalid @enderror" name="chapter[]" placeholder="Enter Lesson Chapter..." value="{{ old('chapter[]') }}" />
                <button type="button" class="btn btn-danger removeChapterInput"> - </button>
                @error('chapter')
                <small class=" invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        `);
            });

            // Remove an input field
            $(document).on('click', '.removeChapterInput', function() {
                $(this).closest('div').remove();
            });
        });
    </script>

@endsection
