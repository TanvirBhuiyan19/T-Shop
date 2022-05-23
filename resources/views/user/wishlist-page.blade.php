@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if(session()->get('language') == 'bangla') ইচ্ছেতালিকা @else Wishlists @endif 
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection



@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                 @if(session()->get('language') == 'bangla')
                <li><a href="{{ url('/') }}">হোম</a></li>
                <li class='active'>ইচ্ছেতালিকা</li>
                @else
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Wishlist</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-md-12 my-wishlist" style="min-height: 400px;">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="heading-title"> @if(session()->get('language')=='bangla') আমার ইচ্ছেতালিকা @else My Wishlist @endif </th>
                                </tr>
                            </thead>
                            <tbody id="allWishlists">

                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>			
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->



        @endsection