@extends('layouts.adminMaster')

@section('sliders')
active
@endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Sliders | {{$settings->site_name}} @else Sliders | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Sliders</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Slider Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['slider']['list'] ) 
        <div class="col-lg-8 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Sliders List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
<!--                        <table id="datatable1" class="table display responsive wrap">-->
                        <table id="datatable1" class="table display responsive wrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p text-center">Image</th>
                                    <th class="wd-30p text-center">Title English</th>
                                    <th class="wd-30p text-center">Description English</th>
                                    <th class="wd-5p text-center">Status</th>
                                    <th class="wd-20p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slider)
                                <tr class="text-center">
                                    <td><img src="{{ asset('uploads/slider/') }}/{{$slider->slider_image}}" alt="Slider Logo" style="width: 100px;"></td>
                                    @if($slider->slider_title_en != NULL)
                                    <td>{{$slider->slider_title_en}}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif

                                    @if($slider->slider_description_en)
                                    <td>{{$slider->slider_description_en}}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif

                                    @if($slider->status == 1)
                                    <td>
                                        <span class="badge badge-pill badge-success" style="padding: 5px 10px;">Active</span>
                                    </td>
                                    @else
                                    <td>
                                        <span class="badge badge-pill badge-warning" style="padding: 5px 10px;">In-Active</span>
                                    </td>
                                    @endif

                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['slider']['delete'] )
                                                @if($slider->status == 1)
                                                <a href="{{route('slider.inactive',$slider->id)}}" style="padding-right:7px"  title="In-Active"><i class="fa fa-toggle-off text-dark"></i></a>
                                                @else
                                                <a href="{{route('slider.active',$slider->id)}}" style="padding-right:7px"  title="Active"><i class="fa fa-toggle-on text-dark"></i></a>
                                                @endif
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['slider']['edit'] )
                                                <a href="{{route('slider.edit',$slider->id)}}" style="padding-right:5px" title="Edit"><i class="fa fa-edit text-success"></i></a>
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['slider']['delete'] )    
                                                <a href="{{route('slider.delete',$slider->id)}}" id="delete"><i class="fa fa-trash text-danger" title="Delete"></i></a>
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
        <!--<!------------------------ End Slider Data Table ----------------------------------------------->       

        <!--<!------------------------ Slider Input Form ------------------------------------------------->
    @isset(auth()->user()->role->permission['permission']['slider']['add'] ) 
        <div class="col-lg-4 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Create a New Slider</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('slider.create') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Slider Title in English: </strong></label>
                                <input class="form-control" type="text" name="slider_title_en" value="{{ old('slider_title_en') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Slider Title in Bangla: </strong></label>
                                <input class="form-control" type="text" name="slider_title_bn" value="{{ old('slider_title_bn') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Slider Description in English: </strong></label>
                                <input class="form-control" type="text" name="slider_description_en" value="{{ old('slider_description_en') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Slider Description in Bangla: </strong></label>
                                <input class="form-control" type="text" name="slider_description_bn" value="{{ old('slider_description_bn') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Slider URL in English: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon tx-size-sm lh-2">{{ config('app.url') }}/</span>
                                    <input type="text" class="form-control" name="url" placeholder="example/page-name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Slider Image: </strong><span class="tx-danger">*</span> (870*370)</label>
                                <input class="form-control" type="file" name="slider_image" accept=".png,.jpg,.jpeg" >
                                @error('slider_image')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-10">
                            <button class="btn btn-success btn-block">Create Slider</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-4 -->
    @endisset
        <!--<!------------------------ End Slider Input Form ----------------------------------------------> 


    </div><!-- row -->
    <br><br>
</div>>

@endsection