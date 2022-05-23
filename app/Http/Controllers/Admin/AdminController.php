<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(){

        $today = date('d F Y');
        $thisMonth = date('F');
        $thisYear = date('Y');
        $todaySell = Order::where('order_date', $today)->sum('amount');
        $thisMonthSell = Order::where('order_month', $thisMonth)->where('order_year', $thisYear)->sum('amount');
        $thisYearSell = Order::where('order_year', $thisYear)->sum('amount');
        $allTimeSell = Order::all()->sum('amount');

        $totalProducts = Product::all();
        $totalActiveProducts = Product::where('status', 1)->get();
        $totalOrders = Order::all();
        $totalOrderItems = OrderItem::all()->sum('qty');

        $stockOutProducts = Product::where('product_qty', 0)->where('status', 1)->latest()->get();
        $recentOrders = Order::with('user')->latest()->take(10)->get();

        return view('admin.home', compact('stockOutProducts', 'recentOrders', 'todaySell', 'thisMonthSell', 
                    'thisYearSell', 'allTimeSell', 'totalProducts', 'totalActiveProducts', 'totalOrders', 'totalOrderItems') );
    }
    public function profile(){
        return view('admin.profile');
    }
  
//===================== Change Information ================================  //   
    public function adminInfoChange(Request $request){
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
                'dob' => $dob,
                'updated_at' => Carbon::now(),
            ]);
        $notification = array(
                    'message' => 'Profile Information Update Succesfully !!',
                    'alert-type' => 'success'
                );
        return Redirect()->route('admin.profile')->with($notification);
    }
    
    
//===================== Change Password ================================  //     
    public function adminPassChange(Request $request) {
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
                    'password' => Hash::make($newpass),
                    'updated_at' => Carbon::now(),
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
    
        
//===================== Change Image  ================================  //       
    public function imageChange(Request $request) {
        $image = $request->file('image');
        $oldImage = Auth::user()->image;
        if ($oldImage == 'avatar556589552.jpg') {
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $directory = 'admin/img/admins/';
            Image::make($image)->resize(150, 150)->save($directory . $imageName);
            User::findOrFail(Auth::id())->update([
                'image' => $imageName,
                'updated_at' => Carbon::now(),
            ]);
            
            $notification = array(
                'message' => 'Profile Picture Change Successfully !!',
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.profile')->with($notification);
            
        } else {
            $directory = 'admin/img/admins/';
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
            return Redirect()->route('admin.profile')->with($notification);
            
        }
        
    }
    
    //Show All Users
    public function allUsers() {
        $users = User::where('role_id','=', 2)->latest('id')->get();
        return view('admin.allUser', compact('users'));
    }
    
    
    //User Banned
    public function userBanned($user_id) {
        User::findOrFail($user_id)->update(['isban' => 1]);
        $notification = array(
                'message' => 'User Banned !!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
    }
    
    
    //User Unbanned
    public function userUnbanned($user_id) {
        User::findOrFail($user_id)->update(['isban' => 0]);
        $notification = array(
                'message' => 'User Unbanned Successfully !!',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
    }
    
    
    
    
}
