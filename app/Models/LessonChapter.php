<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonChapter extends Model
{
    protected $fillable = [
        'lesson_id',
        'name'
    ];
}
