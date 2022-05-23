@extends('layouts.adminMaster')

@section('reports')
active
@endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) View Reports | {{$settings->site_name}} @else View Reports | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Reports</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card">
                <h6 class="card-header text-center">Report of @if($formatDate != '') Date: {{$formatDate}} @elseif($month_name != '') Month: {{$month_name}} {{$year_name}} @elseif($year_name != '') Year: {{$year_name}} @endif </h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p text-center">Date</th>
                                    <th class="wd-15p text-center">Invoice</th>
                                    <th class="wd-20p text-center">Amount</th>
                                    <th class="wd-25p text-center">TNX Id</th>
                                    <th class="wd-10p text-center">Status</th>
                                    <th class="wd-15p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr class="text-center">
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->invoice_no }}</td>
                                    <td>{{ $order->amount }}Tk</td>
                                    <td>{{ $order->transaction_id }}</td>
                                    <td>
                                        @if($order->status == 'Pending')
                                        <strong class="badge badge-pill badge-warning" style="padding: 5px">{{ $order->status }}</strong>
                                        @elseif($order->status == 'Cancel')
                                        <strong class="badge badge-pill badge-danger" style="padding: 5px">{{ $order->status }}</strong>
                                        @elseif($order->status == 'Delivered')
                                        <strong class="badge badge-pill badge-info" style="padding: 5px">{{ $order->status }}</strong>
                                        @else
                                        <strong class="badge badge-pill badge-success" style="padding: 5px">{{ $order->status }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            <a href="{{url('admin/order/view/'.$order->id)}}" style="padding-right:8px" title="View"><i class="fa fa-eye text-info"></i></a>
                                            <a href="{{url('/admin/invoice-download/'.$order->id)}}"><i class="fa fa-download" style="color: #59B210" title="Download"></i></a>
                                        </h4>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                </div>
            </div><!-- card -->
        </div>
    </div>
</div>


@endsection