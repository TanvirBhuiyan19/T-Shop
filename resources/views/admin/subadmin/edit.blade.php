@extends('layouts.adminMaster')

@section('subadmins') active show-sub @endsection
@section('subadmin.index') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit Subadmin | {{$settings->site_name}} @else Edit Subadmin | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('subadmin.index')}}">Subadmins</a>
    <span class="breadcrumb-item active">Edit Subadmin</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Subadmin Update ----------------------------------------------->         
        <div class="col-lg-10 col-md-10col-sm-12 m-auto" >
            <div class="card ">
                <h5 class="card-header text-center">Edit Subadmin </h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('subadmin.update',$user->id) }}"  enctype="multipart/form-data" >
                        @csrf
                        @method('put')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<span class="tx-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<span class="tx-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Role Name') }}<span class="tx-danger">*</span></label>

                            <div class="col-md-6">
                                <select name="role_id" style="padding: 5px">
                                    <option disabled selected >Select a Role</option>
                                    @foreach($roles as $item)
                                    <option value="{{$item->id}}" {{ ($item->id == $user->role_id) ? 'selected' : '' }} >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                                @error('role_id')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div><!-- card -->
        </div>
        <!--<!------------------------ End Brand Data Table ----------------------------------------------->                

    </div><!-- row -->
    <br><br>
</div>>

@endsection