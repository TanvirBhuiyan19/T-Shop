@extends('layouts.adminMaster')

@section('category') active show-sub @endsection
@section('subcategory') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit SubCategory | {{$settings->site_name}} @else Edit SubCategory | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('subcategory')}}">SubCategory</a>
    <span class="breadcrumb-item active">Edit SubCategory</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Category Data Table ----------------------------------------------->         
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card ">
                <h5 class="card-header text-center">Edit SubCategory </h5>
                <div class="card-body">


                    <div class="form-layout">
                        <form method="POST" action="{{ route('subcategory.update') }}">
                            @csrf

                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Category Name: </strong><span class="tx-danger">*</span></label>
                                        <select name="category_id" class="form-control select2-show-search" >
                                            <option value="{{$subcategory->category_id}}" selected>{{$subcategory->category->category_name_en}}</option>
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
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Sub-Category Name in English: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="subcategory_name_en" value="{{$subcategory->subcategory_name_en}}">
                                        @error('subcategory_name_en')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Sub-Category Name in Bangla: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="subcategory_name_bn" value="{{$subcategory->subcategory_name_bn}}">
                                        <input class="form-control" type="hidden" name="subcategory_id" value="{{$subcategory->id}}">
                                        @error('subcategory_name_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-success mg-r-5">Update Information</button>
                                <a href="{{route('subcategory')}}" class="btn btn-secondary">Cancel</a>
                            </div><!-- form-layout-footer -->
                        </form>
                    </div><!-- form-layout -->

                </div><!-- card body -->
            </div><!-- card -->
        </div>
        <!--<!------------------------ End Category Data Table ----------------------------------------------->                

    </div><!-- row -->
    <br><br>
</div>>

@endsection