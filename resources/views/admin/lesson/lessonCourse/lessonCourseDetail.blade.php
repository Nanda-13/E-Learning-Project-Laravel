@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h2 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <a href="{{ route('admin#lesson#course#list') }}"
                class=" text-dark text-decoration-none">Lesson Course List</a> / <span class="text-primary">Lesson Course Detail</span>
        </h2>
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
                                                    <h3 class="card-title fs-4 fw-semibold">Lesson Course Detail</h3>
                                                    <a href="{{ route('admin#lesson#course#list') }}" class=" btn btn-secondary"><i
                                                            class="bi bi-list-task"></i> Lesson Course List</a>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for=""
                                                                            class="form-label">Category Name</label>
                                                                        <input type="text" value="{{ $lessonVideoDetail->category_name }}" class="form-control" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Sub
                                                                            Category Name</label>
                                                                        <input type="text" value="{{ $lessonVideoDetail->sub_category_name }}" class="form-control" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson
                                                                            Name</label>
                                                                        <input type="text" value="{{ $lessonVideoDetail->lesson_title }}" class="form-control" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson
                                                                            Chapter</label>
                                                                        <input type="text" value="{{ $lessonVideoDetail->chapter_name }}" class="form-control" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson Status</label>
                                                                        <?php
                                                                            $status = Str::ucfirst($lessonVideoDetail->lesson_status);
                                                                        ?>
                                                                        <input type="text" value="{{ $status }}" class="form-control" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson
                                                                            Video Title</label>
                                                                        <input type="text" value="{{ $lessonVideoDetail->video_title }}" class="form-control" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Lesson
                                                                            Video URL</label>
                                                                        <input type="text"
                                                                            class="form-control"
                                                                            name="videoUrl"
                                                                            placeholder="Enter Lesson Video URL..."
                                                                            value="{{ $lessonVideoDetail->video_url }}" id="video_url" readonly>
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
    document.getElementById('video_url').addEventListener('click', function() {
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
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const videoUrlField = document.getElementById('video_url');
        const videoPreview = document.getElementById('videoPreview');

        // Initialize iframe with existing video URL from database
        const initialVideoUrl = videoUrlField.value; // Get the initial value from the input
        if (initialVideoUrl) {
            const videoId = extractId(initialVideoUrl);
            if (videoId) {
                videoPreview.src = `https://cybervynx.com/${videoId}`;
                videoPreview.style.display = 'block';
            }
        }

        // Function to extract YouTube video ID
        function extractId(url) {
            const regex =
                /(?:https?:\/\/)?(?:cybervynx\.com\/)([a-zA-Z0-9_-]{12})/;
            const match = url.match(regex);
            return match ? match[1] : null;
        }
    });
</script>

@endsection
