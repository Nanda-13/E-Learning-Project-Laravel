<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot        // Change Model to Pivot (Need class input pivot)
{
    protected $table = 'carts';
}
