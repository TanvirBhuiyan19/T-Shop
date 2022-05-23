@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if(session()->get('language') == 'bangla') লগিন অথবা রেজিস্ট্রেশন @else Login or Register @endif
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection



@section('content')
        
@php
function bn_price($data){
$en = array(0,1,2,3,4,5,6,7,8,9);
$bn = array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
$result = str_replace($en, $bn, $data);
return $result;
}
@endphp

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'bangla')
                <li><a href="{{url('/')}}">হোম</a></li>
                <li class='active'>লগিন অথবা রেজিস্ট্রেশন</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>Login or Register</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
<!--------------------------------- Sign-in ------------------------------------------------------->			
                <div class="col-md-6 col-sm-6 sign-in" >
                    @error('banned')
                    <div style="border: 2px solid red">
                    <h4 class="text-center" style="color: red; padding-bottom: 0px !important; border-bottom: 0px !important;">{{ $message }}</h4>
                    </div><br>
                    @enderror
                    <h4 class="text-center">Sign in</h4>
                    <p class="">Welcome to your {{ config('app.name') }} account.</p>
                    <div class="social-sign-in outer-top-xs">
                        <a href="{{route('login.google')}}" class="twitter-sign-in"><i class="fa fa-google"></i> Sign In with Google</a>
                        <a href="{{route('login.facebook')}}" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                    </div>
                    <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label class="info-title" for="email">Email Address <span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input" id="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="password">Password <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="password" @error('password') is-invalid @enderror" name="password" autocomplete="current-password" >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="radio outer-xs">
                            <label>
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? '' : 'checked' }}>
                                {{ __('Remember Me') }}
                            </label>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link pull-right" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif

                        </div>

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('Login') }}</button>
                    </form
                    <br><br><br>
                </div>
<!--------------------------------- End Sign-in --------------------------------------------------->	
                
<!--------------------------------- create a new account ------------------------------------------>
                <div class="col-md-6 col-sm-6 create-new-account"  style="border-left: 2px solid #DDDDDD">
                    <h4 class="checkout-subtitle text-center">Create a new account</h4>
                    <p class="text title-tag-line">Create your {{ config('app.name', 'Laravel') }} account.</p>
                    <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label class="info-title" for="name">Name <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input @error('name') is-invalid @enderror" id="name"  name="name" placeholder="Your Name" value="{{ old('name') }}" autocomplete="name" >
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="email">Email Address <span>*</span></label>
                            <input type="email" placeholder="Your Email" class="form-control unicase-form-control" id="email" name="email" >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="phone">Phone Number <span>*</span></label>
                            <input type="number" placeholder="Your Mobile Number" class="form-control unicase-form-control text-input" name="phone" >
                             @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="password">Password <span>*</span></label>
                            <input type="password" placeholder="Password" class="form-control unicase-form-control text-input @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="password-confirm">Confirm Password <span>*</span></label>
                            <input id="password-confirm" placeholder="Re-Type Password" type="password" class="form-control unicase-form-control text-input" name="password_confirmation" autocomplete="new-password" >
                        </div>

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('Sign Up') }}</button>
                    </form>
                </div>
<!--------------------------------- End create a new account -------------------------------------->

            </div>
            <br><br><br>
        </div>
    </div>
</div>

<br><br><br>
@endsection
