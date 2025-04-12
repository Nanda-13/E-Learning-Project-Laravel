<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Lesson;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\LessonVideo;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\LessonChapter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    // Course List
    public function list() {

        $courseList = Lesson::select('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price','lessons.lesson_level', 'lessons.duration','categories.name as category_name', 'sub_categories.name as sub_category_name', \DB::raw('AVG(ratings.count) as avg_rating'))
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
                        ->where('lessons.category_id', 2)
                        ->groupBy('lessons.id', 'lessons.title', 'lessons.image', 'lessons.description', 'lessons.price', 'lessons.lesson_level', 'lessons.duration', 'categories.name', 'sub_categories.name')
                        ->get();

        $subCategoryList = SubCategory::where('category_id', '2')->orderBy('created_at', 'desc')->get() ;

        return view('user.course.courseList', compact('courseList', 'subCategoryList'));
    }

    // Course Detail
    public function detail($id) {

        $courseDetail = Lesson::select('lessons.id as id','lessons.title as lesson_title', 'lessons.lesson_level as lesson_level', 'lessons.image as image' ,'lessons.description as lesson_description', 'lessons.price', 'lessons.duration' , 'lessons.updated_at', 'sub_categories.name as sub_category_name')
                                    ->leftJoin('sub_categories', 'lessons.sub_category_id', 'sub_categories.id')
                                    ->where('lessons.id', $id)
                                    ->first();

        $orderDetail = Order::where('lesson_id', $id)->where('user_id', Auth::user()->id)->first();

        $courseVideo = LessonVideo::select('lesson_videos.*', 'lesson_chapters.name as chapter_name')
                                    ->leftJoin('lesson_chapters', 'lesson_videos.lesson_chapter_id', 'lesson_chapters.id')
                                    ->where('lesson_videos.lesson_id', $id)
                                    ->get();

        $chapterList = LessonChapter::where('lesson_id', $id)->get();

        $relatedCourse = Lesson::select('lessons.id as id', 'lessons.title as lesson_title', 'lessons.lesson_level as lesson_level', 'lessons.image as image' ,'lessons.description as lesson_description', 'lessons.price', 'lessons.duration', 'lessons.updated_at', 'sub_categories.name as sub_category_name')
                                ->leftJoin('sub_categories', 'lessons.sub_category_id', 'sub_categories.id')
                                ->where('sub_categories.name', $courseDetail->sub_category_name)
                                ->where('lessons.id', '!=', $courseDetail->id)
                                ->get();

        $userRating = Rating::where('user_id', Auth::user()->id)->where('lesson_id', $id)->first() ;

        $userRating = $userRating != null ? $userRating->count : 0 ;

        $countStar = Rating::where('lesson_id', $id)->avg('count');

        $comment = Comment::select('comments.*', 'users.name as user_name', 'users.nickname as user_nickname', 'users.profile')
                        ->leftJoin('users', 'users.id', 'comments.user_id')
                        ->where('lesson_id', $id)->get();

        return view('user.course.courseDetail', compact('courseDetail', 'orderDetail','courseVideo', 'chapterList', 'relatedCourse', 'userRating', 'countStar', 'comment'));
    }
}
