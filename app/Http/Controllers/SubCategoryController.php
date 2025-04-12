<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class SubCategoryController extends Controller
{
    // Sub Category Create Page
    public function createPage() {
        $categoryList = Category::get();

        return view('admin.subCategory.subCategoryCreate', compact('categoryList'));
    }

    // Sub Category Create
    public function create(Request $request) {

        $this->subCategoryValidation($request);
        $data = $this->subCategoryData($request);

        SubCategory::create($data);

        Alert::success('Create Sub Category', 'Create Sub Category Successfully');

        return back()->with('success', "Sub Category Create Successful!");
    }

    // Sub Category List
    public function list() {
        $subCategoryList = SubCategory::select('sub_categories.*', 'categories.name as categories_name')
                                ->leftJoin('categories', 'sub_categories.category_id', 'categories.id')
                                ->when( request('searchKey'), function($query) {
                                    $query->whereAny( [ 'sub_categories.name', 'categories.name' ], 'like' , '%' . request('searchKey') . '%' );
                                } )
                                ->orderBy('sub_categories.created_at', 'desc')->paginate(5);

        return view('admin.subCategory.subCategoryList', compact('subCategoryList'));
    }

    // Sub Category Edit Page
    public function editPage($id) {

        $subCategoryList = SubCategory::where('id', $id)->first();

        $categoryList = Category::select()->get();

        return view('admin.subCategory.subCategoryEdit', compact('subCategoryList', 'categoryList'));
    }

    // Sub Category Edit
    public function edit(Request $request) {

        $this->subCategoryValidation($request);
        $data = $this->subCategoryData($request);

        SubCategory::where('id', $request->subCategoryId)->update($data);

        Alert::warning('Update Sub Category', 'Sub Category Update Successfully');

        return to_route('admin#subCategory#list')->with('update', 'Sub Category Update Success');
    }

    // Sub Category Delete
    public function delete($id) {

        SubCategory::find($id)->delete();

        return back()->with('delete', 'Sub Category Delete Success');
    }

    // Filter Lesson By SubCategory Id
    public function getLesson($subCategoryId) {
        $lesson = Lesson::where('sub_category_id', $subCategoryId)->get();

        return response()->json($lesson);
    }

// Private Function
    // Sub Category Validation
    private function subCategoryValidation($request) {
        $rule = [
            'subCategoryName' => 'required|min:2|max:99|unique:sub_categories,name,' . $request->subCategoryId ,
            'categoryId' => 'required'
        ];

        $message = [
            'categoryId.required' => "Choose Category Name field."
        ];

        $request->validate($rule, $message);
    }

    // Sub Category Data
    private function subCategoryData($request) {
        return [
            'category_id' => $request->categoryId ,
            'name'  => $request->subCategoryName ,
        ];
    }
}
