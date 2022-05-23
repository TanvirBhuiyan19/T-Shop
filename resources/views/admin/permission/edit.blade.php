@extends('layouts.adminMaster')

@section('permissions') active show-sub @endsection
@section('permission.index') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit Permission | {{$settings->site_name}} @else Edit Permission | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('permission.index')}}">Permissions</a>
    <span class="breadcrumb-item active">Edit Permission</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Brand Data Table ----------------------------------------------->         
        <div class="col-lg-12 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h5 class="card-header text-center">Edit Permission </h5>
                <div class="card-body">


                    <div class="form-layout">
                        <form method="POST" action="{{ route('permission.update',$permission->id) }}" >
                            @csrf
                            @method('put')
                            <div class="row mg-b-25">
                                <div class="col-lg-4 m-auto">
                                    <div class="form-group">
                                        <label class="form-control-label">Select a Role Name<span class="tx-danger">*</span></label>
                                        <select name="role_id" style="padding: 5px">
                                            @foreach($roles as $item)
                                            <option value="{{$item->id}}" {{ ($permission->role_id == $item->id) ? 'selected' : ''}} >{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        @error('role_id')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-12 -->
                                
                            </div><!-- row -->
                            
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-12 m-auto">
                                    <div class="form-group">
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th class="wd-40p">Permission</th>
                                                    <th class="wd-12p">Add</th>
                                                    <th class="wd-12p">Edit</th>
                                                    <th class="wd-12p">View</th>
                                                    <th class="wd-12p">Delete</th>
                                                    <th class="wd-12p">List</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Brand</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[brand][add]" 
                                                         @isset($permission['permission']['brand']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[brand][edit]" 
                                                         @isset($permission['permission']['brand']['edit']) checked @endisset    
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[brand][view]" 
                                                         @isset($permission['permission']['brand']['view']) checked @endisset
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[brand][delete]" 
                                                         @isset($permission['permission']['brand']['delete']) checked @endisset  
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[brand][list]" 
                                                         @isset($permission['permission']['brand']['list']) checked @endisset       
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Category</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[cat][add]" 
                                                         @isset($permission['permission']['cat']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[cat][edit]" 
                                                         @isset($permission['permission']['cat']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[cat][view]" 
                                                         @isset($permission['permission']['cat']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[cat][delete]" 
                                                         @isset($permission['permission']['cat']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[cat][list]" 
                                                         @isset($permission['permission']['cat']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sub-Category</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subcat][add]" 
                                                         @isset($permission['permission']['subcat']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subcat][edit]" 
                                                         @isset($permission['permission']['subcat']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subcat][view]" 
                                                         @isset($permission['permission']['subcat']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subcat][delete]" 
                                                         @isset($permission['permission']['subcat']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subcat][list]" 
                                                         @isset($permission['permission']['subcat']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sub-Sub-Category</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subsubcat][add]" 
                                                         @isset($permission['permission']['subsubcat']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subsubcat][edit]" 
                                                         @isset($permission['permission']['subsubcat']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subsubcat][view]" 
                                                         @isset($permission['permission']['subsubcat']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subsubcat][delete]" 
                                                         @isset($permission['permission']['subsubcat']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subsubcat][list]" 
                                                         @isset($permission['permission']['subsubcat']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Product</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[product][add]" 
                                                         @isset($permission['permission']['product']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[product][edit]" 
                                                         @isset($permission['permission']['product']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[product][view]" 
                                                         @isset($permission['permission']['product']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[product][delete]" 
                                                         @isset($permission['permission']['product']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[product][list]" 
                                                         @isset($permission['permission']['product']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Slider</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[slider][add]" 
                                                         @isset($permission['permission']['slider']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[slider][edit]" 
                                                         @isset($permission['permission']['slider']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[slider][view]" 
                                                         @isset($permission['permission']['slider']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[slider][delete]" 
                                                         @isset($permission['permission']['slider']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[slider][list]" 
                                                         @isset($permission['permission']['slider']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Coupon</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[coupon][add]" 
                                                         @isset($permission['permission']['coupon']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[coupon][edit]" 
                                                         @isset($permission['permission']['coupon']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[coupon][view]" 
                                                         @isset($permission['permission']['coupon']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[coupon][delete]" 
                                                         @isset($permission['permission']['coupon']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[coupon][list]" 
                                                         @isset($permission['permission']['coupon']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping Area</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[shipping][add]" 
                                                         @isset($permission['permission']['shipping']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[shipping][edit]" 
                                                         @isset($permission['permission']['shipping']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[shipping][view]" 
                                                         @isset($permission['permission']['shipping']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[shipping][delete]" 
                                                         @isset($permission['permission']['shipping']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[shipping][list]" 
                                                         @isset($permission['permission']['shipping']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Orders</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[order][add]" 
                                                         @isset($permission['permission']['order']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[order][view]" 
                                                         @isset($permission['permission']['order']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[order][delete]" 
                                                         @isset($permission['permission']['order']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[order][list]" 
                                                         @isset($permission['permission']['order']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Reports</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[report][view]" 
                                                         @isset($permission['permission']['report']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Reviews</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[review][add]" 
                                                         @isset($permission['permission']['review']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[review][view]" 
                                                         @isset($permission['permission']['review']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[review][delete]" 
                                                         @isset($permission['permission']['review']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[review][list]" 
                                                         @isset($permission['permission']['review']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Stock Manage</td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[stock][edit]" 
                                                         @isset($permission['permission']['stock']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[stock][view]" 
                                                         @isset($permission['permission']['stock']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[stock][list]" 
                                                         @isset($permission['permission']['stock']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Role Manage</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[role][add]" 
                                                         @isset($permission['permission']['role']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[role][edit]" 
                                                         @isset($permission['permission']['role']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[role][view]" 
                                                         @isset($permission['permission']['role']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[role][delete]" 
                                                         @isset($permission['permission']['role']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[role][list]" 
                                                         @isset($permission['permission']['role']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Permission Manage</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[permission][add]" 
                                                         @isset($permission['permission']['permission']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[permission][edit]" 
                                                         @isset($permission['permission']['permission']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[permission][view]" 
                                                         @isset($permission['permission']['permission']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[permission][delete]" 
                                                         @isset($permission['permission']['permission']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[permission][list]" 
                                                         @isset($permission['permission']['permission']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SubAdmin Manage</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subadmin][add]" 
                                                         @isset($permission['permission']['subadmin']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subadmin][edit]" 
                                                         @isset($permission['permission']['subadmin']['edit']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subadmin][view]" 
                                                         @isset($permission['permission']['subadmin']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subadmin][delete]" 
                                                         @isset($permission['permission']['subadmin']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subadmin][list]" 
                                                         @isset($permission['permission']['subadmin']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Chats Manage</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[chat][add]" 
                                                         @isset($permission['permission']['chat']['add']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[chat][view]" 
                                                         @isset($permission['permission']['chat']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>All User</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[alluser][view]" 
                                                         @isset($permission['permission']['alluser']['view']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[alluser][delete]" 
                                                         @isset($permission['permission']['alluser']['delete']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[alluser][list]" 
                                                         @isset($permission['permission']['alluser']['list']) checked @endisset     
                                                        value="1">
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                        
                                        @error('permission')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-12 -->
                                
                            </div><!-- row -->

                            <div class="row mg-b-25">
                                <div class="col-lg-10 m-auto">
                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-success mg-r-5 m-auto">Update Permission</button>
                            </div>
                            </div>
                            </div><!-- form-layout-footer -->
                        </form>
                    </div><!-- form-layout -->

                </div><!-- card body -->
            </div><!-- card -->
        </div>
        <!--<!------------------------ End Brand Data Table ----------------------------------------------->                

    </div><!-- row -->
    <br><br>
</div>>

@endsection