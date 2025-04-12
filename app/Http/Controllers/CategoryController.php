<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    // Category Create Page
    public function createpage() {
        return view('admin.category.categoryCreate');
    }

    // Category Create
    public function create(Request $request) {
        $this->categoryValidation($request);

        Category::create([
            'name' => $request->categoryName
        ]);

        Alert::success('Create Success', 'Create Category Successfully');

        return back()->with('success', "Create Category Successful");
    }

    // Category List
    public function list() {

        $categoryList = Category::select()
                                ->when( request('searchKey'), function($query){
                                    $query->where('name', 'like', '%' . request('searchKey') . '%');
                                } )
                                ->paginate(5);

        return view('admin.category.categoryList', compact('categoryList'));
    }

    // Category Edit Page
    public function editPage($id) {
        $editCategory = Category::where('id', $id)->first();

        return view('admin.category.categoryEdit', compact('editCategory'));
    }

    // Category Edit
    public function edit(Request $request) {

        $this->categoryValidation($request);

        Category::where('id', $request->categoryId)->update([
            'name' => $request->categoryName
        ]);

        Alert::warning('Category Update', 'Update Category Successfully');

        return to_route('admin#category#list')->with('update', 'Category Update Successful');
    }

    // Category Delete
    public function delete($id) {
        Category::find($id)->delete();

        return back()->with('delete', 'Category Delete Successful');
    }

    // Filter Subcategories by Categories
    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get();

        return response()->json($subcategories);
    }

// Private Function
    // Category Validation
    private function categoryValidation($request) {
        $rule = [
            'categoryName' => 'required|min:2|max:99|unique:categories,name,' . $request->id
        ];

        $request->validate($rule);
    }
}
