@extends('layouts.frontendMaster')
@section('title') Password Reset | {{config('app.name')}} @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if(session()->get('language') == 'bangla') পাসওয়ার্ড রিসেট @else Reset Password @endif
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection



@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'bangla')
                <li><a href="{{url('/')}}">হোম</a></li>
                <li class='active'>পাসওয়ার্ড রিসেট</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>Reset Password</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 col-sm-12">
                    <div class="panel-group checkout-steps" >

                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">		
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10 col-sm-12 guest-login">

                                            <h2 class="text-center text-bold text-danger">Reset Your Password !!</h2>
                                            <hr>
                                            <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('password.update') }}">
                                                @csrf
                                                <input type="hidden" name="token" value="{{ $token }}">

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="email" value="{{ $email ?? old('email') }}" placeholder="email address" >
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputPassword">New Password <span>*</span></label>
                                                    <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword" name="password"  placeholder="password" >
                                                    @error('password')
                                                    <span class="invalid-feedback text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                                                    <input type="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="password_confirmation"  placeholder="Retype Password" >
                                                </div>

                                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('Reset Password') }}</button>
                                                <a href="{{ route('login') }}" class="forgot-password pull-right">Return to login</a>

                                            </form>  

                                        </div>
                                        <div class="col-md-1"></div>		
                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div><!-- checkout-step-01  -->


                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-2"></div>

            </div><!-- /.row -->
        </div><!-- /.checkout-box -->   



        @endsection