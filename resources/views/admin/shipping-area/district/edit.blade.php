@extends('layouts.adminMaster')

@section('shipping') active show-sub @endsection
@section('district') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit District | {{$settings->site_name}} @else Edit District | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('district')}}">Districts</a>
    <span class="breadcrumb-item active">Edit District</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">    

        <!--<!------------------------ District Edit Form ------------------------------------------------->
        <div class="col-lg-6 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Edit District</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('district.update') }}" >
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Division Name: </strong><span class="tx-danger">*</span></label>
                                <select name="division_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    @foreach($divisions as $data)
                                    <option value="{{$data->id}}" {{ $data->id == $district->division_id ? 'selected':'' }} > {{ucwords($data->division_name_en)}} </option>
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
                                <label class="form-control-label"><strong>District Name in English: </strong><span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="district_name_en" value="{{ $district->district_name_en }}">
                                @error('district_name_en')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>District Name in Bangla: </strong><span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="district_name_bn" value="{{ $district->district_name_bn }}">
                                @error('district_name_bn')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-10">
                            <input type="hidden" name="district_id" value="{{ $district->id }}">
                            <button class="btn btn-success btn-block">Update District</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-6 -->
        <!--<!------------------------ End: District Edit Form ----------------------------------------------> 


    </div><!-- row -->
    <br><br>
</div>>


@endsection