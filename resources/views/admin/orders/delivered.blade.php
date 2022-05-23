@extends('layouts.adminMaster')

@section('orders') active show-sub @endsection
@section('delivered-orders') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Delivered Orders | {{$settings->site_name}} @else Delivered Orders | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Delivered Orders</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Coupon Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['order']['list'] )
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card ">
                <h6 class="card-header text-center">Delivered Orders List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive wrap">
                            <thead>
                                <tr>
                                    <th class="wd-25p text-center">Date</th>
                                    <th class="wd-15p text-center">Invoice No.</th>
                                    <th class="wd-10p text-center">Amount</th>
                                    <th class="wd-25p text-center">Trans. ID</th>
                                    <th class="wd-10p text-center">Status</th>
                                    <th class="wd-15p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $data)
                                <tr class="text-center">
                                    <td>{{ $data->order_date }}</td>
                                    <td>{{ $data->invoice_no }}</td>
                                    <td>{{ $data->amount }}Tk</td>
                                    <td>{{ $data->transaction_id }}</td>
                                    <td><strong class="badge badge-pill badge-info" style="padding: 5px 10px;">{{ $data->status }}</strong></td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['order']['view'] )
                                                <a href="{{url('admin/order/view/'.$data->id)}}" style="padding-right:5px" title="View"><i class="fa fa-eye text-info"></i></a>
                                                <a href="{{url('/admin/invoice-download/'.$data->id)}}"><i class="fa fa-download" style="color: #59B210" title="Download"></i></a>
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
        <!--<!------------------------ End Coupon Data Table ----------------------------------------------->       

    </div><!-- row -->
    <br><br>
</div>>

@endsection