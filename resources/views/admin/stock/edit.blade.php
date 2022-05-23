@extends('layouts.adminMaster')

@section('stock') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit Stock | {{$settings->site_name}} @else Edit Stock | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('coupons')}}">Coupons</a>
    <span class="breadcrumb-item active">Edit Stock</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">   

        <!--<!------------------------ Coupon Edit Form ------------------------------------------------->
        <div class="col-lg-6 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Edit Product Stock</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('stock-update',$product->id) }}">
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Product Quantity: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="number" name="product_qty" value="{{ $product->product_qty }}">
                                @error('product_qty')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-layout-footer mg-t-10">
                            <button class="btn btn-success btn-block">Update Stock</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-6 -->
        <!--<!------------------------ End: Coupon Edit Form ----------------------------------------------> 


    </div><!-- row -->
    <br><br>
</div>>

@endsection