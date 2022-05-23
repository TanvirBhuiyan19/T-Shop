<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use Carbon\Carbon;

class SubSubcategoryController extends Controller
{
    
//==================================== Show Sub-subCategory Page =============================================//       
    public function index() {
        $subsubcategories = SubSubcategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('admin.sub-subcategory.index', compact('categories' ,'subsubcategories'));
    }   
    
//==================================== Get Subcategory By Ajax =============================================//       
    public function getSubcategory($category_id) {
        $subcategory = Subcategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcategory);
    }
    
//==================================== Create New Sub-subCategory =============================================//    
    public function createSubSubcategory(Request $request) {
        $request->validate([
            'sub_subcategory_name_en' => 'required',
            'sub_subcategory_name_bn' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
                ], [
            'sub_subcategory_name_en.required' => 'Input English Sub-subCategory Name',
            'sub_subcategory_name_bn.required' => 'Input Bangla Sub-subCategory Name',
            'category_id.required' => 'Chose a Category',
            'subcategory_id.required' => 'Chose a SubCategory',
        ]);

        SubSubcategory::insert([
            'sub_subcategory_name_en' => $request->sub_subcategory_name_en,
            'sub_subcategory_name_bn' => $request->sub_subcategory_name_bn,
            'sub_subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->sub_subcategory_name_en)),
            'sub_subcategory_slug_bn' => str_replace(' ', '-', $request->sub_subcategory_name_bn),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'SUb-subCategory Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    
//==================================== Sub-subCategory Edit =============================================//
    public function editSubSubcategory($id) {
        $subsubcategory = SubSubcategory::findOrFail($id);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('admin.sub-subcategory.edit', compact('subsubcategory', 'categories'));
    }

    
//==================================== Sub-subCategory Update =============================================//
    public function updateSubSubcategory(Request $request) {
        $request->validate([
            'sub_subcategory_name_en' => 'required',
            'sub_subcategory_name_bn' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
                ], [
            'sub_subcategory_name_en.required' => 'Input English Sub-subCategory Name',
            'sub_subcategory_name_bn.required' => 'Input Bangla Sub-subCategory Name',
            'category_id.required' => 'Chose a Category',
            'subcategory_id.required' => 'Chose a SubCategory',
        ]);

        $sub_subcategory_id = $request->sub_subcategory_id;
        
        SubSubcategory::findOrFail($sub_subcategory_id)->update([
            'sub_subcategory_name_en' => $request->sub_subcategory_name_en,
            'sub_subcategory_name_bn' => $request->sub_subcategory_name_bn,
            'sub_subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->sub_subcategory_name_en)),
            'sub_subcategory_slug_bn' => str_replace(' ', '-', $request->sub_subcategory_name_bn),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'SUb-subCategory Updated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('sub-subcategory')->with($notification);
    }

    
//==================================== Sub-subCategory Delete =============================================//
    public function deleteSubSubcategory($id) {
        SubSubcategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub-subCategory Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    
    
    
}
