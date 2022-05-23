@extends('layouts.adminMaster')

@section('subadmins') active show-sub @endsection
@section('subadmin.index') active @endsection

@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">{{ config('app.name') }}</a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Subadmins</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ subadmin Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['subadmin']['list'] ) 
        <div class="col-lg-12 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Subadmins List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive wrap">
                            <thead>
                                <tr>
                                    <th class="wd-10p text-center">Image</th>
                                    <th class="wd-20p text-center">User Name</th>
                                    <th class="wd-15p text-center">Role Name</th>
                                    <th class="wd-25p text-center">Email</th>
                                    <th class="wd-15p text-center">Status</th>
                                    <th class="wd-15p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item)
                                <tr class="text-center">
                                    <td>
                                        <img src="{{ asset('admin/img/admins/'.$item->image) }}" width="60" style="border-radius: 50px" alt="Subadmin Image">
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->role->name}}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if($item->userIsOnline())
                                        <strong class="badge badge-pill badge-success" style="padding: 5px">Active now</strong>
                                        @else
                                        <strong class="badge badge-pill badge-secondary" style="padding: 5px">{{ Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['subadmin']['edit'] ) 
                                                <a href="{{route('subadmin.edit',$item->id)}}" style="padding-right:5px" title="Edit"><i class="fa fa-edit text-success"></i></a>
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['subadmin']['delete'] ) 
                                                <form action="{{ route('subadmin.destroy',$item->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button style="border: none; cursor: pointer"><i id="delete" class="fa fa-trash text-danger" title="Delete"></i></button>
                                                </form>
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
        <!--<!------------------------ End subadmin Data Table ----------------------------------------------->       

    </div><!-- row -->
    <br><br>
</div>>

@endsection