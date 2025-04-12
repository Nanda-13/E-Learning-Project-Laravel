@extends('admin.layouts.master')

@section('content')
    <!-- App hero header starts -->
    <div class="app-hero-header">
        <h5 class="fw-light">Hello {{ Auth::user()->name }},</h5>
        <h3 class="fw-light mb-5">
            <a href="{{ route('admin#home') }}" class=" text-dark text-decoration-none">Home</a> /
            <a href="{{ route('admin#order#list') }}" class="text-dark text-decoration-none">Order List</a> / <span
                class="text-primary">Order Detail</span>
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
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class=" text-center">Payment Info</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-5 mb-2">
                                                            <h6>Customer Name: </h6>
                                                        </div>
                                                        <div class="col-7 mb-2">
                                                            <b class=" text-danger">{{ $paymentDetail->user_name }}</b>
                                                        </div>

                                                        <div class="col-5 mb-2">
                                                            <h6>Customer Phone: </h6>
                                                        </div>
                                                        <div class="col-7 mb-2">
                                                            @if ($orderDetail->phone != null && $orderDetail->phone == $paymentDetail->phone)
                                                                <b class=" text-danger">{{ $orderDetail->phone }}</b>
                                                            @elseif ($orderDetail->phone != null && $orderDetail->phone != $paymentDetail->phone)
                                                                <b class=" text-danger">{{ $orderDetail->phone }}</b> /
                                                                <b class=" text-danger">{{ $paymentDetail->phone }}</b>
                                                            @else
                                                                <b class=" text-danger">{{ $paymentDetail->phone }}</b>
                                                            @endif
                                                        </div>

                                                        <div class="col-5 mb-2">
                                                            <h6>Order Code: </h6>
                                                        </div>
                                                        <div class="col-7 mb-2">
                                                            <b class=" text-danger">{{ $paymentDetail->order_code }}</b>
                                                        </div>

                                                        <div class="col-5 mb-2">
                                                            <h6>Amount: </h6>
                                                        </div>
                                                        <div class="col-7 mb-2">
                                                            <?php
                                                            $price = number_format($paymentDetail->total_price);
                                                            ?>
                                                            <b class=" text-danger">MMK {{ $price }}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class=" text-center">Payment Detail</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-5" style="height: 140px">
                                                            <h6>PaySlip Image: </h6>

                                                            <!-- Thumbnail Image -->
                                                            <img src="{{ asset('PaySlipImage/' . $paymentDetail->payslip_image) }}"
                                                                class="img-thumbnail h-75 w-50" alt="Popup Image"
                                                                data-bs-toggle="modal" data-bs-target="#imageModal">

                                                            <!-- Image Popup Modal -->
                                                            <div class="modal fade" id="imageModal" tabindex="-1"
                                                                aria-labelledby="imageModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="imageModalLabel">
                                                                                Image
                                                                                Preview</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <img src="{{ asset('PaySlipImage/' . $paymentDetail->payslip_image) }}"
                                                                                class="img-fluid w-50 h-50"
                                                                                alt="Full Size Image">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="row">
                                                                <div class="col-5 mb-2">
                                                                    <h6 class="">Payment Date: </h6>
                                                                </div>
                                                                <div class="col-7 mb-2">
                                                                    <b class="text-danger">{{ $paymentDetail->created_at->format('d-M-Y') }}</b>
                                                                </div>

                                                                <div class="col-5 mb-2">
                                                                    <h6 class="">Account Number: </h6>
                                                                </div>
                                                                <div class="col-7 mb-2">
                                                                    <b class="text-danger">{{ $paymentDetail->account_number }}</b>
                                                                </div>

                                                                <div class="col-5 mb-2">
                                                                    <h6 class="">Account Name: </h6>
                                                                </div>
                                                                <div class="col-7 mb-2">
                                                                    <b class="text-danger">{{ $paymentDetail->account_name }}</b>
                                                                </div>

                                                                <div class="col-5 mb-2">
                                                                    <h6 class="">Account Type: </h6>
                                                                </div>
                                                                <div class="col-7 mb-2">
                                                                    <b class="text-danger">{{ $paymentDetail->account_type }}</b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class=" text-center">Lesson Detail</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Lesson Image</th>
                                                                        <th scope="col">Lesson Name</th>
                                                                        <th scope="col">Chapter Name</th>
                                                                        <th scope="col">Price (MMK)</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ( count($lessonDetail) == 0 )
                                                                        <tr class=" bg-dark-subtle">
                                                                            <td colspan="5">
                                                                                <h5 class="text-light text-center py-3">There is no lesson data</h5>
                                                                            </td>
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <td>
                                                                                <img src="{{ asset('LessonImage/' . $lessonDetail[0]['image']) }}" class="img-fluid w-50 h-25">
                                                                            </td>
                                                                            <td>{{ $lessonDetail[0]['title'] }}</td>
                                                                            <td>
                                                                                @foreach ($lessonDetail as $item)
                                                                                    {{ $item->name }} <br>
                                                                                @endforeach
                                                                            </td>
                                                                            <td>
                                                                                {{ $price }}
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="d-flex justify-content-end">
                                                        @if ( $orderDetail->status == 0 )
                                                            <form action="{{ route('admin$order#confirm') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="lessonId" value="{{ $orderDetail->lesson_id }}">
                                                                <input type="hidden" name="userId" value="{{ $orderDetail->user_id }}">
                                                                <input type="hidden" name="orderId" value="{{ $orderDetail->order_id }}">
                                                                <button type="submit" class="btn btn-success me-3">Confirm Order</button>
                                                            </form>
                                                            <form action="{{ route('admin$order#cancel') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="orderId" value="{{ $orderDetail->order_id }}">
                                                                <button type="submit" class="btn btn-danger">Cancel Order</button>
                                                            </form>
                                                        @elseif ( $orderDetail->status == 1 )
                                                            <form action="{{ route('admin$order#cancel') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="lessonId" value="{{ $orderDetail->lesson_id }}">
                                                                <input type="hidden" name="userId" value="{{ $orderDetail->user_id }}">
                                                                <input type="hidden" name="orderId" value="{{ $orderDetail->order_id }}">
                                                                @if ( Auth::user()->role == 'superadmin' )
                                                                    <button type="submit" class="btn btn-danger">Cancel Order</button>
                                                                @else
                                                                    <button type="submit" class="btn btn-danger" disabled>Cancel Order</button>
                                                                @endif
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin$order#confirm') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="lessonId" value="{{ $orderDetail->lesson_id }}">
                                                                <input type="hidden" name="userId" value="{{ $orderDetail->user_id }}">
                                                                <input type="hidden" name="orderId" value="{{ $orderDetail->order_id }}">
                                                                <button type="submit" class="btn btn-success me-3">Confirm Order</button>
                                                            </form>
                                                        @endif
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
@endsection
