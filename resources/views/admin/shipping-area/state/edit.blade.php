@extends('layouts.adminMaster')

@section('shipping') active show-sub @endsection
@section('state') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit State | {{$settings->site_name}} @else Edit State | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('state')}}">States</a>
    <span class="breadcrumb-item active">Edit State</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        
        <!--<!------------------------ State Edit Form ------------------------------------------------->
        <div class="col-lg-6 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Edit State</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('state.update') }}" >
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Division Name: </strong><span class="tx-danger">*</span></label>
                                <select name="division_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    @foreach($divisions as $data)
                                    <option value="{{$data->id}}" {{$data->id == $state->division_id ? 'selected':'' }} >{{ucwords($data->division_name_en)}}</option>
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
                                    <option value="{{$state->district_id}}" selected>{{$state->district->district_name_en}}</option>
                                    
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
                                <input class="form-control" type="text" name="state_name_en" value="{{ $state->state_name_en }}">
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
                                <input class="form-control" type="text" name="state_name_bn" value="{{ $state->state_name_bn }}">
                                @error('state_name_bn')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-10">
                            <input type="hidden" name="state_id" value="{{$state->id}}">
                            <button class="btn btn-success btn-block">Update State</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-6 -->
        <!--<!------------------------ End: State Edit Form ----------------------------------------------> 


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