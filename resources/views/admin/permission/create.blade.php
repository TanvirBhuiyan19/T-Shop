@extends('layouts.adminMaster')

@section('permissions') active show-sub @endsection
@section('permission.create') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Add Permission | {{$settings->site_name}} @else Add Permission | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('permission.index')}}">Permissions</a>
    <span class="breadcrumb-item active">Add Permission</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Brand Data Table ----------------------------------------------->         
        <div class="col-lg-12 col-md-12 col-sm-12 m-auto" >
            <div class="card ">
                <h5 class="card-header text-center">Add Permission </h5>
                <div class="card-body">


                    <div class="form-layout">
                        <form method="POST" action="{{ route('permission.store') }}" >
                            @csrf

                            <div class="row mg-b-25">
                                <div class="col-lg-4 m-auto">
                                    <div class="form-group">
                                        <label class="form-control-label">Select a Role Name<span class="tx-danger">*</span></label>
                                        <select name="role_id" style="padding: 5px">
                                            <option disabled selected >Select a Role</option>
                                            @foreach($roles as $item)
                                            <option value="{{$item->id}}">{{ $item->name }}</option>
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
                            
                            <div class="row mg-b-25">
                                <div class="col-lg-10 m-auto">
                                    <div class="form-group">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Permission</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>View</th>
                                                    <th>Delete</th>
                                                    <th>List</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Brand</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[brand][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[brand][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[brand][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[brand][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[brand][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Category</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[cat][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[cat][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[cat][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[cat][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[cat][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sub-Category</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subcat][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subcat][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subcat][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subcat][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subcat][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sub-Sub-Category</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subsubcat][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subsubcat][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subsubcat][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subsubcat][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subsubcat][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Product</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[product][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[product][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[product][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[product][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[product][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Slider</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[slider][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[slider][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[slider][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[slider][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[slider][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Coupon</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[coupon][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[coupon][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[coupon][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[coupon][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[coupon][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping Area</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[shipping][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[shipping][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[shipping][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[shipping][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[shipping][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Orders</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[order][add]" value="1">
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[order][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[order][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[order][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Reports</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[report][view]" value="1">
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Reviews</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[review][add]" value="1">
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[review][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[review][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[review][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Stock Manage</td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[stock][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[stock][view]" value="1">
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[stock][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Role Manage</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[role][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[role][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[role][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[role][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[role][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Permission Manage</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[permission][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[permission][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[permission][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[permission][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[permission][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SubAdmin Manage</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subadmin][add]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subadmin][edit]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subadmin][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subadmin][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[subadmin][list]" value="1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Chats Manage</td>
                                                    <td>
                                                        <input type="checkbox" name="permission[chat][add]" value="1">
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[chat][view]" value="1">
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>All User</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <input type="checkbox" name="permission[alluser][view]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[alluser][delete]" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="permission[alluser][list]" value="1">
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
                                <button type="submit" class="btn btn-success mg-r-5 m-auto">Add New Permission</button>
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