@extends('layouts.adminMaster')

@section('roles') active show-sub @endsection
@section('role.index') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Roles | {{$settings->site_name}} @else Roles | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Roles</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ role Data Table ----------------------------------------------->         
    @isset(auth()->user()->role->permission['permission']['role']['list'] )
        <div class="col-lg-10 col-md-10 col-sm-10 m-auto" >
            <div class="card ">
                <h6 class="card-header text-center">Roles List</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive wrap">
                            <thead>
                                <tr>
                                    <th class="wd-20p text-center">SL</th>
                                    <th class="wd-50p text-center">Role Name</th>
                                    <th class="wd-30p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $item)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                     <td>
                                         @if($item->id != 1)
                                        <h4 class="row" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['role']['edit'] )
                                                <a href="{{route('role.edit',$item->id)}}" style="padding-right:5px" title="Edit"><i class="fa fa-edit text-success"></i></a>
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['role']['delete'] )
                                                <form action="{{ route('role.destroy',$item->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button style="border: none; cursor: pointer"><i id="delete" class="fa fa-trash text-danger" title="Delete"></i></button>
                                                </form>
                                            @endisset
                                        </h4>
                                         @endif
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
        <!--<!------------------------ End role Data Table ----------------------------------------------->       

    </div><!-- row -->
    <br><br>
</div>>

@endsection