@extends('layouts.adminMaster')

@section('coupons')
active
@endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit Coupon | {{$settings->site_name}} @else Edit Coupon | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('coupons')}}">Coupons</a>
    <span class="breadcrumb-item active">Edit Coupon</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">   

        <!--<!------------------------ Coupon Edit Form ------------------------------------------------->
        <div class="col-lg-6 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Edit Coupon</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('coupon.update') }}">
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Coupon Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="coupon_name" value="{{ $coupon->coupon_name }}">
                                @error('coupon_name')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Coupon Code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="coupon_code" value="{{ $coupon->coupon_code }}">
                                @error('coupon_code')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Coupon Discount: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="coupon_discount" value="{{ $coupon->coupon_discount }}" min="1" max="99">
                                    <span class="input-group-addon tx-size-sm lh-2">%</span>
                                </div>
                                @error('coupon_discount')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Coupon Validity: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="date" name="coupon_validity" value="{{ $coupon->coupon_validity }}">
                                @error('coupon_validity')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-layout-footer mg-t-10">
                            <input type="hidden" name="coupon_id" value="{{ $coupon->id }}">
                            <button class="btn btn-success btn-block">Update Coupon</button>
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