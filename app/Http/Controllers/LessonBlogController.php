<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LessonBlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class LessonBlogController extends Controller
{
    // Lesson Blog Create Page
    public function createPage() {
        $categoryList = Category::select('categories.id as category_id', 'categories.name as category_name', 'sub_categories.id as sub_categoy_id', 'sub_categories.name as sub_category_name')
                            ->leftJoin('sub_categories', 'categories.id', 'sub_categories.category_id')
                            ->where('categories.name', 'blog')
                            ->get();

        return view('admin.lesson.lessonBlog.lessonBlogCreate', compact('categoryList'));
    }

    // Lesson Blog Create
    public function create(Request $request) {

        $this->blogValidation($request) ;
        $data = $this->blogData($request) ;

        if( $request->hasFile('image') ) {

            $file = $request->file('image') ;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move( public_path(). '/LessonBlogImage/', $fileName );

            $data['blog_image'] = $fileName ;
        }else {
            $data['blog_image'] = null ;
        }

        LessonBlog::create($data) ;

        Alert::success('Create Success', 'Create Lesson Blog Successfully');

        return back()->with('success', "Create Lesson Blog Successful");
    }

    // Lesson Blog List
    public function list() {

        $lessonBlogList = LessonBlog::select('lesson_blogs.*', 'lessons.title as lesson_title')
                                    ->leftJoin('lessons', 'lesson_blogs.lesson_id', 'lessons.id')
                                    ->when( request('searchKey'), function($query) {
                                        $query->whereAny( ['lessons.title', 'lesson_blogs.blog_title', 'lesson_blogs.blog_status'], 'like', '%' .request('searchKey'). '%' );
                                    } )
                                    ->orderBy('lesson_blogs.created_at', 'desc')
                                    ->paginate(5);

        return view('admin.lesson.lessonBlog.lessonBlogList', compact('lessonBlogList'));
    }

    // Lesson Blog Detail
    public function detail($id) {

        $lessonBlogDetail = LessonBlog::select('lesson_blogs.*', 'lessons.title as lesson_title', 'categories.name as category_name', 'sub_categories.name as sub_category_name')
                                    ->leftJoin('lessons', 'lesson_blogs.lesson_id', 'lessons.id')
                                    ->leftJoin('categories', 'lesson_blogs.category_id', 'categories.id')
                                    ->leftJoin('sub_categories', 'lesson_blogs.sub_category_id', 'sub_categories.id')
                                    ->where('lesson_blogs.id', $id)
                                    ->first() ;

        return view('admin.lesson.lessonBlog.lessonBlogDetail', compact('lessonBlogDetail'));
    }

    // Lesson Blog Edit Page
    public function editPage($id) {

        $lessonBlogEdit = LessonBlog::select('lesson_blogs.*', 'lessons.title as lesson_title', 'categories.name as category_name', 'sub_categories.name as sub_category_name')
                                    ->leftJoin('lessons', 'lesson_blogs.lesson_id', 'lessons.id')
                                    ->leftJoin('categories', 'lesson_blogs.category_id', 'categories.id')
                                    ->leftJoin('sub_categories', 'lesson_blogs.sub_category_id', 'sub_categories.id')
                                    ->where('lesson_blogs.id', $id)
                                    ->first() ;

        return view('admin.lesson.lessonBlog.lessonBlogEdit', compact('lessonBlogEdit'));
    }

    // Lesson Blog Edit
    public function edit(Request $request) {

        $this->blogValidation($request) ;
        $data = $this->blogData($request) ;

        if( $request->hasFile('image') ) {
            if( file_exists(public_path('/LessonBlogImage/' . $request->oldImage)) ){
                unlink(public_path('/LessonBlogImage/' . $request->oldImage)) ;
            }

            $file = $request->file('image') ;
            $fileName = uniqid() . $file->getClientOriginalName() ;
            $file->move(public_path(). '/LessonBlogImage/' , $fileName) ;

            $data['blog_image'] = $fileName ;
        }else {
            $data['blog_image'] = $request->oldImage ;
        }

        LessonBlog::where('id', $request->id)->update($data);

        Alert::warning('Update Success', 'Update Lesson Blog Successfully');

        return to_route('admin#lesson#blog#list')->with('update', 'Update Lesson Blog Success');
    }

    // Lesson Blog Delete
    public function delete($id) {

        $lessonBlogDelete = LessonBlog::where('id', $id)->first();

        if($lessonBlogDelete->blog_image != null) {
            if( file_exists(public_path('LessonBlogImage/' . $lessonBlogDelete->blog_image)) ){
                unlink(public_path('LessonBlogImage/' . $lessonBlogDelete->blogImage)) ;
            }
        }

        LessonBlog::where('id', $id)->delete() ;

        return back()->with('delete', 'Delete Lesson Blog Success');
    }

// Private Function
    // Lesson Blog Validation
    private function blogValidation($request) {

        $rule = [
            'categoryId' => 'required' ,
            'subCategoryId' => 'required' ,
            'lessonId' => 'required' ,
            'status' => 'required' ,
            'blogTitle' => 'required' ,
            'image' => 'file|mimes:png,jpg,jpeg,svg'
        ];

        $request->validate($rule) ;
    }

    // Lesson Blog Data
    private function blogData($request) {

        return [
            'category_id' => $request->categoryId ,
            'sub_category_id' => $request->subCategoryId ,
            'lesson_id' => $request->lessonId ,
            'blog_title' => $request->blogTitle ,
            'blog_description' => $request->blogDescription ,
            'blog_status' => $request->status
        ];
    }
}
