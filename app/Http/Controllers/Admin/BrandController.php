<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class BrandController extends Controller {

//==================================== Show Brand Page =============================================//    
    public function index() {
        $brands = Brand::latest()->get();
        return view('admin.brand.index', compact('brands'));
    }

//==================================== Create New Brand =============================================//    
    public function createBrand(Request $request) {
        $request->validate([
            'brand_name_en' => 'required|unique:brands',
            'brand_name_bn' => 'required|unique:brands',
            'brand_logo' => 'required',
                ], [
            'brand_name_en.required' => 'Input English Brand Name',
            'brand_name_bn.required' => 'Input Bangla Brand Name',
            'brand_name_en.unique' => 'This Brand Name is Already Taken !!',
            'brand_name_bn.unique' => 'This Brand Name is Already Taken !!',
            'brand_logo.required' => 'Chose a Brand Logo',
        ]);

        //Image Upload with resize using Intervention Package
        $image = $request->file('brand_logo');
        $imageName = $request->brand_name_en . hexdec(uniqid()) . '.' . hexdec(rand()) . '.' . $image->getClientOriginalExtension();
        $directory = 'uploads/brand/';
        Image::make($image->path())->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($directory . $imageName);
        //End: Image Upload with resize using Intervention Package

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_bn' => $request->brand_name_bn,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_bn' => str_replace(' ', '-', $request->brand_name_bn),
            'brand_logo' => $imageName,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Brand Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

//==================================== Brand Edit =============================================//
    public function editBrand($id) {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

//==================================== Brand Update =============================================//
    public function updateBrand(Request $request) {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_bn' => 'required',
                ], [
            'brand_name_en.required' => 'Input English Brand Name',
            'brand_name_bn.required' => 'Input Bangla Brand Name',
        ]);

        $brandId = $request->brand_id;
        $oldImage = $request->old_brand_logo;

        if ($request->file('brand_logo') != '') {
            $directory = 'uploads/brand/';
            unlink($directory . $oldImage);
            
            //Image Upload with resize using Intervention Package
            $image = $request->file('brand_logo');
            $imageName = $request->brand_name_en .'-'. hexdec(uniqid()) .'-'. hexdec(rand()) .'.'. $image->getClientOriginalExtension();
            $directory = 'uploads/brand/';
            Image::make($image->path())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($directory . $imageName);
            //End: Image Upload with resize using Intervention Package

            Brand::findOrFail($brandId)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_bn' => $request->brand_name_bn,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_bn' => str_replace(' ', '-', $request->brand_name_bn),
                'brand_logo' => $imageName,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully !!',
                'alert-type' => 'success'
            );
            return Redirect()->route('brands')->with($notification);
        } else {
            Brand::findOrFail($brandId)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_bn' => $request->brand_name_bn,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_bn' => str_replace(' ', '-', $request->brand_name_bn),
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully !!',
                'alert-type' => 'success'
            );
            return Redirect()->route('brands')->with($notification);
        }
    }

//==================================== Brand Delete =============================================//
    public function deleteBrand($id) {
        $directory = 'uploads/brand/';
        $image_name = Brand::findOrFail($id)->brand_logo;
        unlink($directory . $image_name);
        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

}
