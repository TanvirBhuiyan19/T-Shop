@extends('layouts.adminMaster')

@section('chats') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Admin Chats | {{$settings->site_name}} @else Admin Chats | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Admin Chats</span>
</nav>


<div class="sl-pagebody">
    <div id="app">
        <admin-chat class="text-center"></admin-chat>
    </div>
    <br><br>
</div>>

<script src="{{ asset('js/app.js') }}" ></script>

@endsection