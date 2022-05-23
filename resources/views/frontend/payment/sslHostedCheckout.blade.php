@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title')  
@if(session()->get('language') == 'bangla') এসএসএল হোস্টেড পেমেন্ট @else SSL Hosted Payment @endif 
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection



@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'bangla')
                <li><a href="{{url('/')}}">হোম</a></li>
                <li><a href="{{url('/')}}">চেকআউট</a></li>
                <li class='active'>এসএসএল হোস্টেড</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('checkout')}}">Checkout</a></li>
                <li class='active'>SSL Hosted</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

@php
function bn_price($data) {
            $en = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
            $bn = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
            $result = str_replace($en, $bn, $data);
            return $result;
        }
@endphp

    <div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 col-sm-12">
                    <div class="panel-group checkout-steps" >

                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <br><br>
                                    <div class="row">		
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10 col-sm-12 guest-login">
                                            
                                            <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
                                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                                @if(Session::has('coupon'))
                                                <input type="hidden" value="{{session()->get('coupon')['amount_after_discount'] }}" name="amount" id="total_amount" required/>
                                                @else
                                                <input type="hidden" value="{{Gloudemans\Shoppingcart\Facades\Cart::priceTotal() }}" name="amount" id="total_amount" required/>
                                                @endif
                                                <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                                <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                                <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                                <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                                                <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                                                <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                                                <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                                                <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                                    
                                                <div class="form-row">
                                                    <h3 class="text-center">@if(session()->get('language') == 'bangla') এসএসএল হোস্টেড পেমেন্ট @else SSL Hosted Payment - SSLCommerz @endif</h3>
                                                    
                                                    @if(Session::has('coupon'))
                                                    <div class="row" style="padding-top: 30px; margin-top: 20px; border-top: 2px solid #DDDDDD;">
                                                        <strong class="col-md-6 text-right">@if(session()->get('language')=='bangla') উপ-মোট @else Subtotal @endif</strong>
                                                        <strong class="col-md-6 text-left">@if(session()->get('language')=='bangla') ৳{{ bn_price( Gloudemans\Shoppingcart\Facades\Cart::priceTotal() ) }} @else ৳{{ Gloudemans\Shoppingcart\Facades\Cart::priceTotal() }} @endif</strong>
                                                    </div>
                                                    <div class="row">
                                                        <strong class="col-md-6 text-right">@if(session()->get('language')=='bangla') কুপন কোড @else Coupon Code @endif</strong>
                                                        <strong class="col-md-6 text-left">{{session()->get('coupon')['coupon_code']}}
                                                            (@if(session()->get('language')=='bangla'){{ bn_price(session()->get('coupon')['coupon_discount']) }}@else{{ session()->get('coupon')['coupon_discount'] }}@endif%) </strong>
                                                    </div>
                                                    <div class="row">
                                                        <strong class="col-md-6 text-right">@if(session()->get('language')=='bangla') হ্রাসকৃত মুল্য @else Discount Amount @endif</strong>
                                                        <strong class="col-md-6 text-left"> @if(session()->get('language')=='bangla') ৳{{ bn_price(session()->get('coupon')['discount_amount']) }} @else ৳{{ session()->get('coupon')['discount_amount'] }} @endif </strong>
                                                    </div>
                                                    <div class="row" style="padding-bottom: 30px; margin-bottom: 20px; border-bottom: 2px solid #DDDDDD;">
                                                        <strong class="col-md-6 text-right" style="color: #23bf08">@if(session()->get('language')=='bangla') সর্বমোট @else Grand Total @endif</strong>
                                                        <strong class="col-md-6 text-left" style="color: #23bf08"> @if(session()->get('language')=='bangla') ৳{{bn_price(session()->get('coupon')['amount_after_discount']) }} @else ৳{{session()->get('coupon')['amount_after_discount']}} @endif </strong>
                                                    </div>

                                                    @else
                                                    <div class="row" style="padding-top: 50px; padding-bottom: 50px; margin-top: 20px; margin-bottom: 20px; border-top: 2px solid #DDDDDD; border-bottom: 2px solid #DDDDDD;">
                                                        <strong class="col-md-6 text-right" style="color: #23bf08">@if(session()->get('language')=='bangla') সর্বমোট @else Grand Total @endif</strong>
                                                        <strong class="col-md-6 text-left" style="color: #23bf08">@if(session()->get('language')=='bangla') ৳{{ bn_price( Gloudemans\Shoppingcart\Facades\Cart::priceTotal() ) }} @else ৳{{ Gloudemans\Shoppingcart\Facades\Cart::priceTotal() }} @endif</strong>
                                                    </div>
                                                    @endif
                                                    
                                                </div>
                                                <br>
                                                @if(Session::has('coupon'))
                                                <button class="btn btn-primary center-block"><strong> @if(session()->get('language')=='bangla') পরিশোধ করুন {{ bn_price(session()->get('coupon')['amount_after_discount']) }} টাকা @else  Pay {{ session()->get('coupon')['amount_after_discount'] }} Taka @endif </strong></button>
                                                @else
                                                <button class="btn btn-primary center-block"><strong> @if(session()->get('language')=='bangla') পরিশোধ করুন {{ bn_price( Gloudemans\Shoppingcart\Facades\Cart::priceTotal() ) }} টাকা @else  Pay {{Gloudemans\Shoppingcart\Facades\Cart::priceTotal() }} Taka @endif </strong></button>
                                                @endif
                                            </form>   
                                            
                                        </div>
                                        <div class="col-md-1"></div>		
                                    </div>
                                    <br><br>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div><!-- checkout-step-01  -->


                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-2"></div>

            </div><!-- /.row -->
        </div><!-- /.checkout-box -->




        @endsection