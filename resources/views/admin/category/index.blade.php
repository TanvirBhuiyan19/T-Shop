@extends('layouts.adminMaster')

@section('category') active show-sub @endsection
@section('category-page') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Categories | {{$settings->site_name}} @else Categories | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Categories</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Category Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['cat']['list'] )
        <div class="col-lg-8 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Categories List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead class="text-right">
                                <tr>
                                    <th class="wd-25p text-center">Icon</th>
                                    <th class="wd-30p text-center">Category Name En</th>
                                    <th class="wd-30p text-center">Category Name Bn</th>
                                    <th class="wd-15p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $data)
                                <tr class="text-center">
                                    <td><span><i class="fa {{$data->category_icon}}"></i></span></td>
                                    <td>{{$data->category_name_en}}</td>
                                    <td>{{$data->category_name_bn}}</td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['cat']['edit'] )
                                            <a href="{{route('category.edit',$data->id)}}" style="padding-right:5px" title="Edit"><i class="fa fa-edit text-success"></i></a>
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['cat']['delete'] )
                                            <a href="{{route('category.delete',$data->id)}}" id="delete"><i class="fa fa-trash text-danger" title="Delete"></i></a>
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
        <!--<!------------------------ End Category Data Table ----------------------------------------------->       

        <!--<!------------------------ Category Input Form ------------------------------------------------->
    @isset(auth()->user()->role->permission['permission']['cat']['add'] )
        <div class="col-lg-4 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Create a New Category</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('category.create') }}" >
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Category Name in English: </strong><span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="category_name_en" value="{{ old('category_name_en') }}">
                                @error('category_name_en')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Category Name in Bangla: </strong><span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="category_name_bn" value="{{ old('category_name_bn') }}">
                                @error('category_name_bn')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Category Icon: </strong><span class="text-danger">*</span> (Example: fa-diamond, fa-heart, fa-laptop, fa-futbol-o, fa-envira, fa-envelope, etc.)</label>
                                <input class="form-control" type="text" name="category_icon" value="{{ old('category_icon') }}">
                                @error('category_icon')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-10">
                            <button class="btn btn-success btn-block">Create Category</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-6 -->
    @endisset
        <!--<!------------------------ End Category Input Form ----------------------------------------------> 


    </div><!-- row -->
    <br><br>
</div>>


@endsection