@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if(session()->get('language') == 'bangla') ওয়ার্ডারের বিবরণ @else Order Details @endif 
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection



@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'bangla')
                <li><a href="{{ url('/') }}">হোম</a></li>
                <li class='active'>ওয়ার্ডারের বিবরণ</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                <li class='active'>Order Details</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="sign-in-page" style="height: auto">
                    <div class="tab-content" style="padding-left: 0px !important;">

                        <!-------------------------------------------- Order List Section -------------------------------> 
                        <p style="font-size:20px;" class="text-center text-capitalize text-black">Order Details</p>
                        <hr>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <ul class="list-group">
                                    <li class="list-group-item active text-center">Shipping Information</li>
                                    <li class="list-group-item">
                                        <strong>Name:  </strong> {{ $order->name }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Phone:  </strong>
                                        {{ $order->phone }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email:  </strong>
                                        {{ $order->email }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Division:  </strong>
                                        {{ $order->division->division_name_en }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>District:  </strong>
                                        {{ $order->district->district_name_en }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>State:  </strong>
                                        {{ $order->state->state_name_en }}
                                    </li>

                                    <li class="list-group-item">
                                        <strong>Post Code:  </strong>
                                        {{ $order->post_code }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Order Date:  </strong>
                                        {{ $order->order_date }}
                                    </li>
                                    @if($order->notes != NULL)
                                    <li class="list-group-item">
                                        <strong>Notes:  </strong>
                                        {{ $order->notes }}
                                    </li>
                                    @endif
                                </ul>
                            </div>

                            <div class="col-md-5">
                                <ul class="list-group">
                                    <li class="list-group-item active text-center">Order Information</li>
                                    <li class="list-group-item">
                                        <strong>Name:</strong> {{ $order->user->name }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Phone:</strong>
                                        {{ $order->user->phone }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email:</strong>
                                        {{ $order->user->email }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Payment By:</strong>
                                        {{ $order->payment_method }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Transaction Id:</strong>
                                        {{ $order->transaction_id }}
                                    </li>

                                    <li class="list-group-item">
                                        <strong>Invoice No:</strong>
                                        {{ $order->invoice_no }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Order No:</strong>
                                        {{ $order->order_number }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Order Total:</strong>
                                        {{ $order->amount }} Taka
                                    </li>

                                    <li class="list-group-item">
                                        <strong>Order Status:</strong>
                                        @if($order->status == 'Pending')
                                        <span><strong style="color: #F4846F;">{{ $order->status }}</strong></span>
                                        @elseif($order->status == 'Cancel')
                                        <span><strong style="color: red;">{{ $order->status }}</strong></span>
                                        @else
                                        <span><strong style="color: #59B210;">{{ $order->status }}</strong></span>
                                        @endif
                                    </li>

                                    @php
                                    $order_r = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
                                    @endphp
                                    @if (!$order_r)
                                    <li class="list-group-item">
                                        <span class="badge badge-pill badge-warning" style="background: red; text:white;">You Have Send a Return Request</span>
                                    </li>
                                    @endif

                                </ul>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <br>

                        <div class="row mt-30">
                            <div class="col-md-12 m-auto">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr style="background: #E9EBEC;" class="text-center">
                                                <td class="col-md-1">
                                                    <label for="">Image</label>
                                                </td>
                                                <td class="col-md-3">
                                                    <label for="">Poduct Name</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">Poduct Code</label>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="">Color</label>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="">Size</label>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="">Price</label>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="">Quantity</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">Line Total</label>
                                                </td>
                                                @if ($order->status == 'Delivered')
                                                <td class="col-md-1">
                                                    <label for="">Review</label>
                                                </td>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderItems as $item)
                                            <tr class="text-center">
                                                <td class="col-md-1">
                                                    <img src="{{ asset('uploads/product/thumbnail/') }}/{{$item->product->product_thumbnail}}" height="50px;" width="50px;" alt="imga">
                                                </td>
                                                <td class="col-md-3">
                                                    <div class="product-name"><strong>{{ $item->product->product_name_en }}</strong>
                                                    </div>
                                                </td>

                                                <td class="col-md-2">
                                                    <strong>{{ $item->product->product_code }}</strong>
                                                </td>
                                                @if($item->color)
                                                <td class="col-md-1">
                                                    <strong>{{ $item->color }}</strong>
                                                </td>
                                                @else
                                                <td class="col-md-1">
                                                    <strong>---</strong>
                                                </td>
                                                @endif
                                                @if($item->size)
                                                <td class="col-md-1">
                                                    <strong>{{ $item->size }}</strong>
                                                </td>
                                                @else
                                                <td class="col-md-1">
                                                    <strong>---</strong>
                                                </td>
                                                @endif

                                                <td class="col-md-1">
                                                    <strong>৳{{ $item->price }}</strong>
                                                </td> 

                                                <td class="col-md-1">
                                                    <strong>{{ $item->qty }}</strong>
                                                </td>

                                                <td class="col-md-1">
                                                    <strong>৳{{ $item->price * $item->qty }}</strong>
                                                </td> 
                                                @if ($order->status == 'Delivered')
                                                <td class="col-md-1">
                                                    <a href="{{ url('user/review-create/'.$item->product_id.'/'.$order->id) }}">write a review</a>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-7"></div>
                                    @if($order->coupon_code)
                                    <strong class="col-md-2 text-right">Subtotal: </strong>
                                    <strong class="col-md-2 text-right"> ৳{{$order->amount + $order->discount_amount}}</strong>
                                    @else
                                    <strong class="col-md-2 text-right" style="color: #23bf08; padding: 5px; border: 1px solid #DDDDDD; background: #F9F9F9">Grand Total: </strong>
                                    <strong class="col-md-2 text-right" style="color: #23bf08; padding: 5px; border: 1px solid #DDDDDD; background: #F9F9F9"> ৳{{$order->amount}}</strong>
                                    @endif
                                </div>
                                <br>
                                @if($order->coupon_code)
                                <div class="row">
                                    <div class="col-md-7"></div>
                                    <strong class="col-md-2 text-right">Coupon Code: </strong>
                                    <strong class="col-md-2 text-right"> {{$order->coupon_code}}</strong>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-7"></div>
                                    <strong class="col-md-2 text-right">Coupon Discount: </strong>
                                    <strong class="col-md-2 text-right"> {{$order->coupon_discount}}%</strong>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-7"></div>
                                    <strong class="col-md-2 text-right">Discount Amount: </strong>
                                    <strong class="col-md-2 text-right"> ৳{{$order->discount_amount}}</strong>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-7"></div>
                                    <strong class="col-md-2 text-right" style="color: #23bf08; padding: 5px; border: 1px solid #DDDDDD; background: #F9F9F9">Grand Total: </strong>
                                    <strong class="col-md-2 text-right" style="color: #23bf08; padding: 5px; border: 1px solid #DDDDDD; background: #F9F9F9"> ৳{{$order->amount}}</strong>
                                </div>
                                <br>
                                @endif
                                <br>
                                @if ($order->status !== "Delivered")
                                @else
                                    @php
                                    $order = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
                                    @endphp
                                    @if ($order)
                                    <form action="{{ route('user-return-order') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <div class="form-group">
                                            <label for="label">Do You want To Return This Order?</label>
                                            <textarea name="return_reason" id="label"  class="form-control" cols="30" rows="05" placeholder="Return Reason"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-danger">Submit</button>
                                    </form>
                                    @endif
                                @endif

                                <br><br>
                                <a href="{{route('user.dashboard')}}"><button class="btn btn-success center-block"><i class="fa fa-arrow-left"></i> Back to Dashboard</button></a>
                                <br><br><br><br>
                            </div>
                        </div>

                        <!-------------------------------------------- End: Order List Section -------------------------------> 

                    </div>

                </div>

            </div>
        </div>



        @endsection
