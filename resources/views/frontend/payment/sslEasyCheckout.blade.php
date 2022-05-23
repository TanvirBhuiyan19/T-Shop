@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title')  
@if(session()->get('language') == 'bangla') এসএসএল ইজি পেমেন্ট @else EasyCheckout Payment @endif 
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
                <li class='active'>এসএসএল ইজি</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('checkout')}}">Checkout</a></li>
                <li class='active'>SSL Easy</li>
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
                                            
                                            <form method="POST" class="needs-validation" novalidate>
                                                
                                                @if(Session::has('coupon'))
                                                <input type="hidden" value="{{session()->get('coupon')['amount_after_discount'] }}" name="amount" id="total_amount" required/>
                                                @else
                                                <input type="hidden" value="{{Gloudemans\Shoppingcart\Facades\Cart::priceTotal() }}" name="amount" id="total_amount" required/>
                                                @endif
                                                <input type="hidden" name="customer_name" id="customer_name" value="{{ $data['shipping_name'] }}">
                                                <input type="hidden" name="customer_email" id="email" value="{{ $data['shipping_email'] }}">
                                                <input type="hidden" name="customer_mobile" id="mobile" value="{{ $data['shipping_phone'] }}">
                                                <input type="hidden" name="post_code" id="post_code" value="{{ $data['post_code'] }}">
                                                <input type="hidden" name="division_id" id="division_id" value="{{ $data['division_id'] }}">
                                                <input type="hidden" name="district_id" id="district_id" value="{{ $data['district_id'] }}">
                                                <input type="hidden" name="state_id" id="state_id" value="{{ $data['state_id'] }}">
                                                <input type="hidden" name="notes" id="notes" value="{{ $data['notes'] }}">
                                                
                                                <div class="form-row">
                                                    <h3 class="text-center">@if(session()->get('language') == 'bangla') এসএসএল ইজি পেমেন্ট @else SSL Easy Payment - SSLCommerz @endif</h3>
                                                    
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
                                                
                                                <button class="btn btn-primary btn-lg center-block" id="sslczPayBtn"
                                                        token="if you have any token validation"
                                                        postdata="your javascript arrays or objects which requires in backend"
                                                        order="If you already have the transaction generated for current order"
                                                        endpoint="{{ url('/pay-via-ajax') }}">
                                                    <strong> @if(session()->get('language')=='bangla') পরিশোধ করুন {{$cartTotal_bn}} টাকা @else  Pay {{$cartTotal}} Taka @endif </strong>
                                                </button>
                                               
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<!-- If you want to use the popup integration, -->
<script>
    var obj = {};
    obj.name = $('#customer_name').val();
    obj.phone = $('#mobile').val();
    obj.email = $('#email').val();
    obj.total_amount = $('#total_amount').val();
    obj.post_code = $('#post_code').val();
    obj.division_id = $('#division_id').val();
    obj.district_id = $('#district_id').val();
    obj.state_id = $('#state_id').val();
    obj.notes = $('#notes').val();

    $('#sslczPayBtn').prop('postdata', obj);

    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>


@endsection