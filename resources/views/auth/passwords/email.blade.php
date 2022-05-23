@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if(session()->get('language') == 'bangla') পাসওয়ার্ড রিসেট @else Reset Password @endif
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
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->			
                <div class="col-md-6 col-sm-6 sign-in col-md-offset-3" >
                    <br>
                    <h2 class="text-center text-bold text-danger">Reset Your Password !!</h2>
                    <hr>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    <hr>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="email" class=" col-form-label">{{ __('E-Mail Address') }}</label>
                            </div>   
                            <div class="col-md-9">
                                <input id="email" type="email" placeholder="Enter Your Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>


                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Send Password Reset Link') }}
                            </button>
                            <br><br><br><br><br>
                        </div>
                    </form>					
                </div>
                </div>
                <!-- Sign-in -->
            </div>
        </div>
    </div>
</div>
<br><br><br>
<br><br><br>






















<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection
