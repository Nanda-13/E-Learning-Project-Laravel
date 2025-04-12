@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> / <a
                href="{{ route('admin#lesson#blog#create#page') }}" class=" text-dark text-decoration-none">Lesson Blog Create</a> /
            <span class="text-primary">Lesson Blog List</span>
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
                                        <form action="{{ route('admin#lesson#blog#list') }}" method="get">
                                            <div class="d-flex justify-content-end">
                                                <div class="input-group w-25 mb-3">
                                                    <input type="text" name="searchKey" class="form-control"
                                                        placeholder="Enter Search Key..."
                                                        value="{{ request()->searchKey }}">
                                                    <button type="submit" class="btn btn-secondary"><i
                                                            class="bi bi-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-12">
                                            <div class="card shadow mb-4">
                                                <div class="card-header d-flex justify-content-between">
                                                    <h3 class="card-title fs-4 fw-semibold">Lesson Blog List</h3>
                                                    <a href="{{ route('admin#lesson#blog#create#page') }}"
                                                        class=" btn btn-secondary"><i class="bi bi-plus-circle-fill"></i>
                                                        Lesson Blog
                                                        Create</a>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col">

                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Id</th>
                                                                        <th scope="col">Lesson Name</th>
                                                                        <th scope="col">Lesson Blog Title</th>
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Date</th>
                                                                        <th scope="col">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ( count($lessonBlogList) == 0 )
                                                                        <tr class=" bg-dark-subtle">
                                                                            <td colspan="6">
                                                                                <h5 class="text-light text-center py-3">There is no lesson blog data</h5>
                                                                            </td>
                                                                        </tr>
                                                                    @else
                                                                        @foreach ($lessonBlogList as $key => $item)
                                                                            <tr>
                                                                                <input type="hidden" name="id" class="id" value="{{ $item->id }}">
                                                                                <th scope="row">{{ ++$key }}</th>
                                                                                <td>{{ $item->lesson_title }}</td>
                                                                                <td>{{ $item->blog_title }}</td>
                                                                                <td>{{ $item->blog_status }}</td>
                                                                                <td>{{ $item->updated_at->format('d-M-Y') }}
                                                                                </td>
                                                                                <td class=" d-flex justify-content-start">
                                                                                    <a href="{{ route('admin#lesson#blog#detail', $item->id) }}" class=" btn btn-info btn-sm me-2"><i class="bi bi-info-square"></i></a>
                                                                                    <a href="{{ route('admin#lesson#blog#edit#page', $item->id) }}"
                                                                                        class="btn btn-warning btn-sm me-2"><i
                                                                                            class="bi bi-pencil-square"></i></a>
                                                                                    <form method="POST" action="{{ route('admin#lesson#blog#delete', $item->id) }}">
                                                                                        @csrf
                                                                                        @method('DELETE')

                                                                                        <button type="submit" class="btn btn-danger btn-sm btn-delete d-inline"><i class="bi bi-trash-fill"></i></button>
                                                                                    </form>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <span class="d-flex justify-content-end me-3">{{ $lessonBlogList->links() }}</span>
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
    @if (Session::has('update'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.warning("{{ Session::get('update') }}", 'Update!', {
                timeout: 12000
            });
        </script>
    @endif

    @if (Session::has('delete'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.error("{{ Session::get('delete') }}", 'Delete!', {
                timeout: 12000
            });
        </script>
    @endif

    <script type="text/javascript">
        $(".btn-delete").click(function(e){
            e.preventDefault();
            var form = $(this).parents("form");

            Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "error",
              showCancelButton: true,
              confirmButtonColor: "#1D7647",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!"
            }).then((result) => {
              if (result.isConfirmed) {
                form.submit();
              }
            });

        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('.changeStatus').change(function() {

                $changeStatus = $(this).val() ;
                $id = $(this).parents("tr").find('.id').val() ;

                $data = {
                    'lesson_status' : $changeStatus ,
                    'id' : $id
                }

                $.ajax({
                    type: 'get' ,
                    url: '/admin/lesson/course/changeStatus' ,
                    data: $data ,
                    dataType: 'json' ,
                    success: function(response) {
                        response.status == 'success' ? location.reload() : ''
                    }
                })

            })
        })
    </script> --}}

@endsection
