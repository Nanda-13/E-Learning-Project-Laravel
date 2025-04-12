<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'lesson_id',
        'rate',
        'original_price',
        'discount_price'
    ];
}
