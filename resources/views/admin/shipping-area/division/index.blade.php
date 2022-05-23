@extends('layouts.adminMaster')

@section('shipping') active show-sub @endsection
@section('division') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Divisions | {{$settings->site_name}} @else Divisions | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Divisions</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Division Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['shipping']['list'] )
        <div class="col-lg-8 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Divisions List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead class="text-right">
                                <tr>
                                    <th class="wd-40p text-center">Division Name En</th>
                                    <th class="wd-40p text-center">Division Name Bn</th>
                                    <th class="wd-20p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($divisions as $data)
                                <tr class="text-center">
                                    <td>{{$data->division_name_en}}</td>
                                    <td>{{$data->division_name_bn}}</td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['shipping']['edit'] )
                                                <a href="{{route('division.edit',$data->id)}}" style="padding-right:5px" title="Edit"><i class="fa fa-edit text-success"></i></a>
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['shipping']['delete'] )
                                                <a href="{{route('division.delete',$data->id)}}" id="delete"><i class="fa fa-trash text-danger" title="Delete"></i></a>
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
        <!--<!------------------------ End: Division Data Table ----------------------------------------------->       

        <!--<!------------------------ Division Input Form ------------------------------------------------->
    @isset(auth()->user()->role->permission['permission']['shipping']['add'] )     
        <div class="col-lg-4 col-md-12 col-sm-12 ml-auto mr-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Create a New Division</h6>
                <div class="card-body">
                    <form method="POST" action="{{ route('division.create') }}" >
                        @csrf

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Division Name in English: </strong><span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="division_name_en" value="{{ old('division_name_en') }}">
                                @error('division_name_en')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                <label class="form-control-label"><strong>Division Name in Bangla: </strong><span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="division_name_bn" value="{{ old('division_name_bn') }}">
                                @error('division_name_bn')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-10">
                            <button class="btn btn-success btn-block">Create Division</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- card body -->
                <br><br>
            </div><!-- card -->
        </div><!-- col-4 -->
    @endisset
        <!--<!------------------------ End: Division Input Form ----------------------------------------------> 

    </div><!-- row -->
    <br><br>
</div>>


@endsection