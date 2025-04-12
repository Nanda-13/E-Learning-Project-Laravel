<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Lesson;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function userHome() {

        $lessonCourseList = Lesson::select('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level', 'lessons.duration','categories.name as category_name', 'sub_categories.name as sub_category_name', \DB::raw('AVG(ratings.count) as avg_rating'))
                            ->leftJoin('categories', 'categories.id', 'lessons.category_id')
                            ->leftJoin('sub_categories', 'sub_categories.id', 'lessons.sub_category_id')
                            ->leftJoin('ratings', 'ratings.lesson_id', 'lessons.id')
                            ->where('lessons.category_id', 2)
                            ->groupBy('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level', 'lessons.duration', 'categories.name', 'sub_categories.name')
                            ->get();

        $lessonBlogList = Lesson::select('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level','lessons.duration','categories.name as category_name', 'sub_categories.name as sub_category_name', \DB::raw('AVG(ratings.count) as avg_rating'))
                            ->leftJoin('categories', 'categories.id', 'lessons.category_id')
                            ->leftJoin('sub_categories', 'sub_categories.id', 'lessons.sub_category_id')
                            ->leftJoin('ratings', 'ratings.lesson_id', 'lessons.id')
                            ->where('lessons.category_id', 1)
                            ->groupBy('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level', 'lessons.duration', 'categories.name', 'sub_categories.name')
                            ->get();

        $commentList = Comment::select('comments.message', 'users.name', 'users.nickname', 'users.profile')
                            ->leftJoin('users', 'users.id', 'comments.user_id')
                            ->get();

        // dd($commentList->toArray());

        return view('user.main.home', compact('lessonCourseList', 'lessonBlogList', 'commentList'));
    }
}
