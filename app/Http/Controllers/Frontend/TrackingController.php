<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class TrackingController extends Controller
{
    public function orderTrack(Request $request) {
        $order = Order::with('division', 'district', 'state', 'user')->where('invoice_no', $request->invoice_no)->first();
        if($order){
            $orderItems = OrderItem::with('product')->where('order_id', $order->id)->get();
            return view('frontend.order-track', compact('order','orderItems'));
        }else{
          $notification = array(
            'message' => 'Order Not Found !!',
            'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);  
        }
        
    }
}
