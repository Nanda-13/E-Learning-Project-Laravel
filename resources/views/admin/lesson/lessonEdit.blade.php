@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <a href="{{ route('admin#lesson#list') }}" class=" text-dark text-decoration-none">Lesson List</a> / <span class="text-primary">Edit Lesson</span>
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
                                                    <h3 class="card-title fs-4 fw-semibold">Edit Lesson</h3>
                                                    <a href="{{ route('admin#lesson#list') }}" class=" btn btn-secondary"><i class="bi bi-list-task"></i> Lesson List</a>
                                                </div>
                                                <form action="{{ route('admin#lesson#edit') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">

                                                                    <input type="hidden" name="id" value="{{ $lessonEdit->id }}">
                                                                    <input type="hidden" name="oldImage" value="{{ $lessonEdit->image }}">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 lesson">
                                                                            <label for="" class="form-label">Lesson Name</label>
                                                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter Lesson Title..." value="{{ old('title',$lessonEdit->title) }}">
                                                                            @error('title')
                                                                                <small class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    @if ( $lessonEdit->category_id == 2 )
                                                                    <div class="col-12 lessonChapter">
                                                                        <div class="my-3">
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <label for="" class="form-label">Lesson Chapter</label>
                                                                                <button type="button" id="addChapterInput" class="btn btn-primary ">+</button>
                                                                            </div>
                                                                            <div id="chapterContainer">
                                                                                @foreach ($lessonChapterEdit as $item)
                                                                                    <div class=" d-flex align-items-center justify-content-center">
                                                                                        <input type="text" class="form-control mt-2 chapter" name="chapter[]" placeholder="Enter Lesson Chapter..." value="{{ old('chapter[]',$item->lesson_chapter) }}">
                                                                                        <button type="button" class="btn btn-danger removeChapterInput mt-2">-</button>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                    <div class="col-12 lessonChapter d-none">
                                                                        <div class="my-3">
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <label for="" class="form-label">Lesson Chapter</label>
                                                                                <button type="button" id="addChapterInput" class="btn btn-primary ">+</button>
                                                                            </div>
                                                                            <div id="chapterContainer">
                                                                                <input type="hidden" class="chapter" value="{{ $lessonChapterEdit[0]['lesson_chapter'] }}">
                                                                                @foreach ($lessonChapterEdit as $item)
                                                                                    <div class=" d-flex align-items-center justify-content-center">
                                                                                        <input type="text" class="form-control mt-2" name="chapter[]" placeholder="Enter Lesson Chapter..." value="{{ old('chapter[]',$item->lesson_chapter) }}">
                                                                                        <button type="button" class="btn btn-danger removeChapterInput mt-2">-</button>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif

                                                                    <div class="col-4">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson Level</label>
                                                                            <select name="lessonLevel" class=" form-select @error('lessonLevel') is-invalid @enderror">
                                                                                <option value="" disabled selected>Select a lesson level</option>
                                                                                <option value="beginner" {{ $lessonEdit->lesson_level == 'beginner' ? 'selected' : '' }}>Beginner
                                                                                </option>
                                                                                <option value="intermediate" {{ $lessonEdit->lesson_level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                                                <option value="advance" {{ $lessonEdit->lesson_level == 'advance' ? 'selected' : '' }}>Advance
                                                                                </option>
                                                                            </select>
                                                                            @error('lessonLevel')
                                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Category Name</label>
                                                                            <select name="categoryId" class=" form-select @error('categoryId') is-invalid @enderror" id="categoryId">
                                                                                <option value="" disabled selected>Select a Category</option>
                                                                                @foreach ($categoryList as $item)
                                                                                    <option value="{{ $item->id }}" @if( old('categoryId', $lessonEdit->category_id) == $item->id ) selected @endif>
                                                                                        {{ $item->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('categoryId')
                                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-4">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Sub Category Name</label>
                                                                            <select name="subCategoryId" class=" form-select @error('subCategoryId') is-invalid @enderror" id="subCategoryId">
                                                                                <option value="" disabled selected>Select a subcategory</option>
                                                                                <option value="{{ $lessonEdit->sub_category_id }}" selected>
                                                                                    {{ $lessonEdit->sub_category_name }}
                                                                                </option>
                                                                            </select>
                                                                            @error('subCategoryId')
                                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson Price</label>
                                                                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Enter Lesson Price... (MMK)" value="{{ old('price',$lessonEdit->price) }}">
                                                                            @error('price')
                                                                                <small class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson Duration</label>
                                                                            <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" placeholder="Enter Duration..." value="{{ old('duration',$lessonEdit->duration) }}">
                                                                            @error('duration')
                                                                                <small class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson Description</label>
                                                                            <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Lesson Description...">{{ old('description',$lessonEdit->description) }}</textarea>
                                                                            @error('description')
                                                                                <small class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Lesson Image</label>
                                                                            <img src="{{ asset('LessonImage/' . $lessonEdit->image) }}" class=" w-100 img-thumbnail" style="height: 300px" id="output">
                                                                            <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror" onchange="loadFile(event)">
                                                                            @error('image')
                                                                                <small class=" invalid-feedback">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-primary my-3 w-100">
                                                                    Lesson Update
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
            "progressBar" : true ,
            "closeButton" : true ,
        }
        toastr.success("{{ Session::get('success') }}", 'Success!', { timeout: 12000 });
    </script>

    @endif

<script>
    $(document).ready(function () {
        $('#categoryId').on('change', function () {
            var categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: '/admin/lesson/getSubcategories/' + categoryId,
                    type: 'GET',

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Dynamically fetch CSRF token
                    },

                    success: function (data) {

                        $('#subCategoryId').empty(); // Clear previous options
                        $('#subCategoryId').append('<option value="" disabled selected>Select a subcategory</option>');

                        $.each(data, function (key, value) {
                            $('#subCategoryId').append('<option value="' + parseInt(value.id) + '">' + value.name + '</option>');
                        });
                    },
                    error: function () {
                        alert('Failed to load subcategories.');
                    }
                });
            } else {
                $('#subCategoryId').empty();
                $('#subCategoryId').append('<option value="" disabled selected>Select a subcategory</option>');
            }

            console.log(categoryId);

            if (categoryId == '1') {
                $('.lessonChapter').closest('div').empty();
            }

            if (categoryId == '2' && chapter !== null) {


                $('.lessonChapter').append(`
                    <div class="my-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="" class="form-label">Lesson Chapter</label>
                            <button type="button" id="addChapterInput" class="btn btn-primary ">+</button>
                        </div>
                        <div id="chapterContainer">
                            @foreach ($lessonChapterEdit as $item)
                                <div class=" d-flex align-items-center justify-content-center">
                                    <input type="text" class="form-control mt-2 chapter" name="chapter[]" placeholder="Enter Lesson Chapter..." value="{{ old('chapter[]',$item->lesson_chapter) }}">
                                    <button type="button" class="btn btn-danger removeChapterInput mt-2">-</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                `);

                $chapterFunction() ;

            }

            var chapter = $('.chapter').val();
            console.log(chapter);

            if(categoryId == '1' && chapter == null) {
                $('#chapter').closest('div').remove();
            }


            if (categoryId == '2' && chapter == '') {
                $('.lesson').append(`
                <div class="my-3" id="chapter">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="" class="form-label">Lesson Chapter</label>
                        <button type="button" id="addChapterInput" class="btn btn-primary ">+</button>
                    </div>
                    <div id="chapterContainer">
                        <div class=" d-flex align-items-center justify-content-center">
                            <input type="text" class="form-control mt-2" name="chapter[]" placeholder="Enter Lesson Chapter..." value="{{ old('chapter[]') }}">
                            <button type="button" class="btn btn-danger removeChapterInput mt-2">-</button>
                        </div>
                    </div>
                </div>
                `);

                $chapterFunction() ;
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
    // Add new input field for course goal
    $chapterFunction = function() {
        $('#addChapterInput').on('click', function (e) {

            e.preventDefault(); // Prevent default behavior

            $('#chapterContainer').append(`
                <div class="d-flex mt-2">
                    <input type="text" class="form-control" name="chapter[]" placeholder="Enter Lesson Chapter..." value="{{ old('chapter[]') }}" />
                    <button type="button" class="btn btn-danger removeChapterInput"> - </button>
                </div>
            `);
        });

        // Remove an input field
        $(document).on('click', '.removeChapterInput', function () {
            $(this).closest('div').remove();
        });
    }

    $chapterFunction() ;
});
</script>

<script>

    function loadFile(event){
        var reader = new FileReader()
        reader.onload = function(){
            var output = document.getElementById("output")
            output.src = reader.result
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
