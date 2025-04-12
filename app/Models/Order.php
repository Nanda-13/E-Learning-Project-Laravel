<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id' ,
        'lesson_id' ,
        'order_code' ,
        'order_price' ,
        'status' ,
    ];
}
