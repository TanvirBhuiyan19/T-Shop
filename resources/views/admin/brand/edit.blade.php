@extends('layouts.adminMaster')

@section('brands')
active
@endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit Brand | {{$settings->site_name}} @else Edit Brand | {{config('app.name')}}  @endif
@endsection


@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('brands')}}">Brands</a>
    <span class="breadcrumb-item active">Edit Brand</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Brand Data Table ----------------------------------------------->         
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card ">
                <h5 class="card-header text-center">Edit Brand </h5>
                <div class="card-body">


                    <div class="form-layout">
                        <form method="POST" action="{{ route('brand.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Brand Name in English <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="brand_name_en" value="{{$brand->brand_name_en}}">
                                        @error('brand_name_en')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Brand Name in Bangla <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="brand_name_bn" value="{{$brand->brand_name_bn}}">
                                        @error('brand_name_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Brand Logo </label> 
                                        <input class="form-control" type="file"  accept=".png,.jpg,.jpeg" name="brand_logo">
                                        <input class="form-control" type="hidden" name="old_brand_logo" value="{{$brand->brand_logo}}">
                                        <input class="form-control" type="hidden" name="brand_id" value="{{$brand->id}}">
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-success mg-r-5">Update Brand</button>
                                <a href="{{route('brands')}}" class="btn btn-secondary">Cancel</a>
                            </div><!-- form-layout-footer -->
                        </form>
                    </div><!-- form-layout -->

                </div><!-- card body -->
            </div><!-- card -->
        </div>
        <!--<!------------------------ End Brand Data Table ----------------------------------------------->                

    </div><!-- row -->
    <br><br>
</div>>

@endsection