@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <span
                class=" text-dark text-decoration-none">Lesson</span> / <span class="text-primary">Lesson Create</span>
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
                                                    <h3 class="card-title fs-4 fw-semibold">Lesson Create</h3>
                                                    <a href="{{ route('admin#lesson#list') }}" class=" btn btn-secondary"><i
                                                            class="bi bi-list-task"></i> Lesson List</a>
                                                </div>
                                                <form action="{{ route('admin#lesson#create') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">

                                                                    <div class="col-12">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson
                                                                                Name</label>
                                                                            <input type="text"
                                                                                class="form-control @error('title') is-invalid @enderror"
                                                                                name="title"
                                                                                placeholder="Enter Lesson Title..."
                                                                                value="{{ old('title') }}">
                                                                            @error('title')
                                                                                <small
                                                                                    class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson
                                                                                Level</label>
                                                                            <select name="lessonLevel"
                                                                                class=" form-select @error('lessonLevel') is-invalid @enderror">
                                                                                <option value="" disabled selected>
                                                                                    Select a lesson level</option>
                                                                                <option value="beginner">Beginner</option>
                                                                                <option value="intermediate">Intermediate
                                                                                </option>
                                                                                <option value="advance">Advance</option>
                                                                            </select>
                                                                            @error('lessonLevel')
                                                                                <small
                                                                                    class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4">
                                                                        <div class="mb-3">
                                                                            <label for=""
                                                                                class="form-label">Category Name</label>
                                                                            <select name="categoryId"
                                                                                class=" form-select @error('categoryId') is-invalid @enderror"
                                                                                id="categoryId">
                                                                                <option value="" disabled selected>
                                                                                    Select a Category</option>
                                                                                @foreach ($categoryList as $item)
                                                                                    <option value="{{ $item->id }}"
                                                                                        @if (old('categoryId') == $item->id) selected @endif>
                                                                                        {{ $item->name }}
                                                                                    </option>
                                                                                @endforeach
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
                                                                                Price</label>
                                                                            <input type="text"
                                                                                class="form-control @error('price') is-invalid @enderror"
                                                                                name="price"
                                                                                placeholder="Enter Lesson Price... (MMK)"
                                                                                value="{{ old('price') }}">
                                                                            @error('price')
                                                                                <small
                                                                                    class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson
                                                                                Duration</label>
                                                                            <input type="text"
                                                                                class="form-control @error('duration') is-invalid @enderror"
                                                                                name="duration"
                                                                                placeholder="Enter Duration..."
                                                                                value="{{ old('duration') }}">
                                                                            @error('duration')
                                                                                <small
                                                                                    class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12" id="lessonChapter">

                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for=""
                                                                                class="form-label">Lesson
                                                                                Description</label>
                                                                            <textarea name="description" id="" cols="30" rows="10"
                                                                                class="form-control @error('description') is-invalid @enderror" placeholder="Enter Lesson Description...">{{ old('description') }}</textarea>
                                                                            @error('description')
                                                                                <small
                                                                                    class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for=""
                                                                                class="form-label">Lesson Image</label>
                                                                            <img src="{{ asset('MasterImage/default_Image.jpg') }}"
                                                                                class=" w-100 img-thumbnail"
                                                                                style="height: 300px" id="output">
                                                                            <input type="file" name="image"
                                                                                id=""
                                                                                class="form-control @error('image') is-invalid @enderror"
                                                                                onchange="loadFile(event)">
                                                                            @error('image')
                                                                                <small
                                                                                    class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <button type="submit"
                                                                    class="btn btn-secondary my-3 w-100">
                                                                    Lesson Create
                                                                </button>
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
        $('#categoryId').on('change', function() {

            var categoryId = $(this).val();

            if (categoryId == '1') {
                $('#lessonChapter').closest('div').empty();
            }

            if (categoryId == '2') {
                $('#lessonChapter').append(`

                    <div class="mb-3">
                        <label for="" class="form-label">Lesson
                            Chapter</label>
                        <div id="chapterContainer">
                            <div class="d-flex">
                                <input type="text"
                                    class="form-control @error('chapter') is-invalid @enderror"
                                    name="chapter[]"
                                    placeholder="Enter Lesson Chapter..."
                                    value="{{ old('chapter[]') }}">
                                <button type="button"
                                    id="addChapterInput"
                                    class="btn btn-primary">+</button>
                                @error('chapter')
                                    <small
                                        class=" invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                `)

                // Add new input field for chapter
                $('#addChapterInput').on('click', function(e) {

                    console.log("clickme");


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
            }
        })
    })
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
@endsection
