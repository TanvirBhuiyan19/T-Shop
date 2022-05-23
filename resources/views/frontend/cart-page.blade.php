@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if(session()->get('language') == 'bangla') আমার কার্ট @else My Cart @endif 
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection


@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'bangla')
                <li><a href="{{ url('/') }}">হোম</a></li>
                <li class='active'>কার্ট</li>
                @else
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Cart</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table " style="border-bottom: 2px solid #DDDDDD">
                    <div class="table-responsive">
                        <table class="table" style="min-height: 400px">
                            <thead>
                                <tr>

                                    <th class="col-md-1">@if(session()->get('language')=='bangla') ছবি @else Image @endif</th>
                                    <th class="col-md-4">@if(session()->get('language')=='bangla') পণ্যের নাম @else Product Name @endif</th>
                                    <th class="col-md-1">@if(session()->get('language')=='bangla') রঙ @else Color @endif</th>
                                    <th class="col-md-1">@if(session()->get('language')=='bangla') সাইজ @else Size @endif</th>
                                    <th class="col-md-1">@if(session()->get('language')=='bangla') দাম @else Price @endif</th>
                                    <th class="col-md-2">@if(session()->get('language')=='bangla') পরিমাণ @else Quantity @endif</th>
                                    <th class="col-md-1">@if(session()->get('language')=='bangla') উপমোট @else Subtotal @endif</th>
                                    <th class="col-md-1">@if(session()->get('language')=='bangla') অপসারণ @else Remove @endif</th>
                                </tr>
                            </thead><!-- /thead -->
                            
                            <tbody id="allCarts">

                            </tbody>
                        </table><!-- /table -->
                    </div>
                </div><!-- /.shopping-cart-table -->	
                
                <div class="col-md-3 col-sm-12 estimate-ship-tax">
                    <a href="{{ url('/shop') }}" class="btn btn-upper btn-primary outer-left-xs"><i class="icon fa fa-arrow-left"></i> 
                        @if(session()->get('language')=='bangla') কেনাকাটা চালিয়ে যান @else Continue Shopping @endif</a>
                </div>


                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                  
                    <table class="table table-striped" id="couponArea">
                        <thead>
                            <tr>
                                <th style="padding: 5px !important; background-color: #F8F8F8;">
                                    <span class="estimate-title">@if(session()->get('language')=='bangla') মূল্যহ্রাসের কোড @else Discount Code @endif</span>
                                    <p>@if(session()->get('language')=='bangla') আপনার যদি কুপন কোড থাকে তাহলে লিখুন.. @else Enter your coupon code if you have one.. @endif</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control unicase-form-control text-input" id="coupon_code"
                                               placeholder="@if(session()->get('language')=='bangla') আপনার কুপন.. @else Your Coupon.. @endif" >
                                    </div>
                                    <div class="clearfix pull-right" style="margin-bottom: -8px">
                                        <button type="submit" class="btn-upper btn btn-primary" onclick="applyCoupon()" >
                                            @if(session()->get('language')=='bangla') কুপন প্রয়োগ করুন @else APPLY COUPON @endif
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                    
                </div><!-- /.estimate-ship-tax -->

                <div class="col-md-5 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead id="couponDataShow">

                            
                        </thead><!-- /thead -->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="cart-checkout-btn pull-right">
                                        <a href="{{route('checkout')}}" class="btn btn-primary checkout-btn" >@if(session()->get('language')=='bangla') চেকআউট করুন @else PROCCED TO CHEKOUT @endif
                                        <i class="icon fa fa-arrow-right"></i> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->			
            </div><!-- /.shopping-cart -->
        </div> <!-- /.row -->



        @endsection