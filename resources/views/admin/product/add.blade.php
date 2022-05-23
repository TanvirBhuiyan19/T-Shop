@extends('layouts.adminMaster')

@section('product') active show-sub @endsection
@section('add-product') active @endsection


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
@if($settings->site_name) Add Product | {{$settings->site_name}} @else Add Product | {{config('app.name')}}  @endif
@endsection



@section('adminContent')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{url('/')}}">
        @if($settings->site_name) {{$settings->site_name}} @else {{config('app.name')}}  @endif
    </a>
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
    <span class="breadcrumb-item active">Add Product</span>
</nav>


<div class="sl-pagebody">
    <div class="row row-sm">
        
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card ">
                <h5 class="card-header text-center">Create New Product </h5>
                <div class="card-body">


                    <div class="form-layout">
                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mg-b-25">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Brand Name: </strong><span class="tx-danger">*</span></label>
                                        <select name="brand_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                            <option label="Choose one"></option>
                                            @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{ucwords($brand->brand_name_en)}}</option>
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
                                            <option value="{{$category->id}}">{{ucwords($category->category_name_en)}}</option>
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
                                        <input class="form-control" type="text" name="product_name_en" placeholder="English Product Name" value="{{ old('product_name_en') }}">
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
                                        <input class="form-control" type="text" name="product_name_bn" placeholder="Bangla Product Name" value="{{ old('product_name_bn') }}">
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
                                        <input class="form-control" type="text" name="product_code" placeholder="Product Code" value="{{ old('product_code') }}">
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
                                        <input class="form-control" type="text" name="product_tag_en" placeholder="Separate by Comma (,)" data-role="tagsinput">
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
                                        <input class="form-control" type="text" name="product_tag_bn" placeholder="Separate by Comma (,)" data-role="tagsinput">
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
                                        <input class="form-control" type="number" name="product_qty" placeholder="Product Quantity" value="{{ old('product_qty') }}">
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
<!--                                        <input class="form-control" type="text" name="product_size_en" placeholder="Product Size in English" value="{{ old('product_size_en') }}">-->

                                        <select class="form-control select2" name="product_size_en[]" data-placeholder="Choose Size" multiple>
                                            <option value="extra small">Extra Small</option>
                                            <option value="small">Small</option>
                                            <option value="medium">Medium</option>
                                            <option value="large">Large</option>
                                            <option value="extra large" >Extra Large</option>
                                            <option value="2XL">2XL</option>
                                            <option value="3xl">3XL</option>
                                            <option value="4xl">4XL</option>
                                            <option value="5xl">5XL</option>
                                        </select>

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
<!--                                        <input class="form-control" type="text" name="product_size_bn" placeholder="Product Size in Bangla" value="{{ old('product_size_bn') }}">-->
                                        
                                        <select class="form-control select2" name="product_size_bn[]" data-placeholder="Choose Size" multiple>
                                            <option value="বেশি ছোট">বেশি ছোট</option>
                                            <option value="ছোট">ছোট</option>
                                            <option value="মাঝারী">মাঝারী</option>
                                            <option value="বড়">বড়</option>
                                            <option value="বেশি বড়" >বেশি বড়</option>
                                            <option value="দ্বিগুন বড়">দ্বিগুন বড়</option>
                                            <option value="তিনগুন বড়">তিনগুন বড়</option>
                                            <option value="চারগুন বড়">চারগুন বড়</option>
                                            <option value="পাঁচগুণ বড়">পাঁচগুণ বড়</option>
                                        </select>

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
                                        <input class="form-control" type="text" name="product_color_en" placeholder="Separate by Comma (,)" data-role="tagsinput">
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
                                        <input class="form-control" type="text" name="product_color_bn" placeholder="Separate by Comma (,)" data-role="tagsinput">
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
                                        <input class="form-control" type="number" name="selling_price" placeholder="Product Selling Price" value="{{ old('selling_price') }}">
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
                                        <input class="form-control" type="number" name="discount_price" placeholder="Product Discount Price" value="{{ old('discount_price') }}">
                                        @error('discount_price')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Product Thumbnail: </strong><span class="tx-danger">*</span></label>
                                        <input class="form-control" type="file"  accept=".png,.jpg,.jpeg" name="product_thumbnail" onchange="mainThambUrl(this)">
                                        @error('product_thumbnail')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                         <img src="" id="mainThmb">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Multiple Images: </strong></label>
                                        <input class="form-control" type="file"  accept=".png,.jpg,.jpeg" name="multi_img[]"  id="multiImg" multiple>
                                        @error('multi_img')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    <div class=" form-control-file" id="preview_img"></div>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label"><strong>Short Description in English: </strong><span class="tx-danger">*</span></label>
                                        <textarea class="form-control" id="summernoteShortEN" name="short_descp_en" >
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
                                        <textarea class="form-control" id="summernoteShortBN" name="short_descp_bn" >
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
                                        <textarea class="form-control" id="summernoteLongEN" name="long_descp_en" >
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
                                        <textarea class="form-control" id="summernoteLongBN" name="long_descp_bn" >
                                        @error('long_descp_bn')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </textarea>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="ckbox">
                                            <input type="checkbox" name="hot_deal" value="1"><span><strong>Hot Deal</strong></span>
                                        </label>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="ckbox">
                                            <input type="checkbox" name="featured" value="1"><span><strong>Featured</strong></span>
                                        </label>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="ckbox">
                                            <input type="checkbox" name="special_offer" value="1"><span><strong>Special Offer</strong></span>
                                        </label>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="ckbox">
                                            <input type="checkbox" name="special_deal" value="1"><span><strong>Special Deal</strong></span>
                                        </label>
                                    </div>
                                </div><!-- col-4 -->


                            </div><!-- row -->

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-success mg-r-5">Add Product</button>
                            </div><!-- form-layout-footer -->
                        </form>
                    </div><!-- form-layout -->

                </div><!-- card body -->
            </div><!-- card -->
        </div>              

    </div><!-- row -->
    <br><br>
</div>>






<!--================================ Dependent SubCategory & Sub-SubCategory Dropdown =================================================-->
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
<!--================================ End: Dependent SubCategory & Sub-SubCategory Dropdown =================================================-->


<!--================================ Preview Multiple Images Before Upload  =================================================-->
<script>
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
          var d = $('#preview_img').empty();
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
  </script>
<!--================================ End: Preview Multiple Images Before Upload =================================================-->


<!--================================ Preview Thumbnail Images Before Upload =================================================-->
  <script>
    function mainThambUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result).width(80)
                  .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
<!--================================ End: Preview Thumbnail Images Before Upload =================================================-->



@endsection                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           