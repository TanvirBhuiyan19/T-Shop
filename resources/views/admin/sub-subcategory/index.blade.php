@extends('layouts.adminMaster')

@section('category') active show-sub @endsection
@section('sub-subcategory') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Sub-subCategory | {{$settings->site_name}} @else Sub-subCategory | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Sub-subCategory</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Sub-subCategorie Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['subsubcat']['list'] )
        <div class="col-lg-8 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Sub-subCategories List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive wrap">
                            <thead class="text-right">
                                <tr>
                                    <th class="wd-20p text-center">Cat. Name</th>
                                    <th class="wd-20p text-center">Subcat. Name</th>
                                    <th class="wd-23p text-center">SubSubcat. En</th>
                                    <th class="wd-22p text-center">SubSubcat. Bn</th>
                                    <th class="wd-15p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subsubcategories as $data)
                                <tr class="text-center">
                                    <td>{{$data->category->category_name_en}}</td>
                                    <td>{{$data->subcategory->subcategory_name_en}}</td>
                                    <td>{{$data->sub_subcategory_name_en}}</td>
                                    <td>{{$data->sub_subcategory_name_bn}}</td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['subsubcat']['edit'] )
                                            <a href="{{route('sub-subcategory.edit',$data->id)}}" style="padding-right:5px" title="Edit"><i class="fa fa-edit text-success"></i></a>
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['subsubcat']['delete'] )
                                            <a href="{{route('sub-subcategory.delete',$data->id)}}" id="delete"><i class="fa fa-trash text-danger" title="Delete"></i></a>
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
        <!--<!------------------------ End Sub-subCategorie Data Table ----------------------------------------------->       

        <!--<!------------------------ Sub-subCategorie Input Form ------------------------------------------------->
    @isset(auth()->user()->role->permission['permission']['subsubcat']['add'] )
        <div class="col-lg-4 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Create a New Sub-subCategory</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('sub-subcategory.create') }}" >
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
                                <label class="form-control-label"><strong>Subcategory Name: </strong><span class="tx-danger">*</span></label>
                                <select name="subcategory_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    
                                </select>

                                @error('subcategory_id')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Sub-subCategory Name in English: </strong><span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="sub_subcategory_name_en" value="{{ old('sub_subcategory_name_en') }}">
                                @error('sub_subcategory_name_en')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Sub-subCategory Name in Bangla: </strong><span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="sub_subcategory_name_bn" value="{{ old('sub_subcategory_name_bn') }}">
                                @error('sub_subcategory_name_bn')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-10">
                            <button class="btn btn-success btn-block">Create Sub-subCategory</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-4 -->
    @endisset
        <!--<!------------------------ End Sub-subCategorie Input Form ----------------------------------------------> 


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