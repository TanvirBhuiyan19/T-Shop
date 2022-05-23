@extends('layouts.adminMaster')

@section('settings')
active
@endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Settings | {{$settings->site_name}} @else Settings | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Settings</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">     
   
        <div class="col-lg-6 col-md-10 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Configur Your Website</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('settings.create') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Website Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="site_name" value="@isset($settings){{ $settings->site_name }}@endisset">
                                @error('site_name')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Website Title: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="site_title" value="@isset($settings){{ $settings->site_title }}@endisset">
                                @error('site_title')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-10 col-md-10 col-lg-8">
                                <label class="form-control-label">Website Logo: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="file" name="site_logo" accept=".png,.jpg,.jpeg" >
                                @error('site_logo')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-4" style="background-color: #333">
                                @isset($settings->site_logo)
                                <br>
                                <img src="{{ asset('uploads/settings/'.$settings->site_logo ) }}" style="height: 30px;">
                                @endisset
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-10 col-md-10 col-lg-8">
                                <label class="form-control-label">Favicon Icon: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="file" name="favicon_icon" accept=".png,.jpg,.jpeg" value="@isset($settings){{ config('app.url').'/uploads/settings/'.$settings->favicon_icon }}@endisset" >
                                @error('favicon_icon')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-4">
                                @isset($settings->favicon_icon)
                                <br>
                                <img src="{{ asset('uploads/settings/'.$settings->favicon_icon ) }}" style="width: 50px;">
                                @endisset
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Website Address: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="address" value="@isset($settings){{ $settings->address }}@endisset">
                                @error('address')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Website Email: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="email" value="@isset($settings){{ $settings->email }}@endisset">
                                @error('email')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Website Mobile No. <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="mobile" value="@isset($settings){{ $settings->mobile }}@endisset">
                                @error('mobile')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Facebook: </label>
                                <input class="form-control" type="text" name="facebook" value="@isset($settings->facebook){{ $settings->facebook }}@endisset">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Instagram: </label>
                                <input class="form-control" type="text" name="instagram" value="@isset($settings->instagram){{ $settings->instagram }}@endisset">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Twitter: </label>
                                <input class="form-control" type="text" name="twitter" value="@isset($settings->twitter){{ $settings->twitter }}@endisset">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Pinterest: </label>
                                <input class="form-control" type="text" name="pinterest" value="@isset($settings->pinterest){{ $settings->pinterest }}@endisset">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Linkedin: </label>
                                <input class="form-control" type="text" name="linkedin" value="@isset($settings->linkedin){{ $settings->linkedin }}@endisset">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label">Youtube: </label>
                                <input class="form-control" type="text" name="youtube" value="@isset($settings->youtube){{ $settings->youtube }}@endisset">
                            </div>
                        </div>

                        <div class="form-layout-footer mg-t-10">
                            <button class="btn btn-success btn-block">Save Configurations</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-6 -->
   
        <!--<!------------------------ End Brand Input Form ----------------------------------------------> 


    </div><!-- row -->
    <br><br>
</div>>


@endsection