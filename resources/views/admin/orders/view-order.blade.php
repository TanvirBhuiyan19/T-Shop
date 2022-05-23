@extends('layouts.adminMaster')

@section('orders') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Order Details | {{$settings->site_name}} @else Order Details | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Order Details</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-6 col-sm-12">
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

                <div class="col-md-6 col-sm-12">
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
                            <strong>Phone:</strong>
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
                            @if($order->status == 'Pending' || $order->status == 'Processing')
                            <span><strong style="color: #F4846F;">{{ $order->status }}</strong></span>
                            @elseif($order->status == 'Cancel')
                            <span><strong style="color: red;">{{ $order->status }}</strong></span>
                            @else
                            <span><strong style="color: #59B210;">{{ $order->status }}</strong></span>
                            @endif
                            
                            @isset(auth()->user()->role->permission['permission']['order']['add'] )
                                @if($order->status == 'Pending')
                                <a href="{{ url('admin/confirm-order/'.$order->id) }}" class="btn btn-sm btn-outline-success" style="float: right;" id="orderConfirm">Confirm this Order</a>
                                <a href="{{ url('admin/cancel-order/'.$order->id) }}" class="btn btn-sm btn-outline-danger" style="float: right;" id="orderCancel">Cancel this Order</a>
                                @elseif($order->status == 'Confirmed')
                                <a href="{{ url('admin/processing-order/'.$order->id) }}" class="btn btn-sm btn-outline-success" style="float: right;" id="orderProcessing">Processing this Order</a>
                                @elseif($order->status == 'Processing')
                                <a href="{{ url('admin/picked-order/'.$order->id) }}" class="btn btn-sm btn-outline-success" style="float: right;" id="orderPicked">Picked this Order</a>
                                @elseif($order->status == 'Picked')
                                <a href="{{ url('admin/shipped-order/'.$order->id) }}" class="btn btn-sm btn-outline-success" style="float: right;" id="orderShipped">Shipped this Order</a>
                                @elseif($order->status == 'Shipped')
                                <a href="{{ url('admin/delivered-order/'.$order->id) }}" class="btn btn-sm btn-outline-success" style="float: right;" id="orderDelivered">Delivered this Order</a>
                                @endif
                            @endisset
                        </li>

                        @php
                        $order_r = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
                        @endphp
                        @if (!$order_r)
                        <li class="list-group-item">
                            <span class="badge badge-pill badge-warning" style="background: red; text:white;">User Send a Return Request</span>
                        </li>
                        @endif

                    </ul>
                </div>  
            </div> 

            <br><br><br>

            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="table-responsive">
                        <table class="table table-bordered">
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
                                </tr>
                            </thead>
                            <tbody  style="background: #f5f7f9;">
                                @foreach ($orderItems as $item)
                                <tr class="text-center">
                                    <td class="col-md-1"><img src="{{ asset('uploads/product/thumbnail/') }}/{{$item->product->product_thumbnail}}" height="50px;" width="50px;" alt="imga"></td>
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

                                    <td class="col-md-2">
                                        <strong>৳{{ $item->price * $item->qty }}</strong>
                                    </td> 
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div style="background: #f5f7f9;">
                        <br>
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
                    <br><br>
                    </div>
                    <br>
                    @endif
                    <br><br><br>

                </div>
            </div>


        </div>  

    </div><!-- row -->
    <br><br>
</div>>

@endsection