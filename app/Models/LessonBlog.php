<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonBlog extends Model
{
    protected $fillable = [
        'category_id' ,
        'sub_category_id' ,
        'lesson_id' ,
        'blog_title' ,
        'blog_description' ,
        'blog_image' ,
        'blog_status'
    ];
}
