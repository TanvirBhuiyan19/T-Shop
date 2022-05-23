@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if(session()->get('language') == 'bangla') ইউজার ড্যাশবোর্ড @else User Dashboard @endif 
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection



@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'bangla')
                <li><a href="{{url('/')}}">হোম</a></li>
                <li class='active'>ড্যাশবোর্ড</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>Dashboard</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<style>
    .my-custom-scrollbar {
        position: relative;
        height: 580px;
        overflow: auto;
    }
    .table-wrapper-scroll-y {
        display: block;
    }
</style>

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="sign-in-page">
                    <img src="{{ asset('frontend/assets/images/users') }}/{{Auth::user()->image}}" alt="User Photo" class="image img-rounded center-block" style="width: 150px; height: 150px;" >
                    <h3 style="font-size:28px;" class="text-center text-capitalize text-success">{{ Auth::user()->name }}</h3>

                    <div class="list-group text-black" role="tablist">
                        <a href="#info2" class="list-group-item list-group-item-action active" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-user"></i>  Basic Information</h5></a>
                        <a href="#order2" class="list-group-item list-group-item-action" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-list"></i> Orders List</h5></a>
                        <a href="#returnOrder" class="list-group-item list-group-item-action" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-list"></i> Return Orders</h5></a>
                        <a href="#review2" class="list-group-item list-group-item-action" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-clock-o"></i> Reviews</h5></a>
                        <a href="#chat2" class="list-group-item list-group-item-action" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-commenting"></i> Chat</h5></a>
                        <a href="#password2" class="list-group-item list-group-item-action" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-key"></i> Change Password</h5></a>
                        <a href="#changephoto2" class="list-group-item list-group-item-action" data-toggle="tab"><h5 style="font-size:16px;"><i class="icon fa fa-photo"></i>  Change Profile Photo</h5></a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" 
                           class="list-group-item" style="color: red;">
                            <h5 style="font-size:16px;"><i class="icon fa fa-power-off"></i> Logout</h5></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>

            <div class="col-md-8" id="app">
                <div class="sign-in-page" style="height: 740px;">
                    <div class="tab-content" style="padding-left: 0px !important;">

                        <!----------------------------------------- Change Information Section ------------------------------->                      
                        <div class="tab-pane active" id="info2">

                            <div class="row">
                                <div class="col-md-10 col-sm-6"><h4 class="text-center">Basic Information</h4></div>
                                <div class="col-md-2 col-sm-6 text-center">
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal"  data-target="#exampleModalCenter">Edit</button>
                                </div>
                            </div>
                            <hr><br>

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 col-sm-12">
                                    <table class="table table-striped table-bordered">
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
                                <div class="col-md-2"></div>
                            </div>

                        </div>
                        <!-------------------------------------------- End: Change Information Section -------------------------------> 


                        <!-------------------------------------------- Order List Section -------------------------------> 

                        <div class="tab-pane" id="order2" >
                            <p style="font-size:20px;" class="text-center text-capitalize text-black">Order List</p>
                            <hr>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-bordered">
                                    <thead class="row">
                                        <tr>
                                            <th scope="col-md-2" class="text-center">Invoice No.</th>
                                            <th scope="col-md-2" class="text-center">Date</th>
                                            <th scope="col-md-2" class="text-center">Total</th>
                                            <th scope="col-md-2" class="text-center">Payment</th>
                                            <th scope="col-md-2" class="text-center">Status</th>
                                            <th scope="col-md-2" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                        <tr class="text-center">
                                            <th scope="row" class="text-center" style="padding: 15px 0px;">{{$order->invoice_no}}</th>
                                            <td style="padding: 15px 0px;">{{$order->order_date}}</td>
                                            <td style="padding: 15px 0px;">৳{{$order->amount}}</td>
                                            <td style="padding: 15px 0px;">{{$order->payment_method}}</td>
                                            @if($order->status == 'Pending')
                                            <td style="padding: 15px 0px; color: orange;"><strong>{{$order->status}}</strong></td>
                                            @elseif($order->status == 'Cancel')
                                            <td style="padding: 15px 0px; color: red;"><strong>{{$order->status}}</strong></td>
                                            @else
                                            <td style="padding: 15px 0px; color: #59B210;"><strong>{{$order->status}}</strong></td>
                                            @endif
                                            <td style="padding: 15px 0px;">
                                                <h4>
                                                    <a href="{{url('/user/order-view/'.$order->id)}}" style="padding-right:3px" title="View"><i class="fa fa-eye" style="color: #3270BF"></i></a>
                                                    <a href="{{url('/user/invoice-download/'.$order->id)}}"><i class="fa fa-download" style="color: #59B210" title="Download"></i></a>
                                                </h4>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-danger"><b>No Order Found!</b></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> 
                        </div>

                        <!-------------------------------------------- End: Order List Section -------------------------------> 
                       
                        
                        <!-------------------------------------------- Return Order List Section -------------------------------> 

                        <div class="tab-pane" id="returnOrder" >
                            <p style="font-size:20px;" class="text-center text-capitalize text-black">Return Order List</p>
                            <hr>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-bordered">
                                    <thead class="row">
                                        <tr>
                                            <th scope="col-md-2" class="text-center">Order No.</th>
                                            <th scope="col-md-2" class="text-center">Request Date</th>
                                            <th scope="col-md-4" class="text-center">Reason</th>
                                            <th scope="col-md-2" class="text-center">Total</th>
                                            <th scope="col-md-2" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($return_orders as $order)
                                        <tr class="text-center">
                                            <th scope="row" class="text-center" style="padding: 15px 0px;">#{{$order->order_number}}</th>
                                            <td style="padding: 15px 0px;">{{$order->return_date}}</td>
                                            <td style="padding: 15px 0px;">{{$order->return_reason}}</td>
                                            <td style="padding: 15px 0px;">৳{{$order->amount}}</td>
                                            
                                            <td style="padding: 15px 0px;">
                                                <h4>
                                                    <a href="{{url('/user/order-view/'.$order->id)}}" style="padding-right:3px" title="View"><i class="fa fa-eye" style="color: #3270BF"></i></a>
                                                    <a href="{{url('/user/invoice-download/'.$order->id)}}"><i class="fa fa-download" style="color: #59B210" title="Download"></i></a>
                                                </h4>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-danger"><b>No Return Order Found!</b></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> 
                        </div>

                        <!-------------------------------------------- End: Return Order List Section -------------------------------> 


                        <!-------------------------------------------- Reviews Section -------------------------------> 

                        <div class="tab-pane" id="review2" >
                            <p style="font-size:20px;" class="text-center text-capitalize text-black">Reviews</p>
                            <hr>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-bordered">
                                    <thead class="row">
                                        <tr>
                                            <th scope="col-md-1" class="text-center">Image</th>
                                            <th scope="col-md-4">Product Name</th>
                                            <th scope="col-md-3">Comment</th>
                                            <th scope="col-md-2" class="text-center">Rating</th>
                                            <th scope="col-md-2" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reviews as $review)
                                        <tr>
                                            <td class="text-center">
                                            <img class="img-responsive" width="40px" src="{{ asset('uploads/product/thumbnail/') }}/{{$review->product->product_thumbnail}}" />
                                            </td>
                                            <td>
                                                <a href="{{ url('/products/') }}/{{$review->product->product_slug_en}}">{{$review->product->product_name_en}}</a>
                                            </td>
                                            <td>{{$review->comment}}</td>
                                            <td class="text-center">{{$review->rating}}</td>
                                            @if($review->status == 'Pending')
                                            <td style="padding: 0px 10px; color:orange;" class="text-center"><b>{{$review->status}}</b></td>
                                            @else
                                            <td style="padding: 0px 10px; color:green;" class="text-center"><b>{{$review->status}}</b></td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-danger"><b>No Review Found!</b></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> 
                        </div>

                        <!-------------------------------------------- End: Reviews Section -------------------------------> 


                        <!-------------------------------------------- Chat Section -------------------------------> 

                        <div class="tab-pane" id="chat2" style="margin-top: -15px;">
                            <user-chat class="text-center"></user-chat>
                        </div>

                        <!-------------------------------------------- End: Chat Section -------------------------------> 


                        <!-------------------------------------------- Change Password Section -------------------------------> 
                        <div class="tab-pane" id="password2" >
                            <p style="font-size:20px;" class="text-center text-capitalize text-black">Change Password</p>
                            <hr>

                            <div class="row">
                                <div class="col-md-10 col-sm-10 sign-in col-md-offset-1" >
                                    <br><br>
                                    <form method="POST" action="{{ route('password.change') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="password" class=" col-form-label">{{ __('Old Password') }}</label>
                                            </div>   
                                            <div class="col-md-8">
                                                <input id="password" type="password" placeholder="Enter Old Password" class="form-control @error('email') is-invalid @enderror" name="oldpass" required>
                                                @error('oldpass')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="password" class=" col-form-label">{{ __('New Password') }}</label>
                                            </div>   
                                            <div class="col-md-8">
                                                <input id="password" type="password" placeholder="Enter New Password" class="form-control @error('email') is-invalid @enderror" name="newpass" required>
                                                @error('newpass')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-8">
                                                <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="newpass_confirm" required>
                                                @error('newpass_confirm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                {{ __('Change Password') }}
                                            </button>
                                            <br><br><br><br><br>
                                        </div>
                                    </form>					
                                </div>
                            </div>

                        </div>
                        <!-------------------------------------------- End Change Password Section -------------------------------> 


                        <!-------------------------------------------- Change Profile Picture -------------------------------> 
                        <div class="tab-pane" id="changephoto2" >
                            <p style="font-size:20px;" class="text-center text-capitalize text-black">Change Your Profile Picture</p>
                            <hr>
                            <div class="row">
                                <div class="col-md-10 col-sm-10 sign-in col-md-offset-1" >
                                    <br><br>
                                    <form method="POST" action="{{ route('image.change') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="image" class=" col-form-label">{{ __('Upload New Image') }}</label>
                                            </div>   
                                            <div class="col-md-8">
                                                <input type="file" class="form-control" name="image" accept=".png,.jpg,.jpeg" required>
                                                @error('change_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                {{ __('Change Image') }}
                                            </button>
                                        </div>
                                    </form>					
                                </div>
                            </div>
                        </div>
                        <!-------------------------------------------- End Change Profile Picture -------------------------------> 

                    </div>
                </div>

            </div>

        </div>
        <br><br><br>




        <!-------------------------------------------- Modal --------------------------->
        <div class="modal " id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Admin Basic Information  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body card pd-30">
                        <form method="POST" action="{{ route('userInfo.change') }}" >
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
        <!-------------------------------------------- End Modal --------------------------->


<script src="{{ asset('js/app.js') }}"  defer></script>

@endsection

