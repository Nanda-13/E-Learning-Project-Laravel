<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Cart list
    public function list() {

        $courseList = Lesson::select('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level','lessons.duration','categories.name as category_name', 'sub_categories.name as sub_category_name', \DB::raw('AVG(ratings.count) as avg_rating'))
                    ->leftJoin('categories', 'categories.id', 'lessons.category_id')
                    ->leftJoin('sub_categories', 'sub_categories.id', 'lessons.sub_category_id')
                    ->leftJoin('ratings', 'ratings.lesson_id', 'lessons.id')
                    ->rightJoin('carts', 'carts.lesson_id', 'lessons.id')
                    ->where('lessons.category_id', '2')
                    ->where('carts.user_id', Auth::user()->id)
                    ->groupBy('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level', 'lessons.duration', 'categories.name', 'sub_categories.name')
                    ->get();

        $blogList = Lesson::select('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level','lessons.duration','categories.name as category_name', 'sub_categories.name as sub_category_name', \DB::raw('AVG(ratings.count) as avg_rating'))
                    ->leftJoin('categories', 'categories.id', 'lessons.category_id')
                    ->leftJoin('sub_categories', 'sub_categories.id', 'lessons.sub_category_id')
                    ->leftJoin('ratings', 'ratings.lesson_id', 'lessons.id')
                    ->rightJoin('carts', 'carts.lesson_id', 'lessons.id')
                    ->where('lessons.category_id', '1')
                    ->where('carts.user_id', Auth::user()->id)
                    ->groupBy('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level', 'lessons.duration', 'categories.name', 'sub_categories.name')
                    ->get();

        // dd($blogList->toArray());

        return view('user.cart.cartList', compact('blogList', 'courseList'));
    }

    // Save to Cart (Read Later)
    public function saveToCart(Lesson $lesson) {

        auth()->user()->cart()->syncWithoutDetaching([$lesson->id]);

        return back()->with('success', 'Added to Read later list!');
    }

    // Delete From Cart (UnSave)
    public function deleteFromCart(Lesson $lesson) {
        auth()->user()->cart()->detach($lesson->id);

        return back()->with('remove', 'Removed from Read later list!');
    }
}
