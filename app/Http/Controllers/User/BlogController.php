<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Lesson;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    // Blog List
    public function list() {

        $blogList = Lesson::select('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level','lessons.duration','categories.name as category_name', 'sub_categories.name as sub_category_name', \DB::raw('AVG(ratings.count) as avg_rating'))
                        ->leftJoin('categories', 'categories.id', 'lessons.category_id')
                        ->leftJoin('sub_categories', 'sub_categories.id', 'lessons.sub_category_id')
                        ->leftJoin('ratings', 'ratings.lesson_id', 'lessons.id')
                        ->when( request('subCategoryId'), function($query) {
                            $query->where('lessons.sub_category_id', request('subCategoryId'));
                        } )
                        ->when( request('level'), function($query) {
                            $query->where('lessons.lesson_level', request('level'));
                        } )
                        ->when( request('searchKey'), function($query) {
                            $query->whereAny([ 'lessons.title', 'lessons.description', 'lessons.price' ], 'like', '%' .request('searchKey'). '%');
                        } )
                        ->where('lessons.category_id', '1')
                        ->groupBy('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level', 'lessons.duration', 'categories.name', 'sub_categories.name')
                        ->get();

        $subCategoryList = SubCategory::where('category_id', '1')->orderBy('created_at', 'desc')->get() ;

        return view('user.blog.blogList', compact('blogList', 'subCategoryList'));
    }

    public function detail($id) {

        $blogDetail = Lesson::select('lessons.id as id','lessons.title as lesson_title', 'lessons.lesson_level as lesson_level', 'lessons.image as image' ,'lessons.description as lesson_description', 'lessons.price', 'lessons.duration' , 'lessons.updated_at', 'sub_categories.name as sub_category_name', 'lesson_blogs.blog_title', 'lesson_blogs.blog_description', 'lesson_blogs.blog_image')
                                ->leftJoin('sub_categories', 'lessons.sub_category_id', 'sub_categories.id')
                                ->leftJoin('lesson_blogs', 'lessons.id', 'lesson_blogs.lesson_id')
                                ->where('lessons.id', $id)
                                ->first();

        $relatedBlog = Lesson::select('lessons.id as id', 'lessons.title as lesson_title', 'lessons.lesson_level as lesson_level', 'lessons.image as image' ,'lessons.description as lesson_description', 'lessons.price', 'lessons.duration', 'lessons.updated_at', 'sub_categories.name as sub_category_name')
                                ->leftJoin('sub_categories', 'lessons.sub_category_id', 'sub_categories.id')
                                ->where('sub_categories.name', $blogDetail->sub_category_name)
                                ->where('lessons.id', '!=', $blogDetail->id)
                                ->get();

        $userRating = Rating::where('user_id', Auth::user()->id)->where('lesson_id', $id)->first() ;

        $userRating = $userRating != null ? $userRating->count : 0 ;

        $countStar = Rating::where('lesson_id', $id)->avg('count');

        $comment = Comment::select('comments.*', 'users.name as user_name', 'users.nickname as user_nickname', 'users.profile')
                        ->leftJoin('users', 'users.id', 'comments.user_id')
                        ->where('lesson_id', $id)->get();

        return view('user.blog.blogDetail', compact('blogDetail', 'relatedBlog', 'userRating', 'countStar', 'comment'));
    }
}
