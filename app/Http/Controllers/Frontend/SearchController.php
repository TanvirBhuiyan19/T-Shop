<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller {

    public function searchProduct(Request $request){
        $request->validate([
            'search' => 'required',
        ]);
        
        $search = $request->search;
        $sort = '';
        if ($request->sortBy != null) {
             $sort = $request->sortBy;
        }

        if($sort == 'priceLowesttoHighest'){
            $products = Product::where('status', 1)
                        ->where('product_name_en', 'LIKE', '%'.$search.'%') 
                        ->orWhere('product_name_bn', 'LIKE', '%'.$search.'%')
                        ->orWhere('product_tag_en', 'LIKE', '%'.$search.'%')
                        ->orWhere('product_tag_bn', 'LIKE', '%'.$search.'%')
                        ->orWhere('short_descp_en', 'LIKE', '%'.$search.'%')
                        ->orWhere('short_descp_bn', 'LIKE', '%'.$search.'%')
                        ->orderBy('selling_price','ASC')->paginate(12);
        }elseif($sort == 'priceHighesttoLowest'){
            $products = Product::where('status', 1)
                        ->where('product_name_en', 'LIKE', '%'.$search.'%') 
                        ->orWhere('product_name_bn', 'LIKE', '%'.$search.'%')
                        ->orWhere('product_tag_en', 'LIKE', '%'.$search.'%')
                        ->orWhere('product_tag_bn', 'LIKE', '%'.$search.'%')
                        ->orWhere('short_descp_en', 'LIKE', '%'.$search.'%')
                        ->orWhere('short_descp_bn', 'LIKE', '%'.$search.'%')
                        ->orderBy('selling_price','DESC')->paginate(12);
        }elseif($sort == 'nameAtoZ'){
            $products = Product::where('status', 1)
                        ->where('product_name_en', 'LIKE', '%'.$search.'%') 
                        ->orWhere('product_name_bn', 'LIKE', '%'.$search.'%')
                        ->orWhere('product_tag_en', 'LIKE', '%'.$search.'%')
                        ->orWhere('product_tag_bn', 'LIKE', '%'.$search.'%')
                        ->orWhere('short_descp_en', 'LIKE', '%'.$search.'%')
                        ->orWhere('short_descp_bn', 'LIKE', '%'.$search.'%')
                ->orderBy('product_name_en','ASC')->paginate(12);
        }elseif($sort == 'nameZtoA'){
            $products = Product::where('status', 1)
                        ->where('product_name_en', 'LIKE', '%'.$search.'%') 
                        ->orWhere('product_name_bn', 'LIKE', '%'.$search.'%')
                        ->orWhere('product_tag_en', 'LIKE', '%'.$search.'%')
                        ->orWhere('product_tag_bn', 'LIKE', '%'.$search.'%')
                        ->orWhere('short_descp_en', 'LIKE', '%'.$search.'%')
                        ->orWhere('short_descp_bn', 'LIKE', '%'.$search.'%')
                        ->orderBy('product_name_en','DESC')->paginate(12);
        }else{
            $products = Product::where('status', 1)
                        ->where('product_name_en', 'LIKE', '%'.$search.'%') 
                        ->orWhere('product_name_bn', 'LIKE', '%'.$search.'%')
                        ->orWhere('product_tag_en', 'LIKE', '%'.$search.'%')
                        ->orWhere('product_tag_bn', 'LIKE', '%'.$search.'%')
                        ->orWhere('short_descp_en', 'LIKE', '%'.$search.'%')
                        ->orWhere('short_descp_bn', 'LIKE', '%'.$search.'%')
                        ->orderBy('id','DESC')->paginate(12);
        }

        $route = 'search-products?search='.$search;
        return view('frontend.search-result', compact('products', 'search', 'sort', 'route'));
    
    }
    


    //findProducts with ajax
    public function searchProductsAjax(Request $request){
        $request->validate([
            'search' => 'required'
        ]);

        $search = $request->search;
        $products = Product::where('status', 1)
                            ->where('product_name_en', 'LIKE', '%'.$search.'%') 
                            ->orWhere('product_name_bn', 'LIKE', '%'.$search.'%')
                            ->orWhere('product_tag_en', 'LIKE', '%'.$search.'%')
                            ->orWhere('product_tag_bn', 'LIKE', '%'.$search.'%')
                            ->orWhere('short_descp_en', 'LIKE', '%'.$search.'%')
                            ->orWhere('short_descp_bn', 'LIKE', '%'.$search.'%')
                            ->take(6)->get();
                return view('frontend.search-products-ajax',compact('products'));
    }
    
    
    
}
