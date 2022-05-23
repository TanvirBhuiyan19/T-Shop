<?php


use App\Models\Product;
 
 class Helper{
 
    public static function minPrice(){
        return floor(Product::where('status',1)->min('selling_price'));
    }
 
    public static function maxPrice(){
        return ceil(Product::where('status',1)->max('selling_price'));
    }
 
 }

