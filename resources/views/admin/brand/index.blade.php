@extends('layouts.adminMaster')

@section('brands')
active
@endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Brands | {{$settings->site_name}} @else Brands | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Brands</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Brand Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['brand']['list'] )
        <div class="col-lg-8 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Brands List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive wrap">
                            <thead>
                                <tr>
                                    <th class="wd-25p text-center">Logo</th>
                                    <th class="wd-30p text-center">Brand Name En</th>
                                    <th class="wd-30p text-center">Brand Name Bn</th>
                                    <th class="wd-15p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                <tr class="text-center">
                                    <td><img src="{{ asset('uploads/brand/') }}/{{$brand->brand_logo}}" alt="Brand Logo" style="width: 80px;"></td>
                                    <td>{{$brand->brand_name_en}}</td>
                                    <td>{{$brand->brand_name_bn}}</td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['brand']['edit'] )
                                            <a href="{{route('brand.edit',$brand->id)}}" style="padding-right:5px" title="Edit"><i class="fa fa-edit text-success"></i></a>
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['brand']['delete'] )
                                            <a href="{{route('brand.delete',$brand->id)}}" id="delete"><i class="fa fa-trash text-danger" title="Delete"></i></a>
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
        <!--<!------------------------ End Brand Data Table ----------------------------------------------->       

        <!--<!------------------------ Brand Input Form ------------------------------------------------->
    @isset(auth()->user()->role->permission['permission']['brand']['add'] )
        <div class="col-lg-4 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Create a New Brand</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('brand.create') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Brand Name in English: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="brand_name_en" value="{{ old('brand_name_en') }}">
                                @error('brand_name_en')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Brand Name in Bangla: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="brand_name_bn" value="{{ old('brand_name_bn') }}">
                                @error('brand_name_bn')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Brand Logo: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="file" name="brand_logo" accept=".png,.jpg,.jpeg" >
                                @error('brand_logo')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-10">
                            <button class="btn btn-success btn-block">Create Brand</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-6 -->
    @endisset
        <!--<!------------------------ End Brand Input Form ----------------------------------------------> 


    </div><!-- row -->
    <br><br>
</div>>

@endsection