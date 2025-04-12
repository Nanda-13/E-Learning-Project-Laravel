<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    // Payment Create Page
    public function createPage() {
        return view('admin.payment.paymentCreate') ;
    }

    // Payment Create
    public function create(Request $request) {

        $this->paymentValidation($request) ;
        $data = $this->paymentData($request) ;

        Payment::create($data);

        Alert::success('Create Success', 'Create Payment Successfully');

        return back()->with('success', "Create Payment Successful");
    }

    // Payment List
    public function list() {
        $paymentList = Payment::select()
                        ->when( request('searchKey'), function($query) {
                            $query->whereAny(['account_name', 'account_number', 'account_type'], 'like', '%' .request('searchKey'). '%');
                        } )
                        ->paginate(5);

        return view('admin.payment.paymentList', compact('paymentList'));
    }

    // Payment Edit Page
    public function editPage($id) {

        $paymentEdit = Payment::where('id', $id)->first() ;

        return view('admin.payment.paymentEdit', compact('paymentEdit'));
    }

    // Payment Edit
    public function edit(Request $request) {

        $this->paymentValidation($request);
        $data = $this->paymentData($request);

        Payment::where('id', $request->id)->update($data);

        Alert::warning('Update Success', 'Update Payment Successfully');

        return to_route('admin#payment#list')->with('update', "Update Payment Successful");
    }

    // Payment Delete
    public function delete($id) {
        Payment::where('id', $id)->delete() ;

        return back()->with('delete', "Delete Payment Successful");
    }
// Private Function
    // Payment Validation
    private function paymentValidation($request) {
        $rule = [
            'accountName' => 'required' ,
            'accountNumber' => 'required|numeric|unique:payments,account_number,' . $request->id ,
            'accountType' => 'required'
        ];

        $request->validate($rule) ;
    }

    // Payment Data
    private function paymentData($request) {
        return [
            'account_name' => $request->accountName ,
            'account_number' => $request->accountNumber ,
            'account_type' => $request->accountType ,
        ];
    }
}
