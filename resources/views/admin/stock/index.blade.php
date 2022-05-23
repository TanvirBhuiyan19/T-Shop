@extends('layouts.adminMaster')

@section('stock') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Manage Stock | {{$settings->site_name}} @else Manage Stock | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Manage Stock</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Product Data Table ----------------------------------------------->   
    @isset(auth()->user()->role->permission['permission']['stock']['list'] )
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card ">
                <h6 class="card-header text-center">Update Products Stock</h6>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive wrap">
                            <thead class="text-right">
                                <tr>
                                    <th class="wd-15p text-center">Thumbnail</th>
                                    <th class="wd-25p text-center">Product Name</th>
                                    <th class="wd-10p text-center">Price</th>
                                    <th class="wd-20p text-center">Code</th>
                                    <th class="wd-10p text-center">Status</th>
                                    <th class="wd-10p text-center">Quantity</th>
                                    <th class="wd-10p text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr  class="text-center">
                                    <td><img src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" alt="Product Thumbnail" style="width: 60px;"></td>
                                    <td>{{$product->product_name_en}}</td>
                                    <td> {{$product->selling_price}}/- </td>
                                    <td>{{$product->product_code}}</td>
                                    @if($product->status == 1)
                                    <td>
                                        <span class="badge badge-pill badge-success" style="padding: 5px 10px;">Active</span>
                                    </td>
                                    @else
                                    <td>
                                        <span class="badge badge-pill badge-warning" style="padding: 5px 10px;">In-Active</span>
                                    </td>
                                    @endif
                                    
                                    <td>{{$product->product_qty}}</td>
                                    
                                    <td>
                                        <h4 class="row text-center" style="justify-content: center;">
                                            @isset(auth()->user()->role->permission['permission']['product']['delete'] )
                                                @if($product->status == 1)
                                                <a href="{{url('admin/product/inactive/'.$product->id)}}" style="padding-right:7px"  title="In-Active"><i class="fa fa-toggle-off text-dark"></i></a>
                                                @else
                                                <a href="{{url('admin/product/active/'.$product->id)}}" style="padding-right:7px"  title="Active"><i class="fa fa-toggle-on text-dark"></i></a>
                                                @endif
                                            @endisset
                                            @isset(auth()->user()->role->permission['permission']['stock']['edit'] )
                                                <a href="{{route('stock-edit',$product->id)}}" style="padding-right:7px" title="Edit"><i class="fa fa-edit text-success"></i></a>
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
        <!--<!------------------------ End: Product Data Table ----------------------------------------------->       

    </div><!-- row -->
    <br><br>
</div>>

@endsection