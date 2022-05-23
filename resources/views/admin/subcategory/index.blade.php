@extends('layouts.adminMaster')

@section('category') active show-sub @endsection
@section('subcategory') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Subcategories | {{$settings->site_name}} @else Subcategories | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Subcategories</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Subcategory Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['subcat']['list'] )
        <div class="col-lg-8 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Subcategories List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive wrap">
                            <thead class="text-right">
                                <tr>
                                    <th class="wd-25p text-center">Cat. Name</th>
                                    <th class="wd-30p text-center">Subcat. Name En</th>
                                    <th class="wd-30p text-center">Subcat. Name Bn</th>
                                    <th class="wd-15p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subcategories as $subcategory)
                                <tr class="text-center">
                                    <td>{{$subcategory->category->category_name_en}}</td>
                                    <td>{{$subcategory->subcategory_name_en}}</td>
                                    <td>{{$subcategory->subcategory_name_bn}}</td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['subcat']['edit'] )
                                            <a href="{{route('subcategory.edit',$subcategory->id)}}" style="padding-right:5px" title="Edit"><i class="fa fa-edit text-success"></i></a>
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['subcat']['delete'] )
                                            <a href="{{route('subcategory.delete',$subcategory->id)}}" id="delete"><i class="fa fa-trash text-danger" title="Delete"></i></a>
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
        <!--<!------------------------ End Subcategory Data Table ----------------------------------------------->       

        <!--<!------------------------ Subcategory Input Form ------------------------------------------------->
    @isset(auth()->user()->role->permission['permission']['subcat']['add'] )
        <div class="col-lg-4 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Create a New Subcategory</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('subcategory.create') }}" >
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Category Name: </strong><span class="tx-danger">*</span></label>
                                <select name="category_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{ucwords($category->category_name_en)}}</option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Sub-Category Name in English: </strong><span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="subcategory_name_en" value="{{ old('subcategory_name_en') }}">
                                @error('subcategory_name_en')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Sub-Category Name in Bangla: </strong><span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="subcategory_name_bn" value="{{ old('subcategory_name_bn') }}">
                                @error('subcategory_name_bn')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-10">
                            <button class="btn btn-success btn-block">Create Subcategory</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-4 -->
    @endisset
        <!--<!------------------------ End Subcategory Input Form ----------------------------------------------> 


    </div><!-- row -->
    <br><br>
</div>>


@endsection