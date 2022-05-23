<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\ProductMultiImg;
use App\Models\ProductReview;

class IndexController extends Controller {

//==================================== Home Page Show  =============================================//     
    public function index() {
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
        $brands = Brand::orderBy('brand_name_en', 'ASC')->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->take(10)->get();
        $feature_products = Product::where('status', 1)->where('featured', 1)->orderBy('id', 'DESC')->get();
           
        return view('frontend.home', compact('sliders', 'brands', 'categories', 'products', 'feature_products'));
    }

//==================================== Product Details/Single Product Show Page  =============================================//     
    public function singleProductShow($slug) {
        $product = Product::where('status', 1)->where('product_slug_en', $slug)->orWhere('product_slug_bn',$slug)->first();
        $subcatwise_products = Product::where('status', 1)->where('subcategory_id', $product->subcategory_id)
                ->where('id', '!=', $product->id)->get();
        $colors_en = explode(',', $product->product_color_en);
        $colors_bn = explode(',', $product->product_color_bn);
        $sizes_en = explode(',', $product->product_size_en);
        $sizes_bn = explode(',', $product->product_size_bn);
        $tags_en = explode(',', $product->product_tag_en);
        $tags_bn = explode(',', $product->product_tag_bn);
        //Product Review
        $product_reviews = ProductReview::with('user')->where('product_id', $product->id)->where('status','Approve')->latest()->get();
        $rating = ProductReview::where('product_id', $product->id)->where('status','Approve')->avg('rating');
        $avgRating = number_format($rating,1);
        $avgCeilRating = ceil($avgRating);
        return view('frontend.product-details', compact('product', 'subcatwise_products', 'colors_en', 'colors_bn', 
                'sizes_en', 'sizes_bn', 'tags_en', 'tags_bn', 'product_reviews', 'avgRating', 'avgCeilRating'));
    }

//==================================== Category Wise Product Show  =============================================//     
    public function catWiseProduct(Request $request, $slug) {
        $category = Category::where('category_slug_en',$slug)->orWhere('category_slug_bn',$slug)->first();
        
        $sort = '';
        if ($request->sortBy != null) {
             $sort = $request->sortBy;
        }

        if ($category == null) {
            return view('errors.404');
        }else {
            if($sort == 'priceLowesttoHighest'){
                $products = Product::where('status', 1)->where('category_id',$category->id)
                    ->orderBy('selling_price','ASC')->paginate(6);
            }elseif($sort == 'priceHighesttoLowest'){
                $products = Product::where('status', 1)->where('category_id',$category->id)
                    ->orderBy('selling_price','DESC')->paginate(6);
            }elseif($sort == 'nameAtoZ'){
                $products = Product::where('status', 1)->where('category_id',$category->id)
                    ->orderBy('product_name_en','ASC')->paginate(6);
            }elseif($sort == 'nameZtoA'){
                $products = Product::where('status', 1)->where('category_id',$category->id)
                    ->orderBy('product_name_en','DESC')->paginate(6);
            }else{
                $products = Product::where('status', 1)->where('category_id',$category->id)
                ->orderBy('id','DESC')->paginate(6);
            }
        }
        
        
        //loadmore product with ajax
        if ($request->ajax() ) {
            $grid_view = view('frontend.include.grid_view_product',compact('products'))->render();
            $list_view = view('frontend.include.list_view_product',compact('products'))->render();
            return response()->json(['grid_view' => $grid_view, 'list_view'=>$list_view]);
        }


        $route = 'products/category';
        $catSlug = $slug; 
        return view('frontend.category-products', compact('products', 'category', 'catSlug', 'sort', 'route'));
    }

//==================================== SUbCategory Wise Product  =============================================//     
    public function subCatWiseProduct(Request $request, $slug) {
        $subcategory = Subcategory::where('subcategory_slug_en',$slug)->orWhere('subcategory_slug_bn',$slug)->first();

        $sort = '';
        if ($request->sortBy != null) {
             $sort = $request->sortBy;
        }

        if ($subcategory == null) {
            return view('errors.404');
        }else {
            if($sort == 'priceLowesttoHighest'){
                $subcat_wise_products = Product::where(['status' => 1, 'subcategory_id' => $subcategory->id])
                    ->orderBy('selling_price','ASC')->paginate(12);
            }elseif($sort == 'priceHighesttoLowest'){
                $subcat_wise_products = Product::where(['status' => 1, 'subcategory_id' => $subcategory->id])
                    ->orderBy('selling_price','DESC')->paginate(12);
            }elseif($sort == 'nameAtoZ'){
                $subcat_wise_products = Product::where(['status' => 1, 'subcategory_id' => $subcategory->id])
                    ->orderBy('product_name_en','ASC')->paginate(12);
            }elseif($sort == 'nameZtoA'){
                $subcat_wise_products = Product::where(['status' => 1, 'subcategory_id' => $subcategory->id])
                    ->orderBy('product_name_en','DESC')->paginate(12);
            }else{
                $subcat_wise_products = Product::where('status', 1)->where('subcategory_id',$subcategory->id)
                    ->orderBy('id','DESC')->paginate(12);
            }
        }

        $route = 'products/subcategory';
        $subCatSlug = $slug; 
        return view('frontend.subcategory-products', compact('subcat_wise_products', 'subcategory', 'sort', 'subCatSlug', 'route'));
    }
//==================================== SUb-SubCategory Wise Product  =============================================//     
    public function subSubcatWiseProduct(Request $request, $slug) {
        $sub_subcategory = SubSubcategory::where('sub_subcategory_slug_en',$slug)->orWhere('sub_subcategory_slug_bn',$slug)->first();
        
        $sort = '';
        if ($request->sortBy != null) {
             $sort = $request->sortBy;
        }

        if ($sub_subcategory == null) {
            return view('errors.404');
        }else {
            if($sort == 'priceLowesttoHighest'){
                $sub_subcat_wise_products = Product::where('status', 1)->where('sub_subcategory_id',$sub_subcategory->id)
                ->orderBy('selling_price','ASC')->paginate(12);
            }elseif($sort == 'priceHighesttoLowest'){
                $sub_subcat_wise_products = Product::where('status', 1)->where('sub_subcategory_id',$sub_subcategory->id)
                ->orderBy('selling_price','DESC')->paginate(12);
            }elseif($sort == 'nameAtoZ'){
                $sub_subcat_wise_products = Product::where('status', 1)->where('sub_subcategory_id',$sub_subcategory->id)
                ->orderBy('product_name_en','ASC')->paginate(12);
            }elseif($sort == 'nameZtoA'){
                $sub_subcat_wise_products = Product::where('status', 1)->where('sub_subcategory_id',$sub_subcategory->id)
                ->orderBy('product_name_en','DESC')->paginate(12);
            }else{
                $sub_subcat_wise_products = Product::where('status', 1)->where('sub_subcategory_id',$sub_subcategory->id)
                ->orderBy('id','DESC')->paginate(12);
            }
        }

        $route = 'products/sub-subcategory';
        $subSubCatSlug = $slug; 
        return view('frontend.sub-subcategory-products', compact('sub_subcat_wise_products', 'sub_subcategory', 'sort', 'subSubCatSlug', 'route'));
    }
    
//==================================== Tag Wise Product Show  =============================================//     
    public function tagWiseProduct(Request $request, $tag) {
        $sort = '';
        if ($request->sortBy != null) {
             $sort = $request->sortBy;
        }

        if($sort == 'priceLowesttoHighest'){
                $tag_wise_products = Product::where('status', 1)->where('product_tag_en','LIKE','%'.$tag.'%')
                ->orWhere('product_tag_bn','LIKE','%'.$tag.'%')
                ->orderBy('selling_price','ASC')->paginate(12);
        }elseif($sort == 'priceHighesttoLowest'){
                $tag_wise_products = Product::where('status', 1)->where('product_tag_en','LIKE','%'.$tag.'%')
                ->orWhere('product_tag_bn','LIKE','%'.$tag.'%')
                ->orderBy('selling_price','DESC')->paginate(12);
        }elseif($sort == 'nameAtoZ'){
                $tag_wise_products = Product::where('status', 1)->where('product_tag_en','LIKE','%'.$tag.'%')
                ->orWhere('product_tag_bn','LIKE','%'.$tag.'%')
                ->orderBy('product_name_en','ASC')->paginate(12);
        }elseif($sort == 'nameZtoA'){
                $tag_wise_products = Product::where('status', 1)->where('product_tag_en','LIKE','%'.$tag.'%')
                ->orWhere('product_tag_bn','LIKE','%'.$tag.'%')
                ->orderBy('product_name_en','DESC')->paginate(12);
        }else{
            $tag_wise_products = Product::where('status', 1)->where('product_tag_en','LIKE','%'.$tag.'%')
            ->orWhere('product_tag_bn','LIKE','%'.$tag.'%')
            ->orderBy('id','DESC')->paginate(12);
        }

        $route = 'products/tag';
        $tag_name = $tag;
        return view('frontend.tag-products', compact('tag_wise_products', 'tag_name', 'sort', 'route'));
    }


//==================================== Brand Wise Product  =============================================//     
    public function brandWiseProduct(Request $request, $slug) {
        $brand = Brand::where('brand_slug_en',$slug)->orWhere('brand_slug_bn',$slug)->first();
        
        $sort = '';
        if ($request->sortBy != null) {
             $sort = $request->sortBy;
        }

        if ($brand == null) {
            return view('errors.404');
        }else {
            if($sort == 'priceLowesttoHighest'){
                $brand_wise_products = Product::where('status', 1)->where('brand_id',$brand->id)
                ->orderBy('selling_price','ASC')->paginate(12);
            }elseif($sort == 'priceHighesttoLowest'){
                $brand_wise_products = Product::where('status', 1)->where('brand_id',$brand->id)
                ->orderBy('selling_price','DESC')->paginate(12);
            }elseif($sort == 'nameAtoZ'){
                $brand_wise_products = Product::where('status', 1)->where('brand_id',$brand->id)
                ->orderBy('product_name_en','ASC')->paginate(12);
            }elseif($sort == 'nameZtoA'){
                $brand_wise_products = Product::where('status', 1)->where('brand_id',$brand->id)
                ->orderBy('product_name_en','DESC')->paginate(12);
            }else{
                $brand_wise_products = Product::where('status', 1)->where('brand_id',$brand->id)
                ->orderBy('id','DESC')->paginate(12);
            }
        }

        $route = 'products/brand';
        $brandSlug = $slug; 
        return view('frontend.brand-products', compact('brand_wise_products', 'brand', 'brandSlug', 'sort', 'route'));
    }

    

//==================================== COlor Wise Product  =============================================//     
    public function colorWiseProduct(Request $request, $color) {
        $color_name = $color;
        
        $sort = '';
        if ($request->sortBy != null) {
             $sort = $request->sortBy;
        }

        
        if($sort == 'priceLowesttoHighest'){
            $color_wise_products = Product::where('status', 1)->where('product_color_en','LIKE','%'.$color.'%')
            ->orWhere('product_color_bn','LIKE','%'.$color.'%')
            ->orderBy('selling_price','ASC')->paginate(12);
        }elseif($sort == 'priceHighesttoLowest'){
            $color_wise_products = Product::where('status', 1)->where('product_color_en','LIKE','%'.$color.'%')
            ->orWhere('product_color_bn','LIKE','%'.$color.'%')
            ->orderBy('selling_price','DESC')->paginate(12);
        }elseif($sort == 'nameAtoZ'){
            $color_wise_products = Product::where('status', 1)->where('product_color_en','LIKE','%'.$color.'%')
            ->orWhere('product_color_bn','LIKE','%'.$color.'%')
            ->orderBy('product_name_en','ASC')->paginate(12);
        }elseif($sort == 'nameZtoA'){
            $color_wise_products = Product::where('status', 1)->where('product_color_en','LIKE','%'.$color.'%')
            ->orWhere('product_color_bn','LIKE','%'.$color.'%')
            ->orderBy('product_name_en','DESC')->paginate(12);
        }else{
            $color_wise_products = Product::where('status', 1)->where('product_color_en','LIKE','%'.$color.'%')
            ->orWhere('product_color_bn','LIKE','%'.$color.'%')
            ->orderBy('id','DESC')->paginate(12);
        }

        $route = 'products/color';
        return view('frontend.color-products', compact('color_wise_products', 'color_name', 'sort', 'route'));
    }
    

//==================================== Product View With Ajax  =============================================//     
    public function productViewAjax($id) {
        $product = Product::with('category','subcategory','sub_subcategory','brand')->findOrFail($id);
        $multipleimg = ProductMultiImg::where('product_id',$id)->get();
        $colors_en = explode(',', $product->product_color_en);
        $colors_bn = explode(',', $product->product_color_bn);
        $sizes_en = explode(',', $product->product_size_en);
        $sizes_bn = explode(',', $product->product_size_bn);
        return response()->json(array(
            'product' => $product,
            'multipleimg' => $multipleimg,
            'colors_en' => $colors_en,
            'colors_bn' => $colors_bn,
            'sizes_en' => $sizes_en,
            'sizes_bn' => $sizes_bn,
        ));
    }

 
//==================================== Privacy Policy Page Show  =============================================//     
    public function privacyPolicy() {
        return view('frontend.privacy-policy');
    }

 

//==================================== Terms of Service Page Show  =============================================//     
public function termsOfUse() {
    return view('frontend.terms-of-use');
}





    
}
