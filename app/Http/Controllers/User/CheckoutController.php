<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Division;
use App\Models\District;
use App\Models\State;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\orderMail;
use App\Models\Setting;

class CheckoutController extends Controller
{
  
// ============================= Bangla Price Function ================================================//
     public function bn_price($data) {
            $en = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
            $bn = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
            $result = str_replace($en, $bn, $data);
            return $result;
        }
        
//===================================== Checkout Page Show ================================================  //      
    public function index() {
        if(Cart::priceTotal() > 0){
            $carts = Cart::content();
            $cart_qty = Cart::count();
            $cart_qtybn = $this->bn_price(Cart::count());
            $cart_total = Cart::priceTotal();
            $divisions = Division::orderBy('division_name_en', 'ASC')->get();
            return view('user.checkout.index', compact('carts', 'cart_qty', 'cart_qtybn', 'cart_total', 'divisions'));
        }else{
            $notification=array(
                'message' => 'Shopping First',
                'alert-type' => 'error'
            );
            return Redirect()->to('/')->with($notification);
        }
        
    }
        
//==================================== Get District By Ajax =============================================//       
    public function getDistrict($division_id) {
        $district = District::where('division_id', $division_id)->orderBy('district_name_en', 'ASC')->get();
        return json_encode($district);
    }
    
//==================================== Get District By Ajax =============================================//       
    public function getState($district_id) {
        $state = State::where('district_id', $district_id)->orderBy('state_name_en', 'ASC')->get();
        return json_encode($state);
    }
    
    
    
//==================================== Payment Pages =============================================//       
    public function storeCheckout(Request $request) {
        if(Cart::priceTotal() > 0){
            
            
            $request->validate([
            'shipping_name' => 'required',
            'shipping_email' => 'required',
            'shipping_phone' => 'required | max:11 | min:11',
            'post_code' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'state_id' => 'required',
            'payment_method' => 'required',
                ]);
            
            
            $data = array(); 
            $data['shipping_name'] = $request->shipping_name; 
            $data['shipping_email'] = $request->shipping_email; 
            $data['shipping_phone'] = $request->shipping_phone; 
            $data['post_code'] = $request->post_code; 
            $data['division_id'] = $request->division_id; 
            $data['district_id'] = $request->district_id; 
            $data['state_id'] = $request->state_id; 
            $data['notes'] = $request->notes;
            
            if($request->payment_method == 'stripe'){
                
                if (Session::has('coupon')) {
                    $cartTotal = round( (Session::get('coupon')['amount_after_discount'])/83 ,2);
                }else {
                    $cartTotal = round(Cart::priceTotal()/83 ,2);
                }
                return view('frontend.payment.stripe', compact('data', 'cartTotal'));
                
            }elseif($request->payment_method == 'sslEasyCheckout'){
                if (Session::has('coupon')) {
                    $cartTotal = round( (Session::get('coupon')['amount_after_discount']) ,2);
                    $cartTotal_bn = $this->bn_price(round( (Session::get('coupon')['amount_after_discount']) ,2));
                }else {
                    $cartTotal = round(Cart::priceTotal() ,2);
                    $cartTotal_bn = $this->bn_price(round(Cart::priceTotal() ,2));
                }
               return view('frontend.payment.sslEasyCheckout', compact('data', 'cartTotal', 'cartTotal_bn'));
               
            }elseif($request->payment_method == 'sslHostedCheckout'){
               return view('frontend.payment.sslHostedCheckout', compact('data')); 
               
            }else{
//==================================== Cash on Delivery Store =============================================// 
                if (Session::has('coupon')) {
                    $total_amount = Session::get('coupon')['amount_after_discount'];
                }else {
                    $total_amount = Cart::priceTotal();
                }

                $settings = Setting::where('id', 1)->first();
                if($settings->site_name){
                    $appName =  $settings->site_name;
                }else{
                    $appName = config('app.name');
                }
                 
                if (Session::has('coupon')) {
                    $coupon_code = Session::get('coupon')['coupon_code'];
                    $coupon_discount = Session::get('coupon')['coupon_discount'];
                    $discount_amount = Session::get('coupon')['discount_amount'];
                    $amount_after_discount = Session::get('coupon')['amount_after_discount'];
                }else{
                    $coupon_code = NULL;
                    $coupon_discount = NULL;
                    $discount_amount = NULL;
                }

                 $order_id = Order::insertGetId([
                        'user_id' => Auth::id(),
                        'division_id' => $request->division_id,
                        'district_id' => $request->district_id,
                        'state_id' => $request->state_id,
                        'name' => $request->shipping_name,
                        'email' => $request->shipping_email,
                        'phone' => $request->shipping_phone,
                        'post_code' => $request->post_code,
                        'notes' => $request->notes,
                        
                        'coupon_code' => $coupon_code,
                        'coupon_discount' => $coupon_discount,
                        'discount_amount' => $discount_amount,

                        'payment_type' => 'Cash on Delivery',
                        'payment_method' => 'Cash on Delivery',
                        'transaction_id' => uniqid(),
                        'currency' => 'BDT',
                        'status' => 'Pending',
                        'amount' => $total_amount,
                        'order_number' => rand(10000000,99999999),
                        'invoice_no' => $appName.'_'.mt_rand(10000000,99999999),
                        'order_date' => Carbon::now()->format('d F Y'),
                        'order_month' => Carbon::now()->format('F'),
                        'order_year' => Carbon::now()->format('Y'),
                        'created_at' => Carbon::now(),
                    ]);


                 //Order Item Table data insert
                 $carts = Cart::content();
                 foreach ($carts as $cart ) {
                     if($cart->options->sizebn == null){
                        $size =  $cart->options->sizeen;
                     }else{
                        $size =  $cart->options->sizebn; 
                     }
                     if($cart->options->colorbn == null){
                        $color =  $cart->options->coloren;
                     }else{
                        $color =  $cart->options->colorbn; 
                     }
                     OrderItem::insert([
                         'order_id' => $order_id,
                         'product_id' => $cart->id,
                         'color' => $color,
                         'size' => $size,
                         'qty' => $cart->qty,
                         'price' => $cart->price,
                         'created_at' => Carbon::now(),
                     ]);
                 }
                 
                
                //======== Start Order Mail ========================================//
                $order = Order::where('id', $order_id)->first();
                $data = [
                    'user_name' => Auth::user()->name,
                    'appName' => $appName,
                    'appURL' => config('app.url'),
                    'phone' => $order->phone,
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'invoice_no' => $order->invoice_no,
                    'order_date' => $order->order_date,
                    'order_year' => $order->order_year,
                    'coupon_code' => $order->coupon_code,
                    'coupon_discount' => $order->coupon_discount,
                    'discount_amount' => $order->discount_amount,
                    'total_amount' => $total_amount,
                    'payment_method' => "Cash on Delivery",
                    'status' => $order->status,
                    ];
                Mail::to($order->email)->send(new orderMail($data));
                //======== End: Order Mail ==========================================//
        

                 //product stock decrement
                 foreach($carts as $pro){
                     Product::where('id',$pro->id)->decrement('product_qty',$pro->qty);
                 }

                 if (Session::has('coupon')) {
                     Session::forget('coupon');
                 }

                 Cart::destroy();

                 $notification=array(
                     'message'=>'Order Placed Successfully!',
                     'alert-type'=>'success'
                 );
                 return Redirect()->route('user.dashboard')->with($notification);
//==================================== END: Cash on Delivery Store =============================================//         
            }
        
        
        
        
        }
        
    }
    
    
    
//==================================== Stripe Payment Store =============================================//       
    public function stripePayment(Request $request) {
        if (Session::has('coupon')) {
           $total_amount = Session::get('coupon')['amount_after_discount'];
       }else {
           $total_amount = Cart::priceTotal();
       }
        
        $STRIPE_SECRET_KEY = config('app.STRIPE_SECRET_KEY');
        
        $settings = Setting::where('id', 1)->first();
        if($settings->site_name){
            $appName =  $settings->site_name;
        }else{
            $appName = config('app.name');
        }

        \Stripe\Stripe::setApiKey($STRIPE_SECRET_KEY);
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
          'amount' => round(($total_amount*100)/83),
          'currency' => 'usd',
          'description' => 'Payment from'.' '.$appName,
          'source' => $token,
          'metadata' => ['order_id' => rand(10000000,99999999) ],
        ]);
        
        $payment_method = "Stripe(". $charge->payment_method_details->card->brand .' '.$charge->payment_method_details->type .")";
        
        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon_discount = Session::get('coupon')['coupon_discount'];
            $discount_amount = Session::get('coupon')['discount_amount'];
        }else{
            $coupon_code = NULL;
            $coupon_discount = NULL;
            $discount_amount = NULL;
        }
        
        $order_id = Order::insertGetId([
               'user_id' => Auth::id(),
               'division_id' => $request->division_id,
               'district_id' => $request->district_id,
               'state_id' => $request->state_id,
               'name' => $request->name,
               'email' => $request->email,
               'phone' => $request->phone,
               'post_code' => $request->post_code,
               'notes' => $request->notes,
                
                'coupon_code' => $coupon_code,
                'coupon_discount' => $coupon_discount,
                'discount_amount' => $discount_amount,

               'payment_type' => 'Stripe',
               'payment_method' => $payment_method,
               'transaction_id' => $charge->balance_transaction,
               'currency' => $charge->currency,
               'amount' => $total_amount,
                'status' => 'Pending',
               'order_number' => $charge->metadata->order_id,
               'invoice_no' => $appName.'_'.mt_rand(10000000,99999999),
               'order_date' => Carbon::now()->format('d F Y'),
               'order_month' => Carbon::now()->format('F'),
               'order_year' => Carbon::now()->format('Y'),
               'created_at' => Carbon::now(),
           ]);
        
        
        //Order Item Table data insert
        $carts = Cart::content();
        foreach ($carts as $cart ) {
            if($cart->options->sizebn == null){
               $size =  $cart->options->sizeen;
            }else{
               $size =  $cart->options->sizebn; 
            }
            if($cart->options->colorbn == null){
               $color =  $cart->options->coloren;
            }else{
               $color =  $cart->options->colorbn; 
            }
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $color,
                'size' => $size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }
        
        
        //======== Start Order Mail ========================================//
        $order = Order::where('id', $order_id)->first();
        $data = [
            'user_name' => Auth::user()->name,
            'appName' => $appName,
            'appURL' => config('app.url'),
            'phone' => $order->phone,
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'invoice_no' => $order->invoice_no,
            'order_date' => $order->order_date,
            'order_year' => $order->order_year,
            'coupon_code' => $order->coupon_code,
            'coupon_discount' => $order->coupon_discount,
            'discount_amount' => $order->discount_amount,
            'total_amount' => $total_amount,
            'payment_method' => "Stripe",
            'status' => $order->status,
            ];
        Mail::to($order->email)->send(new orderMail($data));
        //======== End: Order Mail ==========================================//
        
     
        //product stock decrement
        foreach($carts as $pro){
            Product::where('id',$pro->id)->decrement('product_qty',$pro->qty);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification=array(
            'message'=>'Order Placed Successfully!',
            'alert-type'=>'success'
        );
        return Redirect()->route('user.dashboard')->with($notification);

    } 
    
    
    
 
    
}
