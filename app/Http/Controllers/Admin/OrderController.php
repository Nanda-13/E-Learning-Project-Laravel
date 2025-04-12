<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\LessonChapter;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // Order List
    public function list() {

        $orderList = Order::select('orders.*', 'users.name as user_name', 'users.nickname as user_nickname', 'lessons.title')
                ->leftJoin('users', 'orders.user_id', 'users.id')
                ->leftJoin('lessons', 'orders.lesson_id', 'lessons.id')
                ->when( request('searchKey'), function($query) {
                    $query->whereAny( [ 'orders.order_code', 'lessons.title', 'orders.order_price', 'users.name', 'users.nickname' ], 'like', '%' .request('searchKey'). '%' );
                } )
                ->orderBy('created_at', 'desc')
                ->paginate(5);

        // dd($orderList->toArray());
        return view('admin.order.orderList', compact('orderList'));
    }

    // Order Change Status
    public function changeStatus(Request $request) {

        $id = $request->id ;
        $status = $request->status ;

        Order::where('id', $id)->update([
            'status' => $status
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    // Order Detail
    public function detail($order_code) {

        $orderDetail = Order::select('orders.*', 'lessons.*', 'users.phone', 'lessons.id as lesson_id' , 'orders.id as order_id')
                        ->leftJoin('lessons', 'orders.lesson_id', 'lessons.id')
                        ->leftJoin('users', 'orders.user_id', 'users.id')
                        ->where('orders.order_code', $order_code)
                        ->first();

        $paymentDetail = PaymentHistory::select('payments.*', 'payment_histories.*')
                        ->leftJoin('payments', 'payment_histories.payment_method', 'payments.account_number')
                        ->where('payment_histories.order_code', $order_code)
                        ->first();

        $lessonDetail = LessonChapter::select()
                        ->leftJoin('lessons', 'lessons.id', 'lesson_chapters.lesson_id')
                        ->where('lessons.id', $orderDetail->lesson_id)
                        ->get();

        // dd($orderDetail->toArray());

        return view('admin.order.orderDetail', compact('orderDetail', 'paymentDetail', 'lessonDetail'));
    }

    // Order Confirm
    public function confirm(Request $request) {

        $status = 1 ;
        Order::where('id', $request->orderId)->update([
            'status' => $status
        ]);

        $data = [
            'user_id' => $request->userId ,
            'lesson_id' => $request->lessonId
        ];

        Cart::create($data);

        return to_route('admin#order#list')->with('confirm', "Order Confirmed!");
    }

    // Order Cancel
    public function cancel(Request $request) {

        $status = 2 ;

        Order::where('id', $request->orderId)->update([
            'status' => $status
        ]);

        $cartId = Cart::select('id')->where('lesson_id', $request->lessonId)->where('user_id', $request->userId)->first();

        if ($cartId != null) {
            Cart::where('id', $cartId->id)->delete();
        }

        return to_route('admin#order#list')->with('cancel', "Order Cancelled!");
    }
}
