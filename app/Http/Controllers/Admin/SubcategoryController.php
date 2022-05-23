<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller {

//==================================== Show Sub-Category Page =============================================//       
    public function index() {
        $subcategories = Subcategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('admin.subcategory.index', compact('subcategories', 'categories'));
    }

//==================================== Create New Sub-Category =============================================//    
    public function createSubcategory(Request $request) {
        $request->validate([
            'subcategory_name_en' => 'required',
            'subcategory_name_bn' => 'required',
            'category_id' => 'required',
                ], [
            'subcategory_name_en.required' => 'Input English Sub-Category Name',
            'subcategory_name_bn.required' => 'Input Bangla Sub-Category Name',
            'category_id.required' => 'Chose a Category',
        ]);

        Subcategory::insert([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_bn' => $request->subcategory_name_bn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_bn' => str_replace(' ', '-', $request->subcategory_name_bn),
            'category_id' => $request->category_id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'SUb-Category Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

//==================================== Sub-Category Edit =============================================//
    public function editSubcategory($id) {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

//==================================== Sub-Category Update =============================================//
    public function updateSubcategory(Request $request) {
        $request->validate([
            'subcategory_name_en' => 'required',
            'subcategory_name_bn' => 'required',
            'category_id' => 'required',
                ], [
            'subcategory_name_en.required' => 'Input English Sub-Category Name',
            'subcategory_name_bn.required' => 'Input Bangla Sub-Category Name',
            'category_id.required' => 'Chose a Category',
        ]);

        $subcategory_id = $request->subcategory_id;
        
        Subcategory::findOrFail($subcategory_id)->update([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_bn' => $request->subcategory_name_bn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_bn' => str_replace(' ', '-', $request->subcategory_name_bn),
            'category_id' => $request->category_id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Sub-Category Updated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('subcategory')->with($notification);
    }

//==================================== Sub-Category Delete =============================================//
    public function deleteSubcategory($id) {
        Subcategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub-Category Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

}
