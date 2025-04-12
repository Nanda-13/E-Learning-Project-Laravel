<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    // Rating Create
    public function create(Request $request) {

        Rating::updateOrCreate([
            'user_id' => $request->userId ,
            'lesson_id' => $request->lessonId
        ], [
            'count' => $request->productRating
        ]);

        return back()->with('success', "Rating Success");
    }

}
