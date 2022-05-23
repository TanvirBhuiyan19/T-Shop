<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ShopController extends Controller
{
    public function shopPage(Request $request){
        $products = Product::query();
        
        //Category
        if( !empty($_GET['category']) ){
            $slugs = explode(',', $_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug_en', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('category_id', $catIds);
        }
        
        //Brand
        if( !empty($_GET['brand']) ){
            $slugs = explode(',', $_GET['brand']);
            $brandIds = Brand::select('id')->whereIn('brand_slug_en', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('brand_id', $brandIds);
        }
        
        //Price Range Filter
        if( !empty($_GET['price']) ){
            $price = explode('-', $_GET['price']);
            $products = $products->where('status',1)->whereBetween('selling_price', $price);
        }
        
        //SortBy
        if( !empty($_GET['sortBy']) ){
            if($_GET['sortBy'] == 'priceLowesttoHighest'){
                    $products = $products->where('status',1)->orderBy('selling_price','ASC')->paginate(12);
            }elseif($_GET['sortBy'] == 'priceHighesttoLowest'){
                    $products = $products->where('status',1)->orderBy('selling_price','DESC')->paginate(12);
            }elseif($_GET['sortBy'] == 'nameAtoZ'){
                    $products = $products->where('status',1)->orderBy('product_name_en','ASC')->paginate(12);
            }elseif($_GET['sortBy'] == 'nameZtoA'){
                    $products = $products->where('status',1)->orderBy('product_name_en','DESC')->paginate(12);
            }else{
                    $products = $products->where('status',1)->orderBy('id', 'DESC')->paginate(12);
            }
        }else{
            $products = $products->where('status',1)->orderBy('id', 'DESC')->paginate(12);
        }
        
        
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $brands = Brand::orderBy('brand_name_en','ASC')->get();
        
        return view('frontend.shop', compact('products', 'categories', 'brands'));
    }
    
    
    
    
    public function shopByFilter(Request $request){
        $data = $request->all();
        
        //Category Filter
        $catURL = '';
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .= '&category='.$category;
                }else{
                    $catURL .= ','.$category;
                }
            }
        }
        
        //Brand Filter
        $brandURL = '';
        if(!empty($data['brand'])){
            foreach($data['brand'] as $brand){
                if(empty($brandURL)){
                    $brandURL .= '&brand='.$brand;
                }else{
                    $brandURL .= ','.$brand;
                }
            }
        }
        
        //priceRange Filter
        $priceRangeURL = '';
        if(!empty($data['price_range'])){
            $priceRangeURL .= '&price='.$data['price_range'];
        }
        
        //SortBy Filter
        $sortByURL = '';
        if(!empty($data['sortBy'])){
            $sortByURL .= '&sortBy='.$data['sortBy'];
        }
        
        return redirect()->route('shop',$catURL.$brandURL.$priceRangeURL.$sortByURL);
    }
    
    
    
}
