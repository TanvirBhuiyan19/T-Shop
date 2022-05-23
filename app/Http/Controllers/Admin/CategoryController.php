<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     
//==================================== Show Category Page =============================================//       
   public function index() {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

       
//==================================== Create New Category =============================================//    
    public function createCategory(Request $request) {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'category_icon' => 'required',
                ], [
            'category_name_en.required' => 'Input English Category Name',
            'category_name_bn.required' => 'Input Bangla Category Name',
            'category_icon.required' => 'Enter a Category Icon Class Name',
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_bn' => $request->category_name_bn,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_bn' => str_replace(' ', '-', $request->category_name_bn),
            'category_icon' => $request->category_icon,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Category Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

  
    
//==================================== Category Edit =============================================//
    public function editCategory($id) {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

//==================================== Category Update =============================================//
    public function updateCategory(Request $request) {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'category_icon' => 'required',
                ], [
            'category_name_en.required' => 'Input English Category Name',
            'category_name_bn.required' => 'Input Bangla Category Name',
            'category_icon.required' => 'Enter a Category Icon Class Name',
        ]);

        $categoryId = $request->category_id;

            Category::findOrFail($categoryId)->update([
                'category_name_en' => $request->category_name_en,
                'category_name_bn' => $request->category_name_bn,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_bn' => str_replace(' ', '-', $request->category_name_bn),
                'category_icon' => $request->category_icon,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Category Updated Successfully !!',
                'alert-type' => 'success'
            );
            return Redirect()->route('category')->with($notification);
       
    }

//==================================== Category Delete =============================================//
    public function deleteCategory($id) {
        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

 
}
