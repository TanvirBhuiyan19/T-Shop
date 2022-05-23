<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;

class StockController extends Controller
{
    //View Stock Manage Page
    public function index() {
        $products = Product::latest()->get();
        return view('admin.stock.index', compact('products') );
    }
    
    //Stock Edit
    public function editStock($product_id) {
        $product = Product::findOrFail($product_id);
        return view('admin.stock.edit', compact('product') );
    }
    
    //Stock Update
    public function updateStock(Request $request, $product_id) {
        $request->validate([
            'product_qty' => 'required'
        ],[
            'product_qty.required' => 'The product quantity field is required.'
        ]);
        
        $product = Product::findOrFail($product_id)->update([
            'product_qty' => $request->product_qty,
            'updated_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Stock Updated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('product-stock')->with($notification);
    }
    
    
    
}
