@extends('layouts.adminMaster')

@section('category') active show-sub @endsection
@section('sub-subcategory') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit Sub-subCategory | {{$settings->site_name}} @else Edit Sub-subCategory | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Edit Sub-subCategory</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Category Data Table ----------------------------------------------->         
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card ">
                <h5 class="card-header text-center">Edit Sub-subCategory </h5>
                <div class="card-body">


                    <div class="form-layout">
                        <form method="POST" action="{{ route('sub-subcategory.update') }}">
                            @csrf

                            <div class="row mg-b-25">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Category Name: </strong><span class="tx-danger">*</span></label>
                                        <select name="category_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                            <option value="{{$subsubcategory->category_id}}" selected>{{$subsubcategory->category->category_name_en}}</option>
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
                                </div><!-- col-3 -->

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Subcategory Name: </strong><span class="tx-danger">*</span></label>
                                        <select name="subcategory_id" class="form-control select2-show-search" data-placeholder="Choose one">
<!--                                            <option label="Choose one"></option>-->
                                             <option value="{{$subsubcategory->subcategory_id}}" selected>{{$subsubcategory->subcategory->subcategory_name_en}}</option>
                                            
                                        </select>

                                        @error('subcategory_id')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-3 -->

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Sub-subCategory Name in English: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="sub_subcategory_name_en" value="{{ $subsubcategory->sub_subcategory_name_en }}">
                                        <input class="form-control" type="hidden" name="sub_subcategory_id" value="{{ $subsubcategory->id }}">
                                        
                                        @error('sub_subcategory_name_en')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-3 -->

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Sub-subCategory Name in Bangla: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="sub_subcategory_name_bn" value="{{ $subsubcategory->sub_subcategory_name_bn }}">
                                        @error('sub_subcategory_name_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-3 -->

                            </div><!-- row -->

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-success mg-r-5">Update Sub-subCategory</button>
                                <a href="{{route('sub-subcategory')}}" class="btn btn-secondary">Cancel</a>
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







<!--================================ Dependent SubCategory Dropdown =================================================-->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
$(document).ready(function(){
    $('select[name="category_id"]').on('change', function(){
    var category_id = $(this).val();
    if(category_id){
        $.ajax({
            url: "{{ url('/admin/subcategory/ajax')}}/"+category_id,
            type: "GET",
            dataType: "json",
            success:function(data){
              var d = $('select[name="subcategory_id"]').empty();  
              $.each(data, function(key, value){
                  $('select[name="subcategory_id"]').append('<option value="'+value.id+'">' + value.subcategory_name_en + '</option>' );
              });
            },
        });
    }else{
        alert('danger');
    }
});
});

</script>
<!--================================ End: Dependent SubCategory Dropdown =================================================-->




@endsection