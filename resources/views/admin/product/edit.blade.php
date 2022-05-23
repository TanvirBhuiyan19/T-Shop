@extends('layouts.adminMaster')

@section('product') active show-sub @endsection
@section('manage-product') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Edit Product | {{$settings->site_name}} @else Edit Product | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('product.manage')}}">Manage-Product</a>
    <span class="breadcrumb-item active">Edit Product</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">

        <!--<!------------------------ Product Data Update ----------------------------------------------->         
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card ">
                <h5 class="card-header text-center">Update Product Information</h5>
                <div class="card-body">


                    <div class="form-layout">
                        <form method="POST" action="{{ route('product.update') }}">
                            @csrf
                            <div class="row mg-b-25">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Brand Name: </strong><span class="tx-danger">*</span></label>
                                        <select name="brand_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                            <option label="Choose one"></option>
                                            @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" {{ $brand->id == $product->brand_id ? 'selected':'' }}>{{ucwords($brand->brand_name_en)}}</option>
                                            @endforeach
                                        </select>

                                        @error('brand_id')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Category Name: </strong><span class="tx-danger">*</span></label>
                                        <select name="category_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                            <option label="Choose one"></option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ $category->id == $product->category_id ? 'selected':'' }}>{{ucwords($category->category_name_en)}}</option>
                                            @endforeach
                                        </select>

                                        @error('category_id')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Subcategory Name: </strong><span class="tx-danger">*</span></label>
                                        <select name="subcategory_id" class="form-control select2-show-search" data-placeholder="Choose one">

                                        </select>
                                        @error('subcategory_id')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Subcategory Name: </strong><span class="tx-danger">*</span></label>
                                        <select name="sub_subcategory_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                            <option label="Choose one"></option>
                                        </select>

                                        @error('sub_subcategory_id')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Name in English: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_name_en" placeholder="English Product Name" value="{{ $product->product_name_en }}">
                                        @error('product_name_en')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Name in Bangla: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_name_bn" placeholder="Bangla Product Name" value="{{ $product->product_name_bn }}">
                                        @error('product_name_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Code: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_code" placeholder="Product Code" value="{{ $product->product_code }}">
                                        @error('product_code')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Tag in English: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_tag_en" placeholder="Separate by Comma (,)" value="{{ $product->product_tag_en }}" data-role="tagsinput">
                                        @error('product_tag_en')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Tag in Bangla: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_tag_bn" placeholder="Separate by Comma (,)" value="{{ $product->product_tag_bn }}" data-role="tagsinput">
                                        @error('product_tag_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Quantity: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" name="product_qty" placeholder="Product Quantity" value="{{ $product->product_qty }}">
                                        @error('product_qty')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Size in English: </strong></label>
                                        <input class="form-control" type="text" name="product_size_en" placeholder="Separate by Comma (,)" value="{{ $product->product_size_en }}" data-role="tagsinput">

                                        @error('product_size_en')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Size in Bangla: </strong></label>
                                        <input class="form-control" type="text" name="product_size_bn" placeholder="Separate by Comma (,)" value="{{ $product->product_size_bn }}" data-role="tagsinput">

                                        @error('product_size_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Color in English: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_color_en" placeholder="Separate by Comma (,)" value="{{ $product->product_color_en}}" data-role="tagsinput">
                                        @error('product_color_en')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Color in Bangla: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_color_bn" placeholder="Separate by Comma (,)" value="{{ $product->product_color_bn}}" data-role="tagsinput">
                                        @error('product_color_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Selling Price: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" name="selling_price" placeholder="Product Selling Price" value="{{ $product->selling_price }}">
                                        @error('selling_price')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Discount Price: </strong></label>
                                        <input class="form-control" type="number" name="discount_price" placeholder="Product Discount Price" value="{{ $product->discount_price }}">
                                        @error('discount_price')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->


                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label"><br></label>
                                        <label class="ckbox">
                                            <input type="checkbox" name="hot_deal" value="1" {{ $product->hot_deal==1 ? 'checked' : '' }}><span><strong>Hot Deal</strong></span>
                                        </label>
                                    </div>
                                </div><!-- col-2 -->

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label"><br></label>
                                        <label class="ckbox">
                                            <input type="checkbox" name="featured" value="1" {{ $product->featured==1 ? 'checked' : '' }}><span><strong>Featured</strong></span>
                                        </label>
                                    </div>
                                </div><!-- col-2 -->

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label"><br></label>
                                        <label class="ckbox">
                                            <input type="checkbox" name="special_offer" value="1" {{ $product->special_offer==1 ? 'checked' : '' }}><span><strong>Special Offer</strong></span>
                                        </label>
                                    </div>
                                </div><!-- col-2 -->

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label"><br></label>
                                        <label class="ckbox">
                                            <input type="checkbox" name="special_deal" value="1" {{ $product->special_deal==1 ? 'checked' : '' }}><span><strong>Special Deal</strong></span>
                                        </label>
                                    </div>
                                </div><!-- col-2 -->


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Short Description in English: </strong><span class="tx-danger">*</span></label>
                                        <textarea class="form-control" id="summernoteShortEN" name="short_descp_en" > {{$product->short_descp_en}}
                                        @error('short_descp_en')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </textarea>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Short Description in Bangla: </strong><span class="tx-danger">*</span></label>
                                        <textarea class="form-control" id="summernoteShortBN" name="short_descp_bn" > {{$product->short_descp_bn}}
                                        @error('short_descp_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </textarea>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Long Description in English: </strong><span class="tx-danger">*</span></label>
                                        <textarea class="form-control" id="summernoteLongEN" name="long_descp_en" > {{$product->long_descp_en}}
                                        @error('long_descp_en')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </textarea>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Long Description in Bangla: </strong><span class="tx-danger">*</span></label>
                                        <textarea class="form-control" id="summernoteLongBN" name="long_descp_bn" > {{$product->long_descp_bn}}
                                        @error('long_descp_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </textarea>
                                    </div>
                                </div><!-- col-4 -->

                            </div><!-- row -->

                            <div class="form-layout-footer">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="submit" class="btn btn-success mg-r-5">Update Information</button>
                                <a href="{{route('product.manage')}}" class="btn btn-secondary">Cancel</a>
                            </div><!-- form-layout-footer -->
                        </form>
                    </div><!-- form-layout -->

                </div><!-- card body -->
            </div><!-- card -->
        </div>
        <!--<!------------------------ End: Product Data Update ----------------------------------------------->                

    </div><!-- row -->


    <!--<!------------------------ Product Thumbnail Update ----------------------------------------------->              
    <br><br> 
    <div class="row row-sm">

        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card">
                <h5 class="card-header text-center">Update Product Thumbnail</h5>
                <div class="card-body row">
                    <div class="col-lg-2 col-md-2"></div>
                    <div class="col-lg-4 col-md-4 text-center" style="border-right: 2px solid">
                        <strong>Current Thumbnail</strong>
                        <hr>
                        <img src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" alt="Product Thumbnail" style="width: 150px; height: 150px;">
                        <br><br>
                    </div>
                    <div class="col-lg-4 col-md-4 text-center">
                        <strong>Upload New Thumbnail</strong>
                        <hr>
                        <form method="POST" action="{{ route('product.thumb-update') }}" enctype="multipart/form-data" >
                            @csrf
                            <label class="custom-file">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="product_name_en" value="{{$product->product_name_en}}">
                                <input type="hidden" name="old_thumbnail" value="{{$product->product_thumbnail}}">
                                <input type="file" id="file2" class="custom-file-input" accept=".png,.jpg,.jpeg" name="product_thumbnail" onchange="mainThambUrl(this)" required >
                                <span class="custom-file-control custom-file-control-primary"></span>
                            </label>
                            @error('product_thumbnail')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <img src="" id="mainThmb">
                            <hr>
                            <button type="submit" class="btn btn-success mg-r-5">Update Thumbnail</button>
                        </form>
                    </div>

                    <div class="col-lg-2 col-md-2"></div>
                </div>
            </div>
        </div>

    </div>
    <!--<!------------------------ End: Product Thumbnail Update ----------------------------------------------->  


    <!--<!------------------------ Product Multiple Image Update ----------------------------------------------->              
    <br><br> 
    <div class="row row-sm">

        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card">
                <h5 class="card-header text-center">Update Multiple Image</h5>
                <div class="card-body row">
                    <div class="col-lg-1 col-md-1"></div>
                    <div class="col-lg-5 col-md-5 text-center" style="border-right: 2px solid">
                        <strong>Current Product Images</strong>
                        <hr>
                        @foreach($multiple_images as $multiple_image)
                        <img src="{{ asset('uploads/product/multiple-image/') }}/{{$multiple_image->product_image}}" alt="Multiple Image" style="width: 95px; height: 95px;">
                        <a href="{{route('product.deleteImage',$multiple_image->id)}}" class="btn btn-group btn-lg" style="position: absolute; margin-left: -80px; margin-top: 30px;" id="delete"  title="Delete This Image"><button style="cursor:pointer;"><i class="fa fa-trash text-danger"></i></button></a>
                        @endforeach
                    </div>
                    <div class="col-lg-5 col-md-5 text-center">
                        <strong>Upload New Image</strong>
                        <hr>
                        <form method="POST" action="{{ route('product.multipleimg-update') }}" enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="product_name_en" value="{{$product->product_name_en}}">
                            <input class="form-control" type="file"  accept=".png,.jpg,.jpeg" name="multi_img[]"  id="multiImg" multiple required>
                            @error('multi_img')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class=" form-control-file" id="preview_img"></div>
                            <hr>
                            <button type="submit" class="btn btn-success mg-r-5">Add Product Image</button>
                        </form>
                    </div>

                    <div class="col-lg-1 col-md-1"></div>
                </div>
            </div>
        </div>

    </div>
    <!--<!------------------------ End: Product Multiple Image Update ----------------------------------------------->  

    <br><br>
</div>>






<!--================================ Dependent SubCategory Dropdown =================================================-->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
                                    $(document).ready(function () {

                                        $('select[name="category_id"]').on('change', function () {
                                            var category_id = $(this).val();
                                            if (category_id) {
                                                $.ajax({
                                                    url: "{{ url('/admin/subcategory/ajax')}}/" + category_id,
                                                    type: "GET",
                                                    dataType: "json",
                                                    success: function (data) {
                                                        $('select[name="sub_subcategory_id"]').html('');

                                                        var d = $('select[name="subcategory_id"]').empty();
                                                        $.each(data, function (key, value) {
                                                            $('select[name="subcategory_id"]').append('<option label="Choose one"></option>' + '<option value="' + value.id + '">' + value.subcategory_name_en + '</option>');
                                                        });
                                                    },
                                                });
                                            } else {
                                                alert('danger');
                                            }
                                        });

                                        $('select[name="subcategory_id"]').on('change', function () {
                                            var subcategory_id = $(this).val();
                                            if (subcategory_id) {
                                                $.ajax({
                                                    url: "{{ url('/admin/sub-subcategory/ajax')}}/" + subcategory_id,
                                                    type: "GET",
                                                    dataType: "json",
                                                    success: function (data) {
                                                        var d = $('select[name="sub_subcategory_id"]').empty();
                                                        $.each(data, function (key, value) {
                                                            $('select[name="sub_subcategory_id"]').append('<option value="' + value.id + '">' + value.sub_subcategory_name_en + '</option>');
                                                        });
                                                    },
                                                });
                                            } else {
                                                alert('danger');
                                            }
                                        });
                                    });

</script>
<!--================================ End: Dependent SubCategory Dropdown =================================================-->


<!--================================ Preview Multiple Images Before Upload  =================================================-->
<script>
    $(document).ready(function () {
        $('#multiImg').on('change', function () { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data
                var d = $('#preview_img').empty();
                $.each(data, function (index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function (file) { //trigger function on successful read
                            return function (e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
                                        .height(80); //create image element
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>
<!--================================ End: Preview Multiple Images Before Upload =================================================-->


<!--================================ Preview Thumbnail Images Before Upload =================================================-->
<script>
    function mainThambUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#mainThmb').attr('src', e.target.result).width(80)
                        .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!--================================ End: Preview Thumbnail Images Before Upload =================================================-->



@endsection                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           