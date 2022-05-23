@extends('layouts.adminMaster')

@section('sliders')
active
@endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit Slider | {{$settings->site_name}} @else Edit Slider | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('sliders')}}">Sliders</a>
    <span class="breadcrumb-item active">Edit Slider</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Brand Data Table ----------------------------------------------->         
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card ">
                <h5 class="card-header text-center">Edit Slider </h5>
                <div class="card-body">


                    <div class="form-layout">
                        <form method="POST" action="{{ route('slider.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mg-b-25">

                                @if($slider->slider_title_en)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Slider Title in English: </strong></label>
                                        <input class="form-control" type="text" name="slider_title_en" value="{{ $slider->slider_title_en }}">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Slider Title in Bangla: </strong></label>
                                        <input class="form-control" type="text" name="slider_title_bn" value="{{ $slider->slider_title_bn }}">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Slider Description in English: </strong></label>
                                        <input class="form-control" type="text" name="slider_description_en" value="{{ $slider->slider_description_en }}">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Slider Description in Bangla: </strong></label>
                                        <input class="form-control" type="text" name="slider_description_bn" value="{{ $slider->slider_description_bn }}">
                                    </div>
                                </div><!-- col-4 -->
                                @endif

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Slider Image: </strong></label> 
                                        <input class="form-control" type="file"  accept=".png,.jpg,.jpeg" name="slider_image">
                                        <input class="form-control" type="hidden" name="old_slider_image" value="{{$slider->slider_image}}">
                                        <input class="form-control" type="hidden" name="slider_id" value="{{$slider->id}}">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Old Image: </strong></label> 
                                        <img src="{{ asset('uploads/slider/') }}/{{$slider->slider_image}}" alt="Slider Logo" style="width: 218px; height: 92px;">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Slider URL in English: </strong></label>
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">{{ config('app.url') }}/</span>
                                            <input type="text" class="form-control" name="url" placeholder="example/page-name" value="{{$slider->url}}">
                                        </div>
                                        @error('url')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div><!-- row -->

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-success mg-r-5">Update Slider</button>
                                <a href="{{route('sliders')}}" class="btn btn-secondary">Cancel</a>
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