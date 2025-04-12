<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Lesson;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Order Page
    public function orderPage($id) {

        $payment = Payment::get();

        $lesson = Lesson::where('id', $id)->first();

        return view('user.order.order', compact('payment', 'lesson'));
    }

    // Order
    public function order(Request $request) {

        $order_code = "eLearn - " . random_int(1000000, 9999999);
        $status = 0 ;

        $this->orderValidation($request);

        // Order
        $orderData = $this->orderData($request);

        $orderData['order_code'] = $order_code ;
        $orderData['status'] = $status ;

        // Payment
        $paymentData = $this->paymentData($request);
        $paymentData['order_code'] = $order_code ;

        if ($request->hasFile('image')) {

            $file = $request->file('image') ;
            $fileName = uniqid() . $file->getClientOriginalName() ;
            $file->move(public_path(). '/PaySlipImage/' , $fileName) ;

            $paymentData['payslip_image'] = $fileName ;
        }

        // dd($orderData, $paymentData);
        Order::create($orderData);

        PaymentHistory::create($paymentData);

        return back()->with('success', "Your Payment is successful. We will check and reply you. Thanks!");
    }

// Private Function
    // Order Validation
    public function orderValidation($request) {
        $rule = [
            'phone' => 'required|numeric|unique:users,phone,' . Auth::user()->id ,
            'paymentMethod' => 'required' ,
            'image' => 'required|mimes:png,jpg,jpeg,svg'
        ];

        $request->validate($rule);
    }

    // Order Data
    public function orderData($request) {
        return [
            'user_id' => $request->userId ,
            'lesson_id' => $request->lessonId ,
            'order_price' => $request->price
        ];
    }

    // Payment Data
    public function paymentData($request) {
        return [
            'user_name' => $request->name ,
            'phone' => $request->phone ,
            'payment_method' => $request->paymentMethod ,
            'total_price' => $request->price
        ];
    }
}
