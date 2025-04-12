<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = [
        'user_name' ,
        'phone' ,
        'order_code' ,
        'payment_method' ,
        'payslip_image' ,
        'total_price' ,
    ];
}
