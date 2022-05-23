@extends('layouts.adminMaster')

@section('coupons')
active
@endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Coupons | {{$settings->site_name}} @else Coupons | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Coupons</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Coupon Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['coupon']['list'] )
        <div class="col-lg-8 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Coupons List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive wrap">
                            <thead>
                                <tr>
                                    <th class="wd-25p text-center">Coupon Name</th>
                                    <th class="wd-15p text-center">Code</th>
                                    <th class="wd-10p text-center">Discount</th>
                                    <th class="wd-25p text-center">Validity</th>
                                    <th class="wd-10p text-center">Status</th>
                                    <th class="wd-15p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr class="text-center">
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->coupon_discount }}%</td>
                                    <td>{{ Carbon\Carbon::parse($coupon->coupon_validity)->format('D, d F Y') }}</td>
                                    <td>
                                    @if($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d') )
                                        <span class="badge badge-pill badge-success" style="padding: 5px 10px;">Valid</span>
                                    @else
                                        <span class="badge badge-pill badge-warning" style="padding: 5px 10px;">Invalid</span>
                                    @endif
                                    </td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['coupon']['edit'] )
                                                <a href="{{route('coupon.edit',$coupon->id)}}" style="padding-right:5px" title="Edit"><i class="fa fa-edit text-success"></i></a>
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['coupon']['delete'] )    
                                                <a href="{{route('coupon.delete',$coupon->id)}}" id="delete"><i class="fa fa-trash text-danger" title="Delete"></i></a>
                                            @endisset
                                        </h4>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                </div><!-- card body -->
            </div><!-- card -->
        </div>
    @endisset
        <!--<!------------------------ End Coupon Data Table ----------------------------------------------->       

        <!--<!------------------------ Coupon Input Form ------------------------------------------------->
    @isset(auth()->user()->role->permission['permission']['coupon']['add'] )
        <div class="col-lg-4 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Create a New Coupon</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('coupon.create') }}">
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Coupon Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="coupon_name" value="{{ old('coupon_name') }}">
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
                                <input class="form-control" type="text" name="coupon_code" value="{{ old('coupon_code') }}">
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
                                    <input type="number" class="form-control" name="coupon_discount" value="{{ old('coupon_discount') }}" min="1" max="99">
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
                                <input class="form-control" type="date" name="coupon_validity" value="{{ old('coupon_validity') }}" 
                                       min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                @error('coupon_validity')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-layout-footer mg-t-10">
                            <button class="btn btn-success btn-block">Create Coupon</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-4 -->
    @endisset
        <!--<!------------------------ End Coupon Input Form ----------------------------------------------> 


    </div><!-- row -->
    <br><br>
</div>>

@endsection