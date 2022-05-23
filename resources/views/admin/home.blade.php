@extends('layouts.adminMaster')

@section('dashboard')
    active
@endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Dashboard | {{$settings->site_name}} @else Dashboard | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <span class="breadcrumb-item active">Dashboard</span>
</nav>


<div class="sl-pagebody">


        <div class="row row-sm">

           <div class="col-sm-6 col-xl-3 mg-sm-t-0 mg-md-t-0 mg-xl-t-0">
                <div class="card pd-20 pd-sm-25 bg-purple ">
                    <div class="d-flex align-items-center">
                    <div class="mg-l-15">
                        <h4 class="tx-uppercase tx-12 tx-spacing-1 tx-medium tx-white mg-b-8">SELL (TODAY)</h4>
                        <h3 class="tx-bold tx-lato tx-white mg-b-0">৳{{$todaySell}}</h3>
                    </div>
                    </div>
                </div><!-- card -->
            </div><!-- col-3 -->
                
            <div class="col-sm-6 col-xl-3 mg-xs-t-20 mg-sm-t-0 mg-md-t-0 mg-xl-t-0">
                <div class="card pd-20 pd-sm-25 bg-secondary ">
                    <div class="d-flex align-items-center">
                    <div class="mg-l-15">
                        <h4 class="tx-uppercase tx-12 tx-spacing-1 tx-medium tx-white mg-b-8">SELL (THIS MONTH)</h4>
                        <h3 class="tx-bold tx-lato tx-white mg-b-0">৳{{$thisMonthSell}}</h3>
                    </div>
                    </div>
                </div><!-- card -->
            </div><!-- col-3 -->

            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 pd-sm-25 bg-success">
                <div class="d-flex align-items-center">
                <div class="mg-l-15">
                    <h4 class="tx-uppercase tx-12 tx-spacing-1 tx-medium tx-white mg-b-8">SELL (THIS YEAR)</h4>
                    <h3 class="tx-bold tx-lato tx-white mg-b-0">৳{{$thisYearSell}}</h3>
                </div>
                </div>
            </div><!-- card -->
            </div><!-- col-3 -->

            <div class="col-sm-6 col-xl-3  mg-t-20 mg-xl-t-0">
            <div class="card pd-20 pd-sm-25 bg-primary">
                <div class="d-flex align-items-center">
                <div class="mg-l-15">
                    <h4 class="tx-uppercase tx-12 tx-spacing-1 tx-medium tx-white mg-b-8">SELL (ALL TIME)</h4>
                    <h3 class="tx-bold tx-lato tx-white mg-b-0">৳{{$allTimeSell}}</h3>
                </div>
                </div>
            </div><!-- card -->
            </div><!-- col-3 -->

        </div><!-- row -->


        <div class="row row-sm">
        
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-25">
            <div class="card pd-20 pd-sm-25 bg-teal ">
                <div class="d-flex align-items-center">
                <div class="mg-l-15">
                    <h4 class="tx-uppercase tx-12 tx-spacing-1 tx-medium tx-white mg-b-8">TOTAL PRODUCTS</h4>
                    <h3 class="tx-bold tx-lato tx-white mg-b-0">{{ count($totalProducts) }}</h3>
                </div>
                </div>
            </div><!-- card -->
            </div><!-- col-3 -->

            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-25">
                <div class="card pd-20 pd-sm-25 bg-warning">
                    <div class="d-flex align-items-center">
                    <div class="mg-l-15">
                        <h4 class="tx-uppercase tx-12 tx-spacing-1 tx-medium tx-white mg-b-8">TOTAL ACTIVE PRODUCTS</h4>
                        <h3 class="tx-bold tx-lato tx-white mg-b-0">{{ count($totalActiveProducts) }}</h3>
                    </div>
                    </div>
                </div><!-- card -->
                </div><!-- col-3 -->

            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-25">
            <div class="card pd-20 pd-sm-25 bg-info">
                <div class="d-flex align-items-center">
                <div class="mg-l-15">
                    <h4 class="tx-uppercase tx-12 tx-spacing-1 tx-medium tx-white mg-b-8">TOTAL ORDERS</h4>
                    <h3 class="tx-bold tx-lato tx-white mg-b-0">{{ count($totalOrders) }}</h3>
                </div>
                </div>
            </div><!-- card -->
            </div><!-- col-3 -->

            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-25">
            <div class="card pd-20 pd-sm-25 bg-sl-primary">
                <div class="d-flex align-items-center">
                <div class="mg-l-15">
                    <h4 class="tx-uppercase tx-12 tx-spacing-1 tx-medium tx-white mg-b-8">TOTAL ORDER ITEMS</h4>
                    <h3 class="tx-bold tx-lato tx-white mg-b-0">{{ $totalOrderItems }}</h3>
                </div>
                </div>
            </div><!-- card -->
            </div><!-- col-3 -->
            
        </div><!-- row -->


   <br>
   <br>
   <!--========================== Recent Orders DataTales =====================-->
   <div class="card shadow mb-4">
        <div class="card-header py-3  text-center">
        <span class="m-0 font-weight-bold text-primary">Recent Orders </span>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead class="bg-purple">
                    <tr>
                        <th>Customer</th>
                        <th>Invoice No</th>
                        <th>Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                        @forelse ($recentOrders as $order)
                        <tr>
                            <td>{{$order->name}}</td>
                            <td>{{$order->invoice_no}}</td>
                            <td>{{ date('d F Y (g:i A)', strtotime($order->created_at)) }}</td>
                            <td class="text-center">
                                @if($order->status == 'Delivered')
                                <span class="badge badge-success">{{$order->status}}</span>
                                @elseif($order->status == 'Cancel')
                                <span class="badge badge-danger">{{$order->status}}</span>
                                @elseif($order->status == 'Pending')
                                <span class="badge badge-warning">{{$order->status}}</span>
                                @elseif($order->status == 'Processing')
                                <span class="badge badge-info">{{$order->status}}</span>
                                @elseif($order->status == 'Confirmed')
                                <span class="badge badge-primary">{{$order->status}}</span>
                                @elseif($order->status == 'Picked')
                                <span class="badge badge-secondary">{{$order->status}}</span>
                                @elseif($order->status == 'Shipped')
                                <span class="badge badge-dark">{{$order->status}}</span>
                                @endif
                            </td>
                            <td class="text-center">৳{{$order->amount}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <br><h1>No data found!</h1><br>
                            </td>
                        </tr> 
                        @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <!--========================== Stock Out Products DataTales =====================-->
    <div class="card shadow mb-4">
        <div class="card-header py-3  text-center">
          <span class="m-0 font-weight-bold text-primary">Stock Out Products ({{ count($stockOutProducts) }})</span>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
              <thead class="bg-primary">
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                    @forelse ($stockOutProducts as $product)
                    <tr>
                        <td>
                            <img src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" width="50px">
                        </td>
                        <td>{{$product->product_name_en}}</td>
                        <td>{{$product->product_code}}</td>
                        <td class="text-center">{{$product->product_qty}}</td>
                        <td class="text-center"><span class="badge badge-danger">Stock Out</span></td>
                        <td class="text-center">
                            <a href="{{route('product.edit',$product->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <br><h1>No data found!</h1><br>
                        </td>
                    </tr> 
                    @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

</div>
@endsection

