<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DateTime;

class ReportController extends Controller
{
    public function index() {
        $order_last_id = Order::latest()->first();
        $order_first_id = Order::oldest('id')->first();
        $date_last = $order_last_id->order_date;
        $date_first = $order_first_id->order_date;
         
        $lastDate = DateTime::createFromFormat("d F Y", $date_last);
        $firstDate = DateTime::createFromFormat("d F Y", $date_first);

        $formatLastDate =  $lastDate->format('Y-m-d');
        $formatFirstDate =  $firstDate->format('Y-m-d');
                    
        return view('admin.report.index', compact('formatLastDate', 'formatFirstDate'));
    }
    
    //Report By Date
    public function reportByDate(Request $request) {
        $request->validate([
            'date' => 'required',
            ], [
            'date.required' => 'Date is required',
        ]);     
        
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        $orders = Order::where('order_date', $formatDate)->get();
        if( Order::where('order_date', $formatDate)->first() ){
        return view('admin.report.reports', compact('orders', 'formatDate'));
        }else{
            $notification = array(
            'message' => 'No data found on this Date !!',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
        }
    }
    
    
    //Report By Month
    public function reportByMonth(Request $request) {
        $request->validate([
            'month_name' => 'required',
            'year_name' => 'required',
            ], [
            'month_name.required' => 'Month is required',
            'year_name.required' => 'Year is required',
        ]);
        
        $formatDate = '';
        $month_name = $request->month_name;
        $year_name = $request->year_name;
        $orders = Order::where('order_month', $month_name)->where('order_year', $year_name)->get();
        
        if( Order::where('order_month', $month_name)->where('order_year', $year_name)->first() ){
            return view('admin.report.reports', compact('orders', 'month_name', 'year_name', 'formatDate'));
        }else{
            $notification = array(
            'message' => 'No data found on this Month !!',
            'alert-type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }
    
    
    //Report By Year
    public function reportByYear(Request $request) {
        $request->validate([
            'year_name2' => 'required',
            ], [
            'year_name2.required' => 'Year is required',
        ]);
        
        $formatDate = '';
        $month_name = '';
        $year_name = $request->year_name2;
        $orders = Order::where('order_year', $year_name)->get();
        if( Order::where('order_year', $year_name)->first() ){
            return view('admin.report.reports', compact('orders', 'month_name', 'year_name', 'formatDate'));
        }else{
            $notification = array(
            'message' => 'No data found on this Year !!',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
        }
        
    }
    
    
    
}
