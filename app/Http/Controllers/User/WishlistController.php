<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Wishlist;
use App\Models\User;

class WishlistController extends Controller {

    public function addToWishlist($product_id) {
        if (Auth::check()) {
            
            $data = User::findOrFail(Auth::id());
            if($data->role_id == 2){
            
                
                $product_exist = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();
                if (!$product_exist) {
                    Wishlist::insert([
                        'user_id' => Auth::id(),
                        'product_id' => $product_id,
                        'created_at' => Carbon::now(),
                    ]);

                    if (session()->get('language') == 'bangla') {
                        return response()->json(['success' => 'পণ্যটি সফলভাবে ইচ্ছেতালিকায় যুক্ত হয়েছে!']);
                    } else {
                        return response()->json(['success' => 'Product Added to Wishlist Successfully!']);
                    }
                    
                } else {
                    if (session()->get('language') == 'bangla') {
                        return response()->json(['error' => 'পণ্যটি আগেই আপনার ইচ্ছেতালিকায় যুক্ত করা আছে!']);
                    } else {
                        return response()->json(['error' => 'Product Already Added in Your Wishlist!']);
                    }
                }
                
                
            }else {
                if (session()->get('language') == 'bangla') {
                    return response()->json(['error' => 'এডমিন ইচ্ছেতালিকায় কোন পণ্য রাখতে পারবে না!']);
                } else {
                    return response()->json(['error' => 'Admin can not add Product in Wishlist! ']);
                }
            }
            
            
        } else {
            if (session()->get('language') == 'bangla') {
                return response()->json(['error' => 'আপনাকে প্রথমে লগিন করতে হবে।']);
            } else {
                return response()->json(['error' => 'You Need to Login First!']);
            }            
        }
    }
    
    //Show Wishlist Page
    public function showWishlistPage(){
        return view('user.wishlist-page');
    }
    
    //Wishlists View By Ajax
    public function wishlistsViewAjax(){
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        return response()->json($wishlists);
    }
    
    
    //Wishlists Product Remove
    public function destroy($id){
        $wishlists = Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        
        if (session()->get('language') == 'bangla') {
                return response()->json(['success' => 'ইচ্ছেতালিকা থেকে পণ্য সরানো হয়েছে!']);
            } else {
                return response()->json(['success' => 'Product Remove from Wishlist!']);
            }
            
    }
    

}
