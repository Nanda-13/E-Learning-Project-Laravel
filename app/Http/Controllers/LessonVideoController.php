<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Category;
use App\Models\LessonVideo;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\LessonChapter;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class LessonVideoController extends Controller
{
    // Lesson Course Create Page
    public function createPage() {
        $categoryList = Category::select('categories.id as category_id', 'categories.name as category_name', 'sub_categories.id as sub_categoy_id', 'sub_categories.name as sub_category_name')
                        ->leftJoin('sub_categories', 'categories.id', 'sub_categories.category_id')
                        ->where('categories.name', 'course')
                        ->get();

        // dd($categoryList->toArray());
        return view('admin.lesson.lessonCourse.lessonCourseCreate', compact('categoryList'));
    }

    // Lesson Course Create
    public function create(Request $request) {
        $this->videoValidation($request);
        $data = $this->videoData($request);

        LessonVideo::create($data);

        Alert::success('Create Success', 'Create Lesson Video Successfully');

        return back()->with('success', "Create Lesson Video Successful");
    }

    // Lesson Course List
    public function list() {

        $lessonVideoList = LessonVideo::select('lessons.title as lesson_title', 'lesson_chapters.name as chapter_name', 'lesson_videos.*')
                                ->leftJoin('lessons', 'lesson_videos.lesson_id', 'lessons.id')
                                ->leftJoin('lesson_chapters', 'lesson_videos.lesson_chapter_id', 'lesson_chapters.id')
                                ->when( request('searchKey'), function($query) {
                                    $query->whereAny( ['lessons.title', 'lesson_chapters.name', 'lesson_videos.video_title'], 'like', '%' .request('searchKey'). '%' );
                                } )
                                ->orderBy('lesson_videos.created_at', 'desc')
                                ->paginate(5);

        return view('admin.lesson.lessonCourse.lessonCourseList', compact('lessonVideoList'));
    }

    // Lesson Course Change Status
    public function changeStatus(Request $request) {

        // logger($request->all());
        $id = $request->id ;
        $status = $request->lesson_status ;

        LessonVideo::where('id', $id)->update([
            'lesson_status' => $status
        ]);

        return response()->json([
            'status' => 'success'
        ],200);
    }

    // Lesson Course Detail
    public function detail($id) {

        $lessonVideoDetail = LessonVideo::select('lessons.title as lesson_title', 'lesson_chapters.name as chapter_name', 'lesson_videos.*', 'categories.name as category_name', 'sub_categories.name as sub_category_name')
                                    ->leftJoin('lessons', 'lesson_videos.lesson_id', 'lessons.id')
                                    ->leftJoin('lesson_chapters', 'lesson_videos.lesson_chapter_id', 'lesson_chapters.id')
                                    ->leftJoin('categories', 'lesson_videos.category_id', 'categories.id')
                                    ->leftJoin('sub_categories', 'lesson_videos.sub_category_id', 'sub_categories.id')
                                    ->where('lesson_videos.id', $id)
                                    ->first();
        // dd($lessonVideoDetail->toArray());

        return view('admin.lesson.lessonCourse.lessonCourseDetail', compact('lessonVideoDetail'));
    }

    // Lesson Course Edit Page
    public function editPage($id) {

        $lessonVideoEdit = LessonVideo::select('lessons.title as lesson_title', 'lesson_chapters.name as chapter_name', 'lesson_videos.*', 'categories.name as category_name', 'sub_categories.name as sub_category_name')
                                ->leftJoin('lessons', 'lesson_videos.lesson_id', 'lessons.id')
                                ->leftJoin('lesson_chapters', 'lesson_videos.lesson_chapter_id', 'lesson_chapters.id')
                                ->leftJoin('categories', 'lesson_videos.category_id', 'categories.id')
                                ->leftJoin('sub_categories', 'lesson_videos.sub_category_id', 'sub_categories.id')
                                ->where('lesson_videos.id', $id)
                                ->first();

        return view('admin.lesson.lessonCourse.lessonCourseEdit', compact('lessonVideoEdit'));
    }

    // Lesson Course Edit
    public function edit(Request $request){

        $this->videoValidation($request);
        $data = $this->videoData($request);

        LessonVideo::where('id', $request->id)->update($data);

        Alert::warning('Update Success', 'Update Lesson Video Successfully');

        return to_route('admin#lesson#course#list')->with('update', "Update Lesson Video Successful");
    }

    // Lesson Course Delete
    public function delete($id) {

        LessonVideo::find($id)->delete();

        return back()->with('delete', "Delete Lesson Video Successful");
    }

// Private Function
    // Lesson Video Validation
    private function videoValidation($request) {
        $rule = [
            'categoryId' => 'required' ,
            'subCategoryId' => 'required' ,
            'lessonId' => 'required' ,
            'lessonChapterId' => 'required' ,
            'status' => 'required' ,
            'videoTitle' => 'required|unique:lesson_videos,video_title,' .$request->id ,
            'videoUrl' => 'required'
        ];

        $request->validate($rule);
    }

    // Lessson Video Data
    private function videoData($request) {
        return [
            'category_id' => $request->categoryId ,
            'sub_category_id' => $request->subCategoryId ,
            'lesson_id' => $request->lessonId ,
            'lesson_chapter_id' => $request->lessonChapterId ,
            'lesson_status' => $request->status ,
            'video_title' => $request->videoTitle ,
            'video_url' => $request->videoUrl
        ];
    }
}
