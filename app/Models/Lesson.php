<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'lesson_level',
        'title',
        'description',
        'image',
        'duration',
        'price',
    ];

    public function cartBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'carts');
    }
}
