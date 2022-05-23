@extends('layouts.adminMaster')

@section('reviews') active show-sub @endsection
@section('approved-reviews') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Approved Reviews | {{$settings->site_name}} @else Approved Reviews | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Approved Reviews</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Approved Reviews Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['review']['list'] )
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card ">
                <h6 class="card-header text-center">Approved Reviews List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive wrap">
                            <thead>
                                <tr>
                                    <th class="wd-10p text-center">Image</th>
                                    <th class="wd-20p text-center">Product Name</th>
                                    <th class="wd-15p text-center">User Name</th>
                                    <th class="wd-15p text-center">Date</th>
                                    <th class="wd-25p text-center">Comment</th>
                                    <th class="wd-5p text-center">Rating</th>
                                    <th class="wd-10p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($approvedReviews as $data)
                                <tr class="text-center">
                                    <td style="padding-left: 0px; padding-right: 0px;"><img src="{{ asset('uploads/product/thumbnail/') }}/{{$data->product->product_thumbnail}}" alt="" style="width: 60px;"></td>
                                    <td style="padding-left: 0px; padding-right: 0px;">{{$data->product->product_name_en}}</td>
                                    <td>{{$data->user->name}}</td>
                                    <td>{{date_format($data->updated_at, 'd F Y') }}</td>
                                    <td style="padding-left: 0px; padding-right: 0px;">{{$data->comment}}</td>
                                    <td>{{$data->rating}}</td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['review']['delete'] )
                                                <a href="{{url('admin/review/delete/'.$data->id)}}" id="delete"><i class="fa fa-trash text-danger" title="Delete"></i></a>
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
        <!--<!------------------------ End: Approved Reviews Data Table ----------------------------------------------->       

    </div><!-- row -->
    <br><br>
</div>

@endsection