<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubSubcategory;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\ProductMultiImg;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProductController extends Controller {

//==================================== Show Manage Product Page =============================================//       
    public function manageProduct() {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('admin.product.manage', compact('products'));
    }

//==================================== Show Add Product Page =============================================//       
    public function addProduct() {
        $brands = Brand::orderBy('brand_name_en', 'ASC')->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('admin.product.add', compact('brands', 'categories'));
    }

//==================================== Get Subcategory By Ajax =============================================//       
    public function getSubSubcategory($subcategory_id) {
        $sub_subcategory = SubSubcategory::where('subcategory_id', $subcategory_id)->orderBy('sub_subcategory_name_en', 'ASC')->get();
        return json_encode($sub_subcategory);
    }

//====================================  Create New Product =============================================//       
    public function createProduct(Request $request) {
        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'sub_subcategory_id' => 'required',
            'product_name_en' => 'required|unique:products,product_name_en',
            'product_name_bn' => 'required|unique:products,product_name_bn',
            'product_code' => 'required',
            'product_qty' => 'required',
            'product_tag_en' => 'required',
            'product_tag_bn' => 'required',
            'product_color_en' => 'required',
            'product_color_bn' => 'required',
            'selling_price' => 'required',
            'short_descp_en' => 'required',
            'short_descp_bn' => 'required',
            'long_descp_en' => 'required',
            'long_descp_bn' => 'required',
            'product_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ], [
            'brand_id.required' => 'Brand name is required',
            'category_id.required' => 'Category name is required',
            'subcategory_id.required' => 'Subcategory name is required',
            'sub_subcategory_id.required' => 'Sub-subCategory name is required',
            'product_name_en.required' => 'Product name english is required',
            'product_name_en.unique' => 'This Product name already exist',
            'product_name_bn.required' => 'Product name bangla is required',
            'product_name_bn.unique' => 'This Product name already exist',
            'product_code.required' => 'Code is required',
            'product_qty.required' => 'Quantity is required',
            'product_tag_en.required' => 'Tag english is required',
            'product_tag_bn.required' => 'Tag bangla is required',
            'product_color_en.required' => 'Color english is required',
            'product_color_bn.required' => 'Color bangla is required',
            'selling_price.required' => 'Selling price is required',
            'short_descp_en.required' => 'Short description english is required',
            'short_descp_bn.required' => 'Short description bangla is required',
            'long_descp_en.required' => 'Long description english is required',
            'long_descp_bn.required' => 'Long description bangla is required',
            'product_thumbnail.required' => 'Thumbnail is required',
        ]);

        //Image Upload with resize using Intervention Package
        $thumbnail = $request->file('product_thumbnail');
        $thumbnailName = $request->product_name_en . '-' . hexdec(uniqid()) . '-' . hexdec(rand()) . '.' . $thumbnail->getClientOriginalExtension();
        $directory = 'uploads/product/thumbnail/';
        Image::make($thumbnail->path())->resize(317, 346)->save($directory . $thumbnailName);
        //End: Image Upload with resize using Intervention Package

        if ($request->product_size_en) {
            $product_size_en = implode(',', $request->product_size_en);
            $product_size_bn = implode(',', $request->product_size_bn);
        } else {
            $product_size_en = NULL;
            $product_size_bn = NULL;
        }

        $product_id = Product::insertGetId([
                    'brand_id' => $request->brand_id,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'sub_subcategory_id' => $request->sub_subcategory_id,
                    'product_name_en' => $request->product_name_en,
                    'product_name_bn' => $request->product_name_bn,
                    'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
                    'product_slug_bn' => str_replace(' ', '-', $request->product_name_bn),
                    'product_code' => $request->product_code,
                    'product_qty' => $request->product_qty,
                    'product_tag_en' => $request->product_tag_en,
                    'product_tag_bn' => $request->product_tag_bn,
                    'product_size_en' => $product_size_en,
                    'product_size_bn' => $product_size_bn,
                    'product_color_en' => $request->product_color_en,
                    'product_color_bn' => $request->product_color_bn,
                    'selling_price' => $request->selling_price,
                    'discount_price' => $request->discount_price,
                    'short_descp_en' => $request->short_descp_en,
                    'short_descp_bn' => $request->short_descp_bn,
                    'long_descp_en' => $request->long_descp_en,
                    'long_descp_bn' => $request->long_descp_bn,
                    'product_thumbnail' => $thumbnailName,
                    'hot_deal' => $request->hot_deal,
                    'featured' => $request->featured,
                    'special_offer' => $request->special_offer,
                    'special_deal' => $request->special_deal,
                    'status' => 1,
                    'created_at' => Carbon::now(),
        ]);

/////////// Start: Multiple Image Upload ///////////////////////        
        $images = $request->multi_img;
        foreach ($images as $image) {
            //Image Upload with resize using Intervention Package
            $imageName = $request->product_name_en . '-' . hexdec(uniqid()) . '-' . hexdec(rand()) . '.' . $image->getClientOriginalExtension();
            $directory = 'uploads/product/multiple-image/';
            Image::make($image->path())->resize(317, 346)->save($directory . $imageName);
            //End: Image Upload with resize using Intervention Package

            ProductMultiImg::insert([
                'product_id' => $product_id,
                'product_image' => $imageName,
                'created_at' => Carbon::now(),
            ]);
        }
/////////// End: Multiple Image Upload ///////////////////////       

        $notification = array(
            'message' => 'Product Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('product.manage')->with($notification);
    }

//==================================== View Product Page Show =============================================//       
    public function viewProduct($id) {
        $product = Product::findOrFail($id);
        $brands = Brand::orderBy('brand_name_en', 'ASC')->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $multiple_images = ProductMultiImg::where('product_id', $id)->get();
        return view('admin.product.view', compact('product', 'brands', 'categories', 'multiple_images'));
    }

//==================================== Clone Product  =============================================//       
    public function cloneProduct($id) {
        $product = Product::findOrFail($id);

        //Single Image Copy
        $thumbnail = 'uploads/product/thumbnail/' . $product->product_thumbnail;
        $ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
        $thumbnailName = 'copy' . '-' . $product->product_name_en . '-' . hexdec(uniqid()) . '-' . hexdec(rand()) . '.' . $ext;
        $directory = 'uploads/product/thumbnail/' . $thumbnailName;
        File::copy($thumbnail, $directory);
        //Single Image Copy : End

        $product_id = Product::insertGetId([
                    'brand_id' => $product->brand_id,
                    'category_id' => $product->category_id,
                    'subcategory_id' => $product->subcategory_id,
                    'sub_subcategory_id' => $product->sub_subcategory_id,
                    'product_name_en' => 'copy' . '-' . $product->product_name_en,
                    'product_name_bn' => 'কপি' . '-' . $product->product_name_bn,
                    'product_slug_en' => 'copy' . '-' . $product->product_slug_en,
                    'product_slug_bn' => 'কপি' . '-' . $product->product_slug_bn,
                    'product_code' => $product->product_code,
                    'product_qty' => $product->product_qty,
                    'product_tag_en' => $product->product_tag_en,
                    'product_tag_bn' => $product->product_tag_bn,
                    'product_size_en' => $product->product_size_en,
                    'product_size_bn' => $product->product_size_bn,
                    'product_color_en' => $product->product_color_en,
                    'product_color_bn' => $product->product_color_bn,
                    'selling_price' => $product->selling_price,
                    'discount_price' => $product->discount_price,
                    'short_descp_en' => $product->short_descp_en,
                    'short_descp_bn' => $product->short_descp_bn,
                    'long_descp_en' => $product->long_descp_en,
                    'long_descp_bn' => $product->long_descp_bn,
                    'product_thumbnail' => $thumbnailName,
                    'hot_deal' => $product->hot_deal,
                    'featured' => $product->featured,
                    'special_offer' => $product->special_offer,
                    'special_deal' => $product->special_deal,
                    'status' => 0,
                    'created_at' => Carbon::now(),
        ]);

        $multiple_images = ProductMultiImg::where('product_id', $id)->get();
        //Multiple Image Copy
        foreach ($multiple_images as $image) {
            $product_image = 'uploads/product/multiple-image/' . $image->product_image;
            $ext = pathinfo($product_image, PATHINFO_EXTENSION);
            $product_imageName = 'copy' . '-' . $product->product_name_en . '-' . hexdec(uniqid()) . '-' . hexdec(rand()) . '.' . $ext;
            $directory = 'uploads/product/multiple-image/' . $product_imageName;
            File::copy($product_image, $directory);

            ProductMultiImg::insert([
                'product_id' => $product_id,
                'product_image' => $product_imageName,
                'created_at' => Carbon::now(),
            ]);
        }
        //Multiple Image Copy : End

        $notification = array(
            'message' => 'Product Cloned Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('product.manage')->with($notification);
    }

//==================================== Edit Product Page Show =============================================//       
    public function editProduct($id) {
        $product = Product::findOrFail($id);
        $brands = Brand::orderBy('brand_name_en', 'ASC')->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $multiple_images = ProductMultiImg::where('product_id', $id)->get();
        return view('admin.product.edit', compact('product', 'brands', 'categories', 'multiple_images'));
    }

//==================================== Update Product =============================================//       
    public function updateProduct(Request $request) {
        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'sub_subcategory_id' => 'required',
            'product_name_en' => 'required',
            'product_name_bn' => 'required',
            'product_code' => 'required',
            'product_qty' => 'required',
            'product_tag_en' => 'required',
            'product_tag_bn' => 'required',
            'product_color_en' => 'required',
            'product_color_bn' => 'required',
            'selling_price' => 'required',
            'short_descp_en' => 'required',
            'short_descp_bn' => 'required',
            'long_descp_en' => 'required',
            'long_descp_bn' => 'required',
                ], [
            'brand_id.required' => 'Brand name is required',
            'category_id.required' => 'Category name is required',
            'subcategory_id.required' => 'Subcategory name is required',
            'sub_subcategory_id.required' => 'Sub-subCategory name is required',
            'product_name_en.required' => 'Product name english is required',
            'product_name_bn.required' => 'Product name bangla is required',
            'product_code.required' => 'Code is required',
            'product_qty.required' => 'Quantity is required',
            'product_tag_en.required' => 'Tag english is required',
            'product_tag_bn.required' => 'Tag bangla is required',
            'product_color_en.required' => 'Color english is required',
            'product_color_bn.required' => 'Color bangla is required',
            'selling_price.required' => 'Selling price is required',
            'short_descp_en.required' => 'Short description english is required',
            'short_descp_bn.required' => 'Short description bangla is required',
            'long_descp_en.required' => 'Long description english is required',
            'long_descp_bn.required' => 'Long description bangla is required',
        ]);

        $product_id = $request->product_id;

        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_id' => $request->sub_subcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_bn' => $request->product_name_bn,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_bn' => str_replace(' ', '-', $request->product_name_bn),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tag_en' => $request->product_tag_en,
            'product_tag_bn' => $request->product_tag_bn,
            'product_size_en' => $request->product_size_en,
            'product_size_bn' => $request->product_size_bn,
            'product_color_en' => $request->product_color_en,
            'product_color_bn' => $request->product_color_bn,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_bn' => $request->short_descp_bn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_bn' => $request->long_descp_bn,
            'hot_deal' => $request->hot_deal,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deal' => $request->special_deal,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('product.manage')->with($notification);
    }

//==================================== Product Thumbnail Update =============================================//       
    public function thumbUpdateProduct(Request $request) {
        $product_id = $request->product_id;

        //Image Upload with resize using Intervention Package
        $thumbnail = $request->file('product_thumbnail');
        $thumbnailName = $request->product_name_en . '-' . hexdec(uniqid()) . '-' . hexdec(rand()) . '.' . $thumbnail->getClientOriginalExtension();
        $directory = 'uploads/product/thumbnail/';
        Image::make($thumbnail->path())->resize(317, 346)->save($directory . $thumbnailName);
        //End: Image Upload with resize using Intervention Package

        $old_thumbnail = $request->old_thumbnail;
        unlink($directory . $old_thumbnail);

        Product::findOrFail($product_id)->update([
            'product_thumbnail' => $thumbnailName,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Thumbnail Updated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('product.manage')->with($notification);
    }

//==================================== Delete Product  =============================================//       
    public function deleteProduct($id) {
        $product = Product::findOrFail($id);
        $directory = 'uploads/product/thumbnail/';
        unlink($directory . $product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $multi_images = ProductMultiImg::where('product_id', $id)->get();
        foreach ($multi_images as $image) {
            $multi_img_directory = 'uploads/product/multiple-image/';
            unlink($multi_img_directory . $image->product_image);
            ProductMultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

//==================================== Update/Add Product Multiple Image  =============================================//       
    public function updateProductImage(Request $request) {
        $product_id = $request->product_id;
        $images = $request->multi_img;

        foreach ($images as $image) {
            //Image Upload with resize using Intervention Package
            $imageName = $request->product_name_en . '-' . hexdec(uniqid()) . '-' . hexdec(rand()) . '.' . $image->getClientOriginalExtension();
            $directory = 'uploads/product/multiple-image/';
            Image::make($image->path())->resize(317, 346)->save($directory . $imageName);
            //End: Image Upload with resize using Intervention Package

            ProductMultiImg::insert([
                'product_id' => $product_id,
                'product_image' => $imageName,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Multiple Image Added Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

//==================================== Delete Product Multiple Image  =============================================//       
    public function deleteProductImage($id) {
        $image = ProductMultiImg::findOrFail($id);

        $multi_img_directory = 'uploads/product/multiple-image/';
        unlink($multi_img_directory . $image->product_image);
        ProductMultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Image Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

//==================================== Active Product Page =============================================//       
    public function activeProduct($id) {
        Product::findOrFail($id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Status Activated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

//==================================== In-Active Product Page =============================================//       
    public function inactiveProduct($id) {
        Product::findOrFail($id)->update([
            'status' => 0,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Status In-Activated Successfully !!',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }

}
