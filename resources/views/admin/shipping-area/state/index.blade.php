@extends('layouts.adminMaster')

@section('shipping') active show-sub @endsection
@section('state') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) States | {{$settings->site_name}} @else States | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">States</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ State Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['shipping']['list'] )
        <div class="col-lg-8 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">State List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive wrap">
                            <thead class="text-right">
                                <tr>
                                    <th class="wd-20p text-center">Division Name</th>
                                    <th class="wd-20p text-center">District Name</th>
                                    <th class="wd-23p text-center">State En</th>
                                    <th class="wd-22p text-center">State Bn</th>
                                    <th class="wd-15p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($states as $data)
                                <tr class="text-center">
                                    <td>{{$data->division->division_name_en}}</td>
                                    <td>{{$data->district->district_name_en}}</td>
                                    <td>{{$data->state_name_en}}</td>
                                    <td>{{$data->state_name_bn}}</td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['shipping']['edit'] )
                                                <a href="{{route('state.edit',$data->id)}}" style="padding-right:5px" title="Edit"><i class="fa fa-edit text-success"></i></a>
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['shipping']['delete'] )
                                                <a href="{{route('state.delete',$data->id)}}" id="delete"><i class="fa fa-trash text-danger" title="Delete"></i></a>
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
        <!--<!------------------------ End State Data Table ----------------------------------------------->       

        <!--<!------------------------ State Input Form ------------------------------------------------->
    @isset(auth()->user()->role->permission['permission']['shipping']['add'] )
        <div class="col-lg-4 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Create a New State</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('state.create') }}" >
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Division Name: </strong><span class="tx-danger">*</span></label>
                                <select name="division_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    @foreach($divisions as $data)
                                    <option value="{{$data->id}}">{{ucwords($data->division_name_en)}}</option>
                                    @endforeach
                                </select>

                                @error('division_id')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>District Name: </strong><span class="tx-danger">*</span></label>
                                <select name="district_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    
                                </select>

                                @error('district_id')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>State Name in English: </strong><span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="state_name_en" value="{{ old('state_name_en') }}">
                                @error('state_name_en')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>State Name in Bangla: </strong><span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="state_name_bn" value="{{ old('state_name_bn') }}">
                                @error('state_name_bn')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-10">
                            <button class="btn btn-success btn-block">Create State</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-4 -->
    @endisset
        <!--<!------------------------ End State Input Form ----------------------------------------------> 


    </div><!-- row -->
    <br><br>
</div>>







<!--================================ Dependent District Dropdown =================================================-->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
$(document).ready(function(){
    $('select[name="division_id"]').on('change', function(){
    var division_id = $(this).val();
    if(division_id){
        $.ajax({
            url: "{{ url('/admin/district/ajax')}}/"+division_id,
            type: "GET",
            dataType: "json",
            success:function(data){
              var d = $('select[name="district_id"]').empty();  
              $.each(data, function(key, value){
                  $('select[name="district_id"]').append('<option value="'+value.id+'">' + value.district_name_en + '</option>' );
              });
            },
        });
    }else{
        alert('danger');
    }
});

});

</script>
<!--================================ End: Dependent District Dropdown =================================================-->






@endsection