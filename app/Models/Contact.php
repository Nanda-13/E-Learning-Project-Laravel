<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'reply_user_id' ,
        'reply_user_name' ,
        'reply_message' ,
        'status'
    ];
}
