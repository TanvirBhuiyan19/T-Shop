@extends('layouts.adminMaster')

@section('roles') active show-sub @endsection
@section('role.create') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Add Role | {{$settings->site_name}} @else Add Role | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('role.index')}}">Roles</a>
    <span class="breadcrumb-item active">Add Role</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Brand Data Table ----------------------------------------------->         
        <div class="col-lg-10 col-md-10 col-sm-10 m-auto" >
            <div class="card ">
                <h5 class="card-header text-center">Add Role </h5>
                <div class="card-body">


                    <div class="form-layout">
                        <form method="POST" action="{{ route('role.store') }}" >
                            @csrf

                            <div class="row mg-b-25">
                                <div class="col-lg-10 m-auto">
                                    <div class="form-group">
                                        <label class="form-control-label">Role Name<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" >
                                        @error('name')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-12 -->
                                
                            </div><!-- row -->

                            <div class="row mg-b-25">
                                <div class="col-lg-10 m-auto">
                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-success mg-r-5 m-auto">Add New Role</button>
                            </div>
                            </div>
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