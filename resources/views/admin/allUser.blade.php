@extends('layouts.adminMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) All Users | {{$settings->site_name}} @else All Users | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">All Users</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        @isset(auth()->user()->role->permission['permission']['alluser']['list'] )
            <div class="col-md-12">
                <div class="card">
                    <h6 class="card-header text-center">All Users List </h6>
                    <div class="card-body">
                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th class="wd-10p text-center">Image</th>
                                        <th class="wd-15p text-center">Name</th>
                                        <th class="wd-20p text-center">Phone</th>
                                        <th class="wd-25p text-center">Email</th>
                                        <th class="wd-10p text-center">Status</th>
                                        <th class="wd-10p text-center">User</th>
                                        <th class="wd-10p text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $data)
                                    <tr class="text-center">
                                        <td style="padding: 5px 0px;">
                                            <img src="{{ asset('frontend/assets/images/users/'.$data->image) }}" width="60" style="border-radius: 50px" alt="User Image">
                                        </td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>
                                            @if($data->userIsOnline())
                                            <strong class="badge badge-pill badge-success" style="padding: 5px">Active now</strong>
                                            @else
                                            <strong class="badge badge-pill badge-secondary" style="padding: 5px">{{ Carbon\Carbon::parse($data->last_seen)->diffForHumans() }}</strong>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->isban == 0)
                                            <strong class="badge badge-pill badge-primary" style="padding: 5px">Unbanned</strong>
                                            @else
                                            <strong class="badge badge-pill badge-danger" style="padding: 5px">Banned</strong>
                                            @endif
                                        </td>
                                        <td>
                                            @isset(auth()->user()->role->permission['permission']['alluser']['delete'] )
                                                <h4 class="row" style="justify-content: center;">
                                                    @if($data->isban == 0)
                                                    <a href="{{url('/admin/user-banned/'.$data->id)}}"><i class="fa fa-lock" style="color: red" title="Bann This User"></i></a>
                                                    @else
                                                    <a href="{{url('/admin/user-unbanned/'.$data->id)}}"><i class="fa fa-unlock" style="color: #59B210" title="Unbann This User"></i></a>
                                                    @endif
                                                </h4>
                                            @endisset
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                    </div>
                </div><!-- card -->
            </div>
        @endisset
    </div>
</div>


</div>
@endsection