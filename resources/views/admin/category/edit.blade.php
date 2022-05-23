@extends('layouts.adminMaster')

@section('category') active show-sub @endsection
@section('category-page') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit Category | {{$settings->site_name}} @else Edit Category | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('category')}}">Category</a>
    <span class="breadcrumb-item active">Edit Category</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Category Data Table ----------------------------------------------->         
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card ">
                <h5 class="card-header text-center">Edit Category </h5>
                <div class="card-body">


                    <div class="form-layout">
                        <form method="POST" action="{{ route('category.update') }}">
                            @csrf

                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Category Name in English <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="category_name_en" value="{{$category->category_name_en}}">
                                        @error('category_name_en')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Category Name in Bangla <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="category_name_bn" value="{{$category->category_name_bn}}">
                                        @error('category_name_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Category Icon  <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="category_icon" value="{{$category->category_icon}}">
                                        <input class="form-control" type="hidden" name="category_id" value="{{$category->id}}">
                                        @error('category_icon')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-success mg-r-5">Update Category</button>
                                <a href="{{route('category')}}" class="btn btn-secondary">Cancel</a>
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