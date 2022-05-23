@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if(session()->get('language') == 'bangla') চেকআউট @else Checkout @endif 
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection



@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'bangla')
                <li><a href="{{url('/')}}">হোম</a></li>
                <li class='active'>চেকআউট</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>Checkout</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" >
                        
                        <form action="{{route('checkout.store')}}" method="post" >	
                            @csrf
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                        <!-- panel-heading -->
                        <div class="panel-heading">
                            <h4 class="unicase-checkout-title">
                                    <a>
                                      <span>1</span>Shipping Information
                                    </a>
                                 </h4>
                        </div>
                        <!-- panel-heading -->
                            
                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">		
	
                                        <div class="col-md-6 col-sm-6 guest-login">
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Full Name <span style="color: red">*</span></label>
                                                <input type="text" name="shipping_name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Full Name" data-validation="required">
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title">Email <span style="color: red">*</span></label>
                                                    <input type="email" name="shipping_email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Email" data-validation="email" >
                                                </div>                                          
                                                <div class="form-group">
                                                    <label class="info-title">Mobile <span style="color: red">*</span></label>
                                                    <input type="number" name="shipping_phone" class="form-control" value="{{ Auth::user()->phone }}" placeholder="Mobile" data-validation="length" data-validation-length="11" >
                                                </div>                                          
                                                <div class="form-group">
                                                    <label class="info-title">Post Code <span style="color: red">*</span></label>
                                                    <input type="number" name="post_code" class="form-control" placeholder="Post Code" data-validation="required">
                                                </div>                                          
                                        </div>	
                                        
                                        <div class="col-md-6 col-sm-6 guest-login">
                                            <div class="form-group">
                                                <label class="info-title">Division <span style="color: red">*</span></label>
                                                <select name="division_id" class="form-control" data-validation="required">
                                                    <option label="Choose one" disabled selected ></option>
                                                    @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}" class="form-control" >{{ $division->division_name_en }}</option>
                                                    @endforeach
                                                </select>  
                                            </div> 
                                            <div class="form-group">
                                                <label class="info-title">District <span style="color: red">*</span></label>
                                                <select name="district_id" class="form-control" data-validation="required">
                                                    <option label="Choose one" disabled selected ></option>
                                                </select>
                                                @error('district_id')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror 
                                            </div> 
                                            <div class="form-group">
                                                <label class="info-title">State <span style="color: red">*</span></label>
                                                <select name="state_id" class="form-control" data-validation="required">
                                                    <option label="Choose one" disabled selected ></option>
                                                </select>
                                                @error('state_id')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror 
                                            </div>  
                                            <div class="form-group">
                                                <label class="info-title">Note </label><span> (optional)</span>
                                                <textarea class="form-control" name="notes"></textarea>
                                            </div> 
                                                                                     
                                        </div>		
                                        
                                    </div>			
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div><!-- checkout-step-01  -->
                        
                        <!-- checkout-step-02  -->
                        <div class="panel panel-default checkout-step-02">
                            <div class="panel-heading">
                              <h4 class="unicase-checkout-title">
                                <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                                  <span>2</span>Payment Method
                                </a>
                              </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                              <div class="panel-body">
                                  <br>
                                  <ul>
                                      <li>
                                            <input type="radio" name="payment_method" value="stripe" data-validation="required" >
                                            <strong>Stripe</strong>
                                      </li>
                                      <li>
                                            <input type="radio" name="payment_method" value="sslEasyCheckout" checked >
                                            <strong>SSL Easy Checkout</strong>
                                      </li>
                                      <li>
                                            <input type="radio" name="payment_method" value="sslHostedCheckout">
                                            <strong>SSL Hosted Checkout</strong>
                                      </li>
                                      <li>
                                            <input type="radio" name="payment_method" value="hand_cash" >
                                            <strong>Cash on delivery</strong>
                                      </li>
                                  </ul>
                                  <br><br>
                                  <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Next <i class="fa fa-arrow-right"></i></button>  
                              </div>
                            </div>
                        </div>
                        <!-- checkout-step-02  -->
                        
                        </form>
                        
                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Shopping Item's</h4>
                                </div>
                                <div class="" style="max-height: 350px;  overflow-y: visible; overflow-x: hidden;">
                                    @foreach($carts as $data)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset('uploads/product/thumbnail/') }}/{{$data->options->thumbnail}}" alt="photo" style="height: 50px; width: auto !important;">                                            
                                        </div>   
                                        <div class="col-md-10" style="float: right">
                                            <ul class="nav nav-checkout-progress list-unstyled">
                                                <li><strong>{{$data->options->nameen}}</strong></li>
                                        
                                                <li><strong>Price: </strong> ৳{{$data->price}}*{{$data->qty}}
                                                @if($data->options->coloren == null && $data->options->colorbn == null)

                                                @else
                                                    @if($data->options->colorbn == null)
                                                    <strong>Color: </strong> {{$data->options->coloren}}
                                                    @else
                                                    <strong>Color: </strong> {{$data->options->colorbn}}
                                                    @endif
                                                @endif

                                                @if($data->options->sizeen == null && $data->options->sizebn == null)

                                                @else
                                                    @if($data->options->sizebn == null)
                                                    <strong>Size: </strong> {{$data->options->sizeen}}
                                                    @else
                                                    <strong>Size: </strong> {{$data->options->sizebn}}
                                                    @endif
                                                @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr style="padding: 0px; margin: 5px">
                                    @endforeach
                                </div>
                                
                                @if(Session::has('coupon'))
                                <div class="row" style="padding-top: 15px; margin-top: 20px; border-top: 2px solid #DDDDDD;">
                                    <strong class="col-md-7 text-right">Total</strong>
                                    <strong class="col-md-5 text-right">৳{{$cart_total}}</strong>
                                </div>
                                <div class="row">
                                    <strong class="col-md-7 text-right">Coupon Code</strong>
                                    <strong class="col-md-5 text-right">{{session()->get('coupon')['coupon_code']}}({{session()->get('coupon')['coupon_discount']}}%)</strong>
                                </div>
                                <div class="row">
                                    <strong class="col-md-7 text-right">Coupon Discount</strong>
                                    <strong class="col-md-5 text-right">৳{{session()->get('coupon')['discount_amount']}}</strong>
                                </div>
                                <div class="row">
                                    <strong class="col-md-7 text-right" style="color: #23bf08">Grand Total</strong>
                                    <strong class="col-md-5 text-right" style="color: #23bf08">৳{{session()->get('coupon')['amount_after_discount']}}</strong>
                                </div>
                                
                                @else
                                <div class="row" style="padding-top: 15px; margin-top: 20px; border-top: 2px solid #DDDDDD;">
                                    <strong class="col-md-7 text-right" style="color: #23bf08">Grand Total</strong>
                                    <strong class="col-md-5 text-right" style="color: #23bf08">৳{{$cart_total}}</strong>
                                </div>
                                <br><br>
                                    <small class="text-danger text-center center-block"><a href="{{ route('cartPage') }}">Have any coupon code but forgot to apply?</a></small>
                                
                                @endif
                            </div>
                        </div>
                    </div> <!-- checkout-progress-sidebar -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        

        
 
<!--================================ Dependent District & State Dropdown =================================================-->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
$(document).ready(function () {

    $('select[name="division_id"]').on('change', function () {
        var division_id = $(this).val();
        if (division_id) {
            $.ajax({
                url: "{{ url('/user/district/ajax')}}/" + division_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="state_id"]').html('');
                    
                    var d = $('select[name="district_id"]').empty();
                    $.each(data, function (key, value) {
                        $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.district_name_en + '</option>');
                    });
                },
            });
        } else {
            alert('danger');
        }
    });

    $('select[name="district_id"]').on('change', function () {
        var district_id = $(this).val();
        if (district_id) {
            $.ajax({
                url: "{{ url('/user/state/ajax')}}/" + district_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var d = $('select[name="state_id"]').empty();
                    $.each(data, function (key, value) {
                        $('select[name="state_id"]').append('<option value="' + value.id + '">' + value.state_name_en + '</option>');
                    });
                },
            });
        } else {
            alert('danger');
        }
    });
});

</script>
<!--================================ End: Dependent District & State Dropdown =================================================-->       
        
        

@endsection