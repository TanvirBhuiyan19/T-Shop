@extends('layouts.adminMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Admin Profile | {{$settings->site_name}} @else Admin Profile | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Admin Profile</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" style="margin: 0 auto; display: block;">
            <div class="card pd-20 bg-white">
                <img src="{{ asset('admin/img/admins/') }}/{{Auth::user()->image}}" alt="Admin Photo" style="width: 150px; height: 150px; border-radius: 7%; display: block; margin: 0 auto;" >
                <br>
                <h3 style="font-size:28px;" class="text-center text-capitalize text-success">{{ Auth::user()->name }}</h3>

                <div class="list-group text-black" role="tablist">
                    <a href="#info" class="list-group-item list-group-item-action active" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-user"></i>  Basic Information</h5></a>
                    <a href="#address" class="list-group-item list-group-item-action" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-home"></i> Address</h5></a>
                    <a href="#password" class="list-group-item list-group-item-action" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-key"></i> Change Password</h5></a>
                    <a href="#changephoto" class="list-group-item list-group-item-action" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-photo"></i>  Change Profile Photo</h5></a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" 
                       class="list-group-item" style="color: red;">
                        <h5 style="font-size:16px;"><i class="icon fa fa-power-off"></i> Logout</h5></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <br>
            </div>
        </div>


        <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7" style="margin: 0 auto; display: block;">

            <div class="card pd-20 pd-sm-40" style=" height: 522px;">
                <div class="tab-content">

                    <!----------------------------------------- Change Information Section ------------------------------->                      
                    <div class="tab-pane active" id="info">

                        <div class="row">
                            <div class="col-md-10 col-sm-6"><h4 class="text-center">Basic Information</h4></div>
                            <div class="col-md-2 col-sm-6 text-center">
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal"  data-target="#exampleModal">Edit</button>
                            </div>
                        </div>
                        <hr><br>
                        <table class="table table-striped bg-light">
                            <thead>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>Name</td>
                                    <td>{{Auth::user()->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>
                                        @if(Auth::user()->email)
                                        {{Auth::user()->email}}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>
                                        @if(Auth::user()->phone)
                                        {{Auth::user()->phone}}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>
                                        @if(Auth::user()->gender)
                                        {{Auth::user()->gender}}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Birth Date</td>
                                    <td>
                                        @if(Auth::user()->dob)
                                        {{ date('d F Y', strtotime(Auth::user()->dob)) }}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-------------------------------------------- End Change Information Section ------------------------------->                     


                    <div class="tab-pane" id="address" >
                        <p style="font-size:20px;" class="text-center text-capitalize text-black">Address</p>
                        <hr>
                    </div>


                    <!-------------------------------------------- Change Password Section ------------------------------->                    
                    <div class="tab-pane" id="password" >
                        <p style="font-size:20px;" class="text-center text-capitalize text-black">Change Password</p>
                        <hr>
                        <div class="row row-sm mg-t-20">
                            <div class="col-xl-12">
                                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">

                                    <form method="POST" action="{{ route('adminPass.change') }}">
                                        @csrf
                                        <div class="row">
                                            <label for="password" class="col-lg-4 col-md-12 col-sm-12 form-control-label">{{ __('Old Password :') }} <span class="tx-danger">*</span></label>
                                            <div class="col-lg-8 col-md-12 col-sm-12  mg-t-10 mg-sm-t-0">
                                                <input id="password" type="password" placeholder="Enter Old Password" class="form-control @error('email') is-invalid @enderror" name="oldpass" required>
                                                @error('oldpass')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <label for="password" class="col-lg-4 col-md-12 col-sm-12 form-control-label">{{ __('New Password :') }} <span class="tx-danger">*</span></label>
                                            <div class="col-lg-8 col-md-12 col-sm-12  mg-t-10 mg-sm-t-0">
                                                <input id="password" type="password" placeholder="Enter New Password" class="form-control @error('email') is-invalid @enderror" name="newpass" required>
                                                @error('newpass')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <label for="password-confirm" class="col-lg-4 col-md-12 col-sm-12 form-control-label">{{ __('Confirm Password :') }} <span class="tx-danger">*</span></label>
                                            <div class="col-lg-8 col-md-12 col-sm-12 mg-t-10 mg-sm-t-0">
                                                <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="newpass_confirm" required>
                                                @error('newpass_confirm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4 col-md-0 col-sm-0"></div>
                                            <div class="col-lg-8 col-md-12 col-sm-12 form-layout-footer mg-t-30">
                                                <button type="submit" class="btn btn-success mg-r-5">{{ __('Change Password') }}</button>
                                            </div>
                                        </div>
                                    </form>	

                                </div>
                            </div>
                        </div>


                    </div>
                    <!-------------------------------------------- End Change Password Section ------------------------------->  


                    <!-------------------------------------------- Change Admin Profile Picture ------------------------------->  
                    <div class="tab-pane" id="changephoto" >
                        <p style="font-size:20px;" class="text-center text-capitalize text-black">Change Admin Profile Picture</p>
                        <hr>
                        <div class="row row-sm mg-t-20">
                            <div class="col-xl-12">
                                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">

                                    <form method="POST" action="{{ route('adminImage.change') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <label for="image" class="col-lg-4 col-md-12 col-sm-12 form-control-label">{{ __('Upload New Image :') }} <span class="tx-danger">*</span></label>
                                            <div class="col-lg-8 col-md-12 col-sm-12  mg-t-10 mg-sm-t-0">
                                                <input type="file" class="form-control" name="image" accept=".png,.jpg,.jpeg" required>
                                                @error('change_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-0 col-sm-0"></div>
                                            <div class="col-lg-8 col-md-12 col-sm-12 form-layout-footer mg-t-30">
                                                <button type="submit" class="btn btn-success mg-r-5">{{ __('Change Image') }}</button>
                                            </div>
                                        </div>
                                    </form>	

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-------------------------------------------- End Change Admin Profile Picture ------------------------------->                      

                </div>

            </div>
        </div>

    </div>
    <br><br>
</div>






<!-------------------------------------------- Modal --------------------------->
<div class="pd-y-50 bg-gray-600">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content bd-0">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <h6 class="tx-14 mg-b-0 text-left tx-bold">Edit Admin Basic Information  </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-25">
                    <form method="POST" action="{{ route('adminInfo.change') }}" >
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name" class=" col-form-label">{{ __('Name') }}</label>
                            </div>   
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="email" class=" col-form-label">{{ __('Email') }}</label>
                            </div>   
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="phone" class=" col-form-label">{{ __('Phone') }}</label>
                            </div>   
                            <div class="col-md-8">
                                <input type="number" class="form-control" name="phone" value="{{Auth::user()->phone}}" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="gender" class=" col-form-label">{{ __('Gender') }}</label>
                            </div>   
                            <div class="col-md-8">
                                <select id="gender" name="gender" class="block">

                                    <option value="" disabled selected>Select Gender</option>
                                    @if(Auth::user()->gender == 'male')
                                    <option value="male" selected>Male</option>
                                    @else
                                    <option value="male">Male</option>
                                    @endif
                                    @if(Auth::user()->gender == 'female')
                                    <option value="female" selected>Female</option>
                                    @else
                                    <option value="female">Female</option>
                                    @endif
                                    @if(Auth::user()->gender == 'others')
                                    <option value="others" selected>Others</option>
                                    @else
                                    <option value="others">Others</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="dob" class=" col-form-label">{{ __('Birth Date') }}</label>
                            </div>   
                            <div class="col-md-8">
                                <input type="date" name="dob" 
                                       placeholder="dd-mm-yyyy" @if(Auth::user()->dob != '') value="{{Auth::user()->dob}}" @endif
                                min="1907-01-01" max="2030-12-31">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">{{ __('Save changes') }}</button>
                </div>

                </form>	
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------- End Modal --------------------------->




@endsection