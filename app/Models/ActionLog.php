<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    protected $fillable = [
        'user_id' ,
        'lesson_id' ,
        'action' ,
    ];
}
