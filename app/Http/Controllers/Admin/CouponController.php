<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;


class CouponController extends Controller
{
//==================================== Show Coupon Page =============================================//     
    public function index(){
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('admin.coupon.index', compact('coupons'));
    }
 
//==================================== Create New Coupon =============================================//    
    public function createCoupon(Request $request){
        $request->validate([
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
                ], [
            'coupon_name.required' => 'Coupon Name is Required',
            'coupon_code.required' => 'Coupon Code is Required',
            'coupon_discount.required' => 'Coupon Discount is Required',
            'coupon_validity.required' => 'Coupon Validity is Required',
        ]);    
    
        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'coupon_code' => strtoupper($request->coupon_code),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Coupon Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    
//==================================== Edit Coupon Page =============================================//     
    public function editCoupon($coupon_id){
        $coupon = Coupon::findOrFail($coupon_id);
        return view('admin.coupon.edit', compact('coupon'));
    }    
    
    
//==================================== Update Coupon Page =============================================//     
    public function updateCoupon(Request $request){
        $coupon_id = $request->coupon_id;
        
        $request->validate([
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
                ], [
            'coupon_name.required' => 'Coupon Name is Required',
            'coupon_code.required' => 'Coupon Code is Required',
            'coupon_discount.required' => 'Coupon Discount is Required',
            'coupon_validity.required' => 'Coupon Validity is Required',
        ]);    
    
        Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => $request->coupon_name,
            'coupon_code' => strtoupper($request->coupon_code),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Coupon Updated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('coupons')->with($notification);
    }    
    
//==================================== Delete Coupon =============================================//     
    public function deleteCoupon($id){
        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Coupon Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    
    
    
}
