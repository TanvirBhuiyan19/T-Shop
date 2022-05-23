<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductReview;
use PDF;
use Carbon\Carbon;

class UserController extends Controller {

    public function index() {
        $orders = Order::where('user_id', Auth::user()->id )->latest()->get();
        $return_orders = Order::where('user_id', Auth::user()->id )->where('return_reason', '!=', NULL )->latest()->get();
        $reviews = ProductReview::with('product')->where('user_id', Auth::user()->id )->latest()->get();
        return view('user.home', compact('return_orders', 'orders', 'reviews'));
    }
  
//===================== Change Information ================================  //   
    public function userInfoChange(Request $request){
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $gender = $request->gender;
        $dob = $request->dob;
        User::findOrFail(Auth::id())->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'dob' => $dob
            ]);
        $notification = array(
                    'message' => 'Profile Information Update Succesfully !!',
                    'alert-type' => 'success'
                );
        return Redirect()->route('user.dashboard')->with($notification);
    }    
    
    
//===================== Change Image ================================  //     
    public function imageChange(Request $request) {
        $image = $request->file('image');
        $oldImage = Auth::user()->image;
        if ($oldImage == 'avatar556589552.jpg') {
            $imageName = hexdec(uniqid()).'-'. hexdec(rand()).'.'.$image->getClientOriginalExtension();
            $directory = 'frontend/assets/images/users/';
            Image::make($image)->resize(150, 150)->save($directory . $imageName);
            User::findOrFail(Auth::id())->update([
                'image' => $imageName
            ]);
            
            $notification = array(
                'message' => 'Profile Picture Change Successfully !!',
                'alert-type' => 'success'
            );
            return Redirect()->route('user.dashboard')->with($notification);
            
        } else {
            $directory = 'frontend/assets/images/users/';
            unlink($directory.$oldImage);
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            
            Image::make($image)->resize(150, 150)->save($directory . $imageName);
            User::findOrFail(Auth::id())->update([
                'image' => $imageName
            ]);
            
            $notification = array(
                'message' => 'Profile Picture Change Successfully !!',
                'alert-type' => 'success'
            );
            return Redirect()->route('user.dashboard')->with($notification);
            
        }
        
    }

//===================== Change Password ================================  //     
    public function passwordChange(Request $request) {
        $request->validate([
            'oldpass' => ['required'],
            'newpass' => ['required', 'string', 'min:8', 'same:newpass_confirm'],
            'newpass_confirm' => ['required', 'string', 'min:8'],
        ]);

        $dbpass = Auth::user()->password;
        $oldpass = $request->oldpass;
        $newpass = $request->newpass;
        $newpass_confirm = $request->newpass_confirm;

        if (Hash::check($oldpass, $dbpass)) {
            if ($newpass === $newpass_confirm) {
                User::findOrFail(Auth::id())->update([
                    'password' => Hash::make($newpass)
                ]);

                Auth::logout();

                $notification = array(
                    'message' => 'Password Changed Successfully !! Now Login With New Password.',
                    'alert-type' => 'success'
                );
                return Redirect()->route('login')->with($notification);
            } else {
                $notification = array(
                    'message' => 'New Password and Confirm Password Not Match !!',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Old Password is Incorrect !!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

//===================== Single Order View ================================  //      
    public function orderView($id) {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $id)->where('user_id', Auth::user()->id )->first();
        $orderItems = OrderItem::with('product')->where('order_id', $id)->get();
        return view('user.order.view-order', compact('order','orderItems'));
    }
    
    

//===================== Download Order Invoice ================================  //      
    public function invoiceDownload($id) {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $id)->where('user_id', Auth::user()->id )->first();
        $orderItems = OrderItem::with('product')->where('order_id', $id)->get();
        //return view( 'user.order.invoice', compact('order','orderItems') );
        
        $pdf = PDF::setPaper('landscape')->loadView('user.order.invoice', compact('order','orderItems'));
        return $pdf->download($order->invoice_no.'.pdf');
    }
    
    
    

//===================== Return Order Request ================================  //      
    public function returnOrder(Request $request) {
        $id = $request->id;
        Order::where('id', $id )->where('user_id', Auth::user()->id )->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
        ]);
        $notification = array(
                'message' => 'Return Order Request Send Successfully!!',
                'alert-type' => 'success'
            );
            return Redirect()->route('user.dashboard')->with($notification);
        
    }
    
//============================== View Review Write Page ==========================================//
    public function createReview($product_id, $order_id) {
        $user_id = Auth::user()->id;
        $conditionOne = Order::where('id', $order_id)->where('user_id', $user_id )->where('status','Delivered')->first();
        $conditionTwo = OrderItem::where('product_id', $product_id)->where('order_id', $order_id )->first();
        $conditionThree = ProductReview::where('product_id', $product_id)->where('user_id', $user_id )->first();
        
        if($conditionOne && $conditionTwo){
                if(!$conditionThree){
                    return view('user.order.review.create', compact('product_id'));
                }else{
                    $notification = array(
                    'message' => 'You already reviewed this product !!',
                    'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }
            
        }else{
                $notification = array(
                'message' => 'You can not perform this action !!',
                'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification); 
        }
        
    }
    
//============================== Store Review in Database ======================================//
    public function storeReview(Request $request) {
        $request->validate([
            'rating' => 'required',
            'comment' => 'required',
        ]);
        $product_id = $request->product_id;
        ProductReview::insert([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'created_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'Review Done !!',
            'alert-type' => 'success'
            );
            return Redirect()->route('user.dashboard')->with($notification);
    }
    
    

}
