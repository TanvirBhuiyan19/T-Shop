<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\orderMail;
use App\Models\Setting;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        
        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
          $post_data['cus_name'] = $request->name;
          $post_data['cus_email'] = $request->email;
          $post_data['cus_add1'] = 'Customer Address';
          $post_data['cus_add2'] = "";
          $post_data['cus_city'] = "";
          $post_data['cus_state'] = "";
          $post_data['cus_postcode'] = $request->post_code;
          $post_data['cus_country'] = "Bangladesh";
          $post_data['cus_phone'] = $request->phone;
          $post_data['cus_fax'] = "";
          //custom
          $post_data['user_id'] = Auth::id();
          $post_data['division_id'] = $request->division_id;
          $post_data['district_id'] = $request->district_id;
          $post_data['state_id'] = $request->state_id;
          $post_data['notes'] = $request->notes;
          $post_data['payment_method'] = "SSL Payment";
          $post_data['payment_type'] = "SSL Payment";
          
          $settings = Setting::where('id', 1)->first();
            if($settings->site_name){
                $appName =  $settings->site_name;
            }else{
                $appName = config('app.name');
            }

          $post_data['invoice_no'] = $appName.'_'.mt_rand(10000000,99999999);
          $post_data['order_number'] = rand(10000000,99999999);

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";
        
        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon_discount = Session::get('coupon')['coupon_discount'];
            $discount_amount = Session::get('coupon')['discount_amount'];
        }else{
            $coupon_code = NULL;
            $coupon_discount = NULL;
            $discount_amount = NULL;
        }

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                  'user_id' => $post_data['user_id'],
                  'name' => $post_data['cus_name'],
                  'email' => $post_data['cus_email'],
                  'phone' => $post_data['cus_phone'],
                  'amount' => $post_data['total_amount'],
                  'status' => 'Pending',
                  'transaction_id' => $post_data['tran_id'],
                  'currency' => $post_data['currency'],
                  'division_id' => $post_data['division_id'],
                  'district_id' => $post_data['district_id'],
                  'state_id' => $post_data['state_id'],
                  'notes' => $post_data['notes'],
                
                'coupon_code' => $coupon_code,
                'coupon_discount' => $coupon_discount,
                'discount_amount' => $discount_amount,

                  'post_code' => $post_data['cus_postcode'],
                  'payment_method' => $post_data['payment_method'],
                  'payment_type' => $post_data['payment_type'],
                  'invoice_no' => $post_data['invoice_no'],
                  'order_number' => $post_data['order_number'],
                  'order_date' => Carbon::now()->format('d F Y'),
                  'order_month' => Carbon::now()->format('F'),
                  'order_year' => Carbon::now()->format('Y'),
                  'created_at' => Carbon::now(),
              ]);

              $order_id = \Illuminate\Support\Facades\DB::getPdo()->lastInsertId();
              
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
                
            # OPTIONAL PARAMETERS
            $post_data['value_a'] = $order_id;
            $post_data['value_b'] = Auth::user()->name;
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";


         $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {
        
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        
        $requestData =(array)json_decode($request->cart_json);
        $post_data = array();
        $post_data['total_amount'] = $requestData['total_amount']; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique
        
        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $requestData['name'];
        $post_data['cus_email'] = $requestData['email'];
        $post_data['cus_add1'] = "Customer Address";
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = $requestData['post_code'];
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $requestData['phone'];
        $post_data['cus_fax'] = "";
        //custom
        $post_data['user_id'] = Auth::id();
        $post_data['division_id'] = $requestData['division_id'];
        $post_data['district_id'] = $requestData['district_id'];
        $post_data['state_id'] = $requestData['state_id'];
        $post_data['notes'] = $requestData['notes'];
        $post_data['payment_method'] = "SSL Payment";
        $post_data['payment_type'] = "SSL Payment";
        
        $settings = Setting::where('id', 1)->first();
        if($settings->site_name){
            $appName =  $settings->site_name;
        }else{
            $appName = config('app.name');
        }

        $post_data['invoice_no'] = $appName.'_'.mt_rand(10000000,99999999);
        $post_data['order_number'] = rand(10000000,99999999);

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";
        
        if (Session::has('coupon')) {
            $coupon_code = Session::get('coupon')['coupon_code'];
            $coupon_discount = Session::get('coupon')['coupon_discount'];
            $discount_amount = Session::get('coupon')['discount_amount'];
        }else{
            $coupon_code = NULL;
            $coupon_discount = NULL;
            $discount_amount = NULL;
        }
        
        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'user_id' => $post_data['user_id'],
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'division_id' => $post_data['division_id'],
                'district_id' => $post_data['district_id'],
                'state_id' => $post_data['state_id'],
                'notes' => $post_data['notes'],
                
                'coupon_code' => $coupon_code,
                'coupon_discount' => $coupon_discount,
                'discount_amount' => $discount_amount,
                
                'post_code' => $post_data['cus_postcode'],
                'payment_method' => $post_data['payment_method'],
                'payment_type' => $post_data['payment_type'],
                'invoice_no' => $post_data['invoice_no'],
                'order_number' => $post_data['order_number'],
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'created_at' => Carbon::now(),
              ]);

              $order_id = \Illuminate\Support\Facades\DB::getPdo()->lastInsertId();
              
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
            
            # OPTIONAL PARAMETERS
            $post_data['value_a'] = $order_id;
            $post_data['value_b'] = Auth::user()->name;
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        
        //echo "Transaction is Successful";
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        'status' => 'Processing', 
                        'payment_method' => $request->card_issuer,
                        'confirmed_date' => Carbon::now()->format('d F Y'),
                        'processing_date' => Carbon::now()->format('d F Y'),
                            ]);
                
                
                //======== Start Order Mail ========================================//
                $order = Order::where('id', $request->value_a)->first();
                
                $settings = Setting::where('id', 1)->first();
                if($settings->site_name){
                    $appName =  $settings->site_name;
                }else{
                    $appName = config('app.name');
                }

                $data = [
                    'user_name' => $request->value_b,
                    'appName' => $appName,
                    'appURL' => config('app.url'),
                    'phone' => $order->phone,
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'invoice_no' => $order->invoice_no,
                    'order_date' => $order->order_date,
                    'order_year' => $order->order_year,
                    'status' => $order->status,
                    'processing_date' => Carbon::now()->format('d F Y'),
                    'coupon_code' => $order->coupon_code,
                    'coupon_discount' => $order->coupon_discount,
                    'discount_amount' => $order->discount_amount,
                    'total_amount' => $amount,
                    'payment_method' => $request->card_issuer,

                    ];
                Mail::to($order->email)->send(new orderMail($data));
                //======== End: Order Mail ==========================================//
        
                
                //product stock decrement
                $carts = Cart::content();
                 foreach($carts as $pro){
                     Product::where('id',$pro->id)->decrement('product_qty',$pro->qty);
                 } 
                 
                if (Session::has('coupon')) {
                    Session::forget('coupon');
                }
                Cart::destroy();
                $notification=array(
                    'message'=>'Order Placed Successfully.',
                    'alert-type'=>'success'
                );
                return Redirect()->route('user.dashboard')->with($notification);
                
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
