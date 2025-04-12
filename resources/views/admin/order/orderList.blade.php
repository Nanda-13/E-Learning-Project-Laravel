@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> /
            <span class="text-primary">Order List</span>
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
                                        <form action="{{ route('admin#order#list') }}" method="get">
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
                                                <div class="card-header">
                                                    <h3 class="card-title fs-4 fw-semibold">Order List</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Id</th>
                                                                        <th scope="col">Date</th>
                                                                        <th scope="col">Order Code</th>
                                                                        <th scope="col">Lesson Name</th>
                                                                        <th scope="col">User Name</th>
                                                                        <th scope="col">Price (MMK)</th>
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ( count($orderList) == 0 )
                                                                        <tr class=" bg-dark-subtle">
                                                                            <td colspan="8">
                                                                                <h5 class="text-light text-center py-3">There is no order data</h5>
                                                                            </td>
                                                                        </tr>
                                                                    @else
                                                                        @foreach ($orderList as $key => $item)
                                                                            <tr>
                                                                                <input type="hidden" name="id" value="{{ $item->id }}" class="id">
                                                                                <th scope="row">{{ ++$key }}</th>
                                                                                <td>{{ $item->created_at->format('d-M-Y') }}
                                                                                <td>
                                                                                    <a href="{{ route('admin#order#detail', $item->order_code) }}" class=" text-decoration-none h6 text-primary">
                                                                                        {{ $item->order_code }}
                                                                                    </a>
                                                                                </td>
                                                                                <td>{{ $item->title }}</td>
                                                                                @if ( $item->user_name != null )
                                                                                    <td>{{ $item->user_name }}</td>
                                                                                @else
                                                                                    <td>{{ $item->user_nickname }}</td>
                                                                                @endif
                                                                                <td>
                                                                                    <?php
                                                                                      $price = number_format($item->order_price);
                                                                                    ?>

                                                                                    {{ $price }}
                                                                                </td>
                                                                                <td>
                                                                                    <select name="" id="" class=" form-control px-2 py-1 changeStatus bg-secondary text-light"
                                                                                            style="border: solid 2px rgb(243, 241, 241); border-radius: 10px; font-weight:bold; font-size: 15px">
                                                                                        <option value="0"
                                                                                            @if ( Auth::user()->role == 'superadmin' )
                                                                                                @if ($item->status == 0)
                                                                                                    selected
                                                                                                @endif>
                                                                                            @else
                                                                                                @if ($item->status != 0)
                                                                                                    disabled
                                                                                                @endif>
                                                                                            @endif
                                                                                            Pending
                                                                                        </option>
                                                                                        <option value="1"
                                                                                            @if ( Auth::user()->role == 'superadmin' )
                                                                                                @if ($item->status == 1)
                                                                                                    selected
                                                                                                @endif>
                                                                                            @else
                                                                                                @if ($item->status != 1)
                                                                                                    disabled
                                                                                                @endif>
                                                                                            @endif
                                                                                            Confirm
                                                                                        </option>
                                                                                        <option value="2"
                                                                                            @if ( Auth::user()->role == 'superadmin' )
                                                                                                @if ($item->status == 2)
                                                                                                    selected
                                                                                                @endif>
                                                                                            @else
                                                                                                @if ($item->status != 2)
                                                                                                    disabled
                                                                                                @endif>
                                                                                            @endif
                                                                                            Cancel
                                                                                        </option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    @if( $item->status == 0 )
                                                                                    <i class="bi bi-clock-fill text-warning fs-4"></i>
                                                                                    @elseif( $item->status == 1 )
                                                                                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                                                                    @else
                                                                                    <i class="bi bi-x-circle-fill text-danger fs-4"></i>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <span class="d-flex justify-content-end me-3">{{ $orderList->links() }}</span>
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

<script>

$(document).ready(function() {

    $('.changeStatus').change(function() {

        $changeStatus = $(this).val();
        $id = $(this).parents('tr').find('.id').val();

        $data = {
            'status' : $changeStatus ,
            'id' : $id
        }

        $.ajax( {
            type : 'get' ,
            url : '/admin/order/changeStatus' ,
            data : $data ,
            dataType : 'json' ,
            success : function(response) {
                response.status == 'success' ? location.reload() : '' ;
            }
        } )
    })

})
</script>


@if (Session::has('confirm'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.success("{{ Session::get('confirm') }}", 'Success!', {
            timeout: 12000
        });
    </script>
@endif

@if (Session::has('cancel'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.error("{{ Session::get('cancel') }}", 'Success!', {
            timeout: 12000
        });
    </script>
@endif

@endsection
