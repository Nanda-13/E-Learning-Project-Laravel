<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\LessonChapter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class LessonController extends Controller
{
    // Lesson Create Page
    public function createPage() {

        $categoryList = Category::get() ;

        return view('admin.lesson.lessonCreate', compact('categoryList'));
    }

    // Lesson Create
    public function create(Request $request) {

        $this->lessonValidation($request, 'create');
        $data = $this->lessonData($request);


        if ( $request->hasFile('image') ) {

            $file = $request->file('image') ;
            $fileName = uniqid() . $file->getClientOriginalName() ;
            $file->move( public_path() . '/LessonImage/' , $fileName );

            $data['image'] = $fileName ;
        }

        $tempData = Lesson::create($data);

        $lessonId = $tempData->id ;

        Session::put('lessonId', $lessonId);

        $lessonId = Session::get('lessonId') ;

        if ($request->has('chapter')) {
            foreach ($request->chapter as $item) {
                if($item) {
                    LessonChapter::create([
                        'lesson_id' => $lessonId ,
                        'name' => $item
                    ]);
                }
            }
        }

        Alert::success('Create Success', 'Create Lesson Successfully');

        return back()->with('success', "Create Lesson Successful");
    }

    // Lesson List
    public function list() {

        $lessonList = Lesson::select('lessons.*','categories.name as category_name', 'sub_categories.name as sub_category_name')
                            ->leftJoin('categories','lessons.category_id', 'categories.id')
                            ->leftJoin('sub_categories','lessons.sub_category_id', 'sub_categories.id')
                            ->when( request('searchKey'), function($query) {
                                $query->whereAny( [ 'lessons.title','categories.name','sub_categories.name','lessons.price' ], 'like', '%' .request('searchKey'). '%' );
                            } )
                            ->orderBy('lessons.created_at','desc')->paginate(5);

        return view('admin.lesson.lessonList', compact('lessonList'));
    }

    // Lesson Detail
    public function detail($id) {

        $lessonDetail = Lesson::select('lessons.*', 'categories.name as category_name', 'sub_categories.name as sub_category_name')
                                    ->leftJoin('categories','lessons.category_id', 'categories.id')
                                    ->leftJoin('sub_categories','lessons.sub_category_id', 'sub_categories.id')
                                    ->where('lessons.id', $id)
                                    ->first();

        $lessonChapter = Lesson::select('lesson_chapters.name as lesson_chapter')
                                ->leftJoin('lesson_chapters', 'lessons.id', 'lesson_chapters.lesson_id')
                                ->where('lessons.id', $id)
                                ->get();

        return view('admin.lesson.lessonDetail', compact('lessonDetail', 'lessonChapter'))->with('detail', "Lesson Detail");
    }

    // Lesson Edit Page
    public function editPage($id) {

        $lessonEdit = Lesson::select('lessons.*', 'sub_categories.name as sub_category_name')
                            ->leftJoin('sub_categories', 'lessons.sub_category_id', 'sub_categories.id')
                            ->where('lessons.id', $id)->first();

        $categoryList = Category::select()->get();

        $lessonChapterEdit = Lesson::select('lesson_chapters.name as lesson_chapter', 'lesson_chapters.id as lesson_chapter_id')
                                ->leftJoin('lesson_chapters', 'lessons.id', 'lesson_chapters.lesson_id')
                                ->where('lessons.id', $id)
                                ->get();

        return view('admin.lesson.lessonEdit', compact('lessonEdit', 'lessonChapterEdit', 'categoryList'));
    }

    // Lesson Edit
    public function edit(Request $request) {

        $this->lessonValidation($request, 'edit');

        $data = $this->lessonData($request);

        if ( $request->hasFile('image') ) {
            if( file_exists( public_path('/LessonImage/'. $request->oldImage) ) ){
                unlink( public_path('/LessonImage/' . $request->oldImage) );
            }

            $file = $request->file('image') ;
            $fileName = uniqid() . $file->getClientOriginalName() ;
            $file->move( public_path(). '/LessonImage/', $fileName );

            $data['image'] = $fileName ;
        }else {
            $data['image'] = $request->oldImage ;
        }

        Lesson::where('id', $request->id)->update($data);

        LessonChapter::where('lesson_id', $request->id)->delete();   // Delete Chapter

        foreach ($request->chapter as $item) {                      // Create Chapter
            if($item) {
                LessonChapter::create([
                    'lesson_id' => $request->id ,
                    'name' => $item
                ]);
            }
        }

        Alert::success('Update Lesson', 'Lesson Update Success');

        return to_route('admin#lesson#list')->with('update',"Lesson Update Successfully");
    }

    // Lesson Delete
    public function delete($id) {

        $lessonDelete = Lesson::where('id', $id)->first();

        if (file_exists(public_path('LessonImage/' . $lessonDelete->image))) {
            unlink(public_path('LessonImage/' . $lessonDelete->image)) ;
        }

        Lesson::where('id', $id)->delete() ;

        LessonChapter::where('lesson_id', $id)->delete() ;

        return back()->with('delete', 'Lesson Delete Successful');
    }

    // Filter Lesson Chapter By Lesson Id
    public function getLessonCapter($lessonId) {
        $lessonChapter = LessonChapter::where('lesson_id', $lessonId)->get() ;

        return response()->json($lessonChapter);
    }

// Private Function
    // Lesson Validation
    private function lessonValidation($request, $action) {

        $rule = [
            'title' => 'required|min:2|max:99|unique:lessons,title,' . $request->id ,
            'categoryId' => 'required' ,
            'lessonLevel' => 'required' ,
            'subCategoryId' => 'required' ,
            'price' => 'required' ,
            'duration' => 'required' ,
            'description' => 'required' ,
        ];

        $rule['image'] = $action == 'create' ? 'required|mimes:png,jpg,jpeg' : 'mimes:png,jpg,jpeg' ;

        $request->validate($rule);

    }

    // Lesson Data
    private function lessonData($request) {
        return [
            'category_id' => $request->categoryId ,
            'sub_category_id' => $request->subCategoryId ,
            'title' => $request->title ,
            'description' => $request->description ,
            'duration' => $request->duration ,
            'price' => $request->price ,
            'lesson_level' => $request->lessonLevel ,
        ];
    }
}
