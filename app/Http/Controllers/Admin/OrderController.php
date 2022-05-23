<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use PDF;
use Carbon\Carbon;

class OrderController extends Controller
{
    //Pending Orders
    public function pendingOrders() {
        $orders = Order::where('status','Pending')->orderBy('id','DESC')->get();
        return view('admin.orders.pending', compact('orders') );
    }

    //Confirmed Orders
    public function confirmedOrders() {
        $orders = Order::where('status','Confirmed')->orderBy('id','DESC')->get();
        return view('admin.orders.confirmed', compact('orders') );
    }
    

    //Processing Orders
    public function processingOrders() {
        $orders = Order::where('status','Processing')->orderBy('id','DESC')->get();
        return view('admin.orders.processing', compact('orders') );
    }
    

    //Picked Orders
    public function pickedOrders() {
        $orders = Order::where('status','Picked')->orderBy('id','DESC')->get();
        return view('admin.orders.picked', compact('orders') );
    }

    //Shipped Orders
    public function shippedOrders() {
        $orders = Order::where('status','Shipped')->orderBy('id','DESC')->get();
        return view('admin.orders.shipped', compact('orders') );
    }

    //Delivered Orders
    public function deliveredOrders() {
        $orders = Order::where('status','Delivered')->orderBy('id','DESC')->get();
        return view('admin.orders.delivered', compact('orders') );
    }

    //Cancel Orders
    public function cancelOrders() {
        $orders = Order::where('status','Cancel')->orderBy('id','DESC')->get();
        return view('admin.orders.cancel', compact('orders') );
    }
    
    //Order View
    public function viewOrder($id) {
         $order = Order::with('division', 'district', 'state', 'user')->where('id', $id)->first();
        $orderItems = OrderItem::with('product')->where('order_id', $id)->get();
        return view('admin.orders.view-order', compact('order','orderItems'));
    }
    
    //Order Confirm
    public function confirmOrder($id) {
        $order = Order::findOrFail($id);
        if($order->status == 'Pending'){
            Order::where('id', $id)->update([ 
                'status' => 'Confirmed', 
                'confirmed_date' => Carbon::now()->format('d F Y'), 
                ]);
            $notification = array(
               'message' => 'Order Status set to Confirmed Successfully !!',
               'alert-type' => 'success'
            );
            return Redirect()->route('pending-orders')->with($notification);
        }else{
            $notification = array(
            'message' => 'You can not perform this action !!',
            'alert-type' => 'warning'
            );
            return Redirect()->route('admin.dashboard')->with($notification);
        }
         
    }
    
    
    //Order Processing
    public function processingOrder($id) {
        $order = Order::findOrFail($id);
        if($order->status == 'Confirmed'){
            Order::where('id', $id)->update([ 
                'status' => 'Processing', 
                'processing_date' => Carbon::now()->format('d F Y'),  
                ]);
            $notification = array(
               'message' => 'Order Status set to Processing Successfully !!',
               'alert-type' => 'success'
            );
            return Redirect()->route('confirmed-orders')->with($notification);
        }else{
            $notification = array(
            'message' => 'You can not perform this action !!',
            'alert-type' => 'warning'
            );
            return Redirect()->route('admin.dashboard')->with($notification);
        }
         
    }
    
    
    //Order Picked
    public function pickedOrder($id) {
        $order = Order::findOrFail($id);
        if($order->status == 'Processing'){
            Order::where('id', $id)->update([ 
                'status' => 'Picked', 
                'picked_date' => Carbon::now()->format('d F Y'), 
                ]);
            $notification = array(
               'message' => 'Order Status set to Picked Successfully !!',
               'alert-type' => 'success'
            );
            return Redirect()->route('processing-orders')->with($notification);
        }else{
            $notification = array(
            'message' => 'You can not perform this action !!',
            'alert-type' => 'warning'
            );
            return Redirect()->route('admin.dashboard')->with($notification);
        }
         
    }
    
    
    //Order Shipped
    public function shippedOrder($id) {
        $order = Order::findOrFail($id);
        if($order->status == 'Picked'){
            Order::where('id', $id)->update([ 
                'status' => 'Shipped', 
                'shipped_date' => Carbon::now()->format('d F Y'),
                ]);
            $notification = array(
               'message' => 'Order Status set to Shipped Successfully !!',
               'alert-type' => 'success'
            );
            return Redirect()->route('picked-orders')->with($notification);
        }else{
            $notification = array(
            'message' => 'You can not perform this action !!',
            'alert-type' => 'warning'
            );
            return Redirect()->route('admin.dashboard')->with($notification);
        }
         
    }
    
    
    //Order Delivered
    public function deliveredOrder($id) {
        $order = Order::findOrFail($id);
        if($order->status == 'Shipped'){
            Order::where('id', $id)->update([ 
                'status' => 'Delivered', 
                'delivered_date' => Carbon::now()->format('d F Y'),
                ]);
            $notification = array(
               'message' => 'Order Status set to Delivered Successfully !!',
               'alert-type' => 'success'
            );
            return Redirect()->route('shipped-orders')->with($notification);
        }else{
            $notification = array(
            'message' => 'You can not perform this action !!',
            'alert-type' => 'warning'
            );
            return Redirect()->route('admin.dashboard')->with($notification);
        }
         
    }
    
    
    
    //Order Cancel
    public function cancelOrder($id) {
        $order = Order::findOrFail($id);
        $orderItem = OrderItem::where('order_id',$id)->get();
        if($order->status == 'Pending'){
            Order::where('id', $id)->update([ 
                'status' => 'Cancel', 
                'cancel_date' => Carbon::now()->format('d F Y'),
                ]);
            
            //product stock increment
             foreach($orderItem as $pro){
                 Product::where('id',$pro->product_id)->increment('product_qty',$pro->qty);
            } 
            
            $notification = array(
               'message' => 'Order Status set to Cancel Successfully !!',
               'alert-type' => 'success'
            );
            return Redirect()->route('pending-orders')->with($notification);
        }else{
            $notification = array(
            'message' => 'You can not perform this action !!',
            'alert-type' => 'warning'
            );
            return Redirect()->route('admin.dashboard')->with($notification);
        }
         
    }
    
    
    
    //Order Delete
    public function deleteOrder($id) {
        $order = Order::findOrFail($id);
        if($order->status == 'Cancel'){
            Order::where('id', $id)->delete();
            $notification = array(
               'message' => 'Order Deleted Successfully !!',
               'alert-type' => 'success'
            );
            return Redirect()->route('cancel-orders')->with($notification);
        }else{
            $notification = array(
            'message' => 'You can not perform this action !!',
            'alert-type' => 'warning'
            );
            return Redirect()->route('admin.dashboard')->with($notification);
        }
         
    }
    
    
    
//===================== Download Order Invoice ================================  //      
    public function invoiceDownload($id) {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $id)->first();
        $orderItems = OrderItem::with('product')->where('order_id', $id)->get();
        
        $pdf = PDF::setPaper('landscape')->loadView('admin.orders.invoice', compact('order','orderItems'));
        return $pdf->download($order->invoice_no.'.pdf');
    }
    
   
    
    
}
