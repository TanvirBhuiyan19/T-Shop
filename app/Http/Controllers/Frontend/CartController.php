<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Gloudemans\Shoppingcart\Contracts\Calculator;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CartController extends Controller {

// ============================= Bangla Price Function ================================================//
     public function bn_price($data) {
            $en = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
            $bn = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
            $result = str_replace($en, $bn, $data);
            return $result;
        }
        
// ============================= Add To Cart ================================================//
    public function addToCart(Request $request, $id) {

            $product = Product::findOrFail($id);
            if($product->product_qty == 0){
                    if(session()->get('language')=='bangla'){
                        return response()->json(['error' => 'স্টক শেষ হয়ে গেছে!']);
                    }else{
                        return response()->json(['error' => 'Out of Stock!']);
                    }
            }else{

                    if ($product->discount_price != NULL) {
                        $price = $product->discount_price;
                        $pricebn = $this->bn_price($product->discount_price);
                        $qtybn = $this->bn_price($request->qty);
                    } else {
                        $price = $product->selling_price;
                        $pricebn = $this->bn_price($product->selling_price);
                        $qtybn = $this->bn_price($request->qty);
                    }
        
                    $data = Cart::add([
                                'id' => $id,
                                'name' => 'nameeeeee',
                                'qty' => $request->qty,
                                'price' => $price,
                                'weight' => 1,
                                'options' => [
                                    'qtybn' => $qtybn,
                                    'pricebn' => $pricebn,
                                    'slugen' => $product->product_slug_en,
                                    'slugbn' => $product->product_slug_bn,
                                    'nameen' => $product->product_name_en,
                                    'namebn' => $product->product_name_bn,
                                    'thumbnail' => $product->product_thumbnail,
                                    'sizeen' => $request->sizeen,
                                    'sizebn' => $request->sizebn,
                                    'coloren' => $request->coloren,
                                    'colorbn' => $request->colorbn
                                ],
                    ]);
        
                    if(Session::has('coupon')){
                        Session::forget('coupon');
                    }
        
                    if(session()->get('language')=='bangla'){
                        return response()->json(['success' => 'পণ্যটি সফলভাবে কার্টে যুক্ত করা হয়েছে!']);
                    }else{
                        return response()->json(['success' => 'Product added to Cart Successfully!']);
                    }


            }
    
    }


// ============================= Mini Cart Show ================================================//    
    public function miniCart() {
      
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_qtybn = $this->bn_price($cart_qty);
        $cart_total = Cart::priceTotal();
        return response()->json(array(
                    'carts' => $carts,
                    'cart_qty' => $cart_qty,
                    'cart_qtybn' => $cart_qtybn,
                    'cart_total' => $cart_total
        ));
    }

// ============================= Show Cart Page ================================================// 
    public function showCartPage(){
        return view('frontend.cart-page');
    }
    
// ============================= Cart View By Ajax ================================================// 
    public function cartsViewAjax(){
       
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_qtybn = $this->bn_price(Cart::count());
        $cart_total = Cart::priceTotal();
        return response()->json(array(
                    'carts' => $carts,
                    'cart_qty' => $cart_qty,
                    'cart_qtybn' => $cart_qtybn,
                    'cart_total' => $cart_total
        ));
    }
    
    // ============================= Cart Product Remove ================================================//    
    public function destroy($rowId) {
        Cart::remove($rowId);
        
        if(Session::has('coupon')){
        $coupon_code = Session::get('coupon')['coupon_code'];
        $coupon = Coupon::where('coupon_code', $coupon_code)->first();
        Session::put('coupon',[
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => Cart::discount(),
                //'discount_amount' => Cart::total() * $coupon->coupon_discount/100,
                'amount_after_discount' => Cart::total(),
                //'amount_after_discount' => Cart::total() - Cart::total() * $coupon->coupon_discount/100,
                ]);
        }
        
        if(session()->get('language')=='bangla'){
            return response()->json(['success' => 'পণ্যটি কার্ট থেকে সরানো হয়েছে!']);
        }else{
            return response()->json(['success' => 'Product Removed from Cart!']);
        }
        
    }
    
    
    // ============================= Cart Product Increment ================================================//    
    public function cartQtyIncrement($rowId) {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty+1);
        
        if(Session::has('coupon')){
        $coupon_code = Session::get('coupon')['coupon_code'];
        $coupon = Coupon::where('coupon_code', $coupon_code)->first();
        Session::put('coupon',[
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => Cart::discount(),
                //'discount_amount' => Cart::total() * $coupon->coupon_discount/100,
                'amount_after_discount' => Cart::total(),
                //'amount_after_discount' => Cart::total() - Cart::total() * $coupon->coupon_discount/100,
                ]);
        }
        
        if(session()->get('language')=='bangla'){
            return response()->json(['success' => 'পণ্যের পরিমাণ বাড়ানো হয়েছে।']);
        }else{
            return response()->json(['success' => 'Product Quantity Incremented.']);
        }
        
        
    }
    
    
    // ============================= Cart Product Decrement ================================================//    
    public function cartQtyDecrement($rowId) {
        
        $row = Cart::get($rowId);
        if($row->qty > 1){
            Cart::update($rowId, $row->qty-1);
        
            if(Session::has('coupon')){
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('coupon_code', $coupon_code)->first();
            Session::put('coupon',[
                    'coupon_code' => $coupon->coupon_code,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => Cart::discount(),
                    //'discount_amount' => Cart::total() * $coupon->coupon_discount/100,
                    'amount_after_discount' => Cart::total(),
                    //'amount_after_discount' => Cart::total() - Cart::total() * $coupon->coupon_discount/100,
                    ]);
            }
            
            if(session()->get('language')=='bangla'){
                return response()->json(['success' => 'পণ্যের পরিমাণ কমানো হয়েছে।']);
            }else{
                return response()->json(['success' => 'Product Quantity Decremented.']);
            }
        }else{
            if(session()->get('language')=='bangla'){
                return response()->json(['error' => 'পরিমাণ কমানো হয়নি!']);
            }else{
                return response()->json(['error' => 'Quantity Not Decremented.']);
            }
        }
        
    }
    
      
// ============================= Coupon Apply ================================================//     
    public function couponApply(Request $request){
        Session::forget('coupon');
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
        
        if($coupon){
            if(Carbon::now()->format('Y-m-d') <= $coupon->coupon_validity ){
                Cart::setGlobalDiscount($coupon->coupon_discount);
                Session::put('coupon',[
                'coupon_code' => $coupon->coupon_code,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => Cart::discount(),
                //'discount_amount' => Cart::total() * $coupon->coupon_discount/100,
                'amount_after_discount' => Cart::total(),
                //'amount_after_discount' => Cart::total() - Cart::total() * $coupon->coupon_discount/100,
                ]);

                if(session()->get('language')=='bangla'){
                    return response()->json(['success' => 'কুপনটি প্রয়োগ হয়েছে।']);
                }else{
                    return response()->json(['success' => 'Coupon Applied.']);
                }
            }else{
                if(session()->get('language')=='bangla'){
                return response()->json(['error' => 'কুপনের কার্যকারিতা শেষ হয়ে গেছে!']);
                }else{
                    return response()->json(['error' => 'Coupon Validity Expired!']);
                }
            }
            
        }else{
            if(session()->get('language')=='bangla'){
                return response()->json(['error' => 'ভুল কুপন!']);
            }else{
                return response()->json(['error' => 'Invalid Coupon!']);
            }
        }
    }
    
  
    
      
// ============================= Coupon Data Show ================================================//     
    public function couponDataShow(){
        if(Session::has('coupon')){
                return response()->json(array(
                    'coupon_code' => session()->get('coupon')['coupon_code'],
                    'coupon_discount' => session()->get('coupon')['coupon_discount'],
                    'coupon_discountbn' => $this->bn_price( session()->get('coupon')['coupon_discount'] ),
                    'discount_amount' => session()->get('coupon')['discount_amount'],
                    'discount_amountbn' => $this->bn_price( session()->get('coupon')['discount_amount'] ),
                    'amount_after_discount' => session()->get('coupon')['amount_after_discount'],
                    'amount_after_discountbn' => $this->bn_price( session()->get('coupon')['amount_after_discount'] ),
                    'cart_total' => Cart::priceTotal(),
                    'cart_totalbn' => $this->bn_price(Cart::priceTotal())
                ));

            }else{
                return response()->json(array(
                    'cart_total' => Cart::priceTotal(),
                    'cart_totalbn' => $this->bn_price(Cart::priceTotal())
                ));        
            }
            
    }
    
      
// ============================= Coupon Remove ================================================//     
    public function couponRemove(){
        Session::forget('coupon');
        Cart::setGlobalDiscount(0);
        if(session()->get('language')=='bangla'){
                return response()->json(['success' => 'কুপনটি সরানো হয়েছে!']);
            }else{
                return response()->json(['success' => 'Coupon Removed!']);
            }    
    }
    

    
    
}
