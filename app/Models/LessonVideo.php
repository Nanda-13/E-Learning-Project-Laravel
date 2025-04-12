<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonVideo extends Model
{
    protected $fillable = [
        'category_id' ,
        'sub_category_id' ,
        'lesson_id' ,
        'lesson_chapter_id' ,
        'video_title' ,
        'video_url' ,
        'lesson_status'
    ];
}
