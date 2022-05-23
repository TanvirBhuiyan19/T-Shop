@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title')  
@if($settings->site_name) Privacy Policy | {{$settings->site_name}} @else Privacy Policy | {{config('app.name')}}  @endif
@endsection



@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>Privacy Policy</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>





@endsection