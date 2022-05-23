<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="">
        <meta name="keywords" content="MediaCenter, Template, eCommerce">
        <meta name="robots" content="all">
       
        @php
        $settings = App\Models\Setting::where('id', 1)->first();
        @endphp
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/settings/'.$settings->favicon_icon) }}">
        @yield('meta')
        <title>@yield('title')</title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css"> 

        <!-- Customizable CSS -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/main.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/blue.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/owl.carousel.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/owl.transitions.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/animate.min.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/rateit.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

        
        <!-- Sweet Alert 2 CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.css" />


        <!-- Icons/Glyphs -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/font-awesome.css">

        <!-- Fonts --> 
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

        <script src="https://js.stripe.com/v3/"></script>
        
        <style>
            .search-area{
                position: relative;
            }
            #suggestProduct {
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: #fff;
                z-index: 999;
                border-radius: 4px;
                margin-top: 2px;
            }
            </style>
    </head>
    <body class="cnt-home">

        <!-- ============================================== HEADER ============================================== -->

        @include('frontend.include.header')

        <!-- ============================================== HEADER : END ============================================== -->


        @yield('content')

        <!-- ============================================== BRANDS CAROUSEL ============================================== -->

        @include('frontend.include.brands')

    </div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<!-- ============================================================= FOOTER ============================================================= -->

@include('frontend.include.footer')

<!-- ============================================================= FOOTER : END ============================================================= -->

<!-- ============================================================= Product View Modal ============================================================= -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">


                    <ul class="list-inline list-unstyled">
                        @if(session()->get('language') == 'bangla')
                        <li><a href="{{url('/')}}">হোম</a></li> /
                        <li><a  class="pcatbn"></a></li> /
                        <li><a class="psubcatbn"></a></li> /
                        <li><a class="psubsubcatbn"></a></li>
                        @else
                        <li><a href="{{url('/')}}">Home</a></li> /
                        <li><a  class="pcaten"></a></li> /
                        <li><a class="psubcaten"></a></li> /
                        <li><a class="psubsubcaten"></a></li>
                        @endif
                    </ul>

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -22px; color: red;">
                    <span aria-hidden="true" style="font-size: 30px; font-weight: 800;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
<!-- ==============================================================================================================  -->

                    <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                        <div class="product-item-holder size-big single-product-gallery small-gallery">

                            <div id="owl-single-product">
                                <div class="single-product-gallery-item" id="slide1">
                                    <img class="img-responsive pthumbnail" style="margin: 10px" />
                                </div><!-- /.single-product-gallery-item -->

                                <div class="single-product-gallery-item" id="slide2">
                                    <img class="img-responsive pmultiimg" style="margin: 10px" />
                                </div><!-- /.single-product-gallery-item -->

                            </div><!-- /.single-product-slider -->


                            <div class="single-product-gallery-thumbs gallery-thumbs" style="margin-top: 10px;">

                                <div id="owl-single-product-thumbnails">
                                    <div class="item" style="border: 1px solid grey; margin: 3px;">
                                        <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="0" href="#slide1">
                                            <img class="img-responsive pthumbnail" width="85"  />
                                        </a>
                                    </div>

                                    <div class="item" style="border: 1px solid grey; margin: 3px;">
                                        <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="1" href="#slide2">
                                            <img class="img-responsive pmultiimg" width="85" />
                                        </a>
                                    </div>

                                </div><!-- /#owl-single-product-thumbnails -->
                            </div><!-- /.gallery-thumbs -->

                        </div><!-- /.single-product-gallery -->
                    </div><!-- /.gallery-holder -->  

                    <div class='col-sm-6 col-md-7 product-info-block'>
                        <div class="product-info">
                            @if(session()->get('language') == 'bangla')
                            <h3 class="name pnamebn" style="margin-top: -5px"></h3>
                            @else
                            <h2 class="name pnameen" style="margin-top: -10px"></h2>
                            @endif

                            <div class="rating-reviews m-t-20">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="rating rateit-small"></div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="reviews">
                                            (13 Reviews)
                                        </div>
                                    </div>
                                </div><!-- /.row -->		
                            </div><!-- /.rating-reviews -->

                            <div class="stock-container info-container m-t-10">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="stock-box">
                                            @if(session()->get('language') == 'bangla')
                                            <span >উপস্থিতি :</span>
                                            @else
                                            <span >Availability :</span>
                                            @endif
                                        </div>	
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="stock-box">
                                            @if(session()->get('language') == 'bangla')
                                            <strong class="value text-success instockbn"></strong>
                                            <strong class="value text-danger stockoutbn"></strong>
                                            @else
                                            <strong class="value text-success instocken"></strong>
                                            <strong class="value text-danger stockouten"></strong>
                                            @endif
                                        </div>	
                                    </div>
                                </div><!-- /.row -->	
                            </div><!-- /.stock-container -->

                            <div class="stock-container info-container m-t-10" style="margin-bottom: 15px">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="stock-box">
                                            @if(session()->get('language') == 'bangla')
                                            <span >ব্র্যান্ড :</span>
                                            @else
                                            <span >Brand :</span>
                                            @endif
                                        </div>	
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="stock-box">
                                            <strong class="value">
                                                @if(session()->get('language') == 'bangla')
                                                <a class="pbrandbn"></a>
                                                @else
                                                <a class="pbranden"></a>
                                                @endif
                                            </strong>
                                        </div>	
                                    </div>
                                </div><!-- /.row -->	
                            </div><!-- /.stock-container -->

                            <span style="font-size: 16px; font-weight: 600; text-decoration: underline green;">
                                @if(session()->get('language') == 'bangla') মূল বৈশিষ্ট্যঃ @else Key Features: @endif
                            </span>
                            <div class="description-container m-t-20 ">
                                @if(session()->get('language') == 'bangla')
                                <span class="pshortdescpbn"></span>
                                @else
                                <span class="pshortdescpen"></span>
                                @endif
                            </div><!-- /.description-container -->
                            <hr>
                            <div class="price-container info-container m-t-20">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="price-box">
                                            @if(session()->get('language') == 'bangla')
                                            <span class="price pdiscountpricebn" style="font-size: 30px; font-weight: 700; line-height: 50px; color: #ff7878;"></span>
                                            @else
                                            <span class="price pdiscountpriceen" style="font-size: 30px; font-weight: 700; line-height: 50px; color: #ff7878;"></span>
                                            @endif
                                            @if(session()->get('language') == 'bangla')
                                            <span class="price-strike psellingpricebn " style="color: #aaa; font-size: 16px; font-weight: 300; line-height: 50px; text-decoration: line-through;"></span>
                                            @else
                                            <span class="price-strike psellingpriceen" style="color: #aaa; font-size: 16px; font-weight: 300; line-height: 50px; text-decoration: line-through;"></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="favorite-button m-t-10 btn-group">
                                            <button class="btn btn-primary icon" type="button"  >
                                                    <i class="fa fa-shopping-bag"></i>													
                                            </button>
                                            <button class="btn" style="border: 1px solid green;" > @if(session()->get('language') == 'bangla') এখনই ক্রয় করুন @else SHOP NOW @endif </button>
                                            
<!--                                            <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                            <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                                <i class="fa fa-signal"></i>
                                            </a>
                                            <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                                <i class="fa fa-envelope"></i>
                                            </a>-->
                                                
                                        </div>
                                    </div>

                                </div><!-- /.row -->

                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-12 form-group colorArea">
                                        <strong class="text-info"> @if(session()->get('language') == 'bangla') কালার নির্বাচন করুন @else Select a color @endif </strong>
                                        @if(session()->get('language') == 'bangla')
                                        <select class="form-control colorbn" name="pcolorbn"></select>
                                        @else
                                        <select class="form-control coloren" name="pcoloren"></select>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12 form-group sizeArea">
                                        <strong class="text-info"> @if(session()->get('language') == 'bangla') সাইজ নির্বাচন করুন @else Select a size @endif </strong>
                                        @if(session()->get('language') == 'bangla')
                                        <select class="form-control sizebn" name="psizebn"></select>
                                        @else
                                        <select class="form-control sizeen" name="psizeen"></select>
                                        @endif
                                    </div>
                                </div>

                            </div><!-- /.price-container -->
                            <hr>
                            <div class="quantity-container info-container">
                                <div class="row">

                                    <div class="col-sm-2">
                                        <span class="label" style="font-size: 14px; font-family: 'Open Sans', sans-serif; line-height: 35px; text-transform: uppercase; color: #666666; padding: 0px; font-weight: normal;">
                                            @if(session()->get('language') == 'bangla') পরিমাণ : @else Quantity : @endif
                                        </span>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="cart-quantity" style="display: block;">
                                            <div class="quant-input" style="display: inline-block; height: 35px; position: relative; width: 70px;">
                                                <div class="arrows" style="position: absolute;right: 0;top: 0;z-index: 2;height: 100%;">
                                                    <div class="arrow plus gradient" style="box-sizing: border-box; display: block; text-align: center; width: 40px; cursor: pointer;"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                    <div class="arrow minus gradient" style="box-sizing: border-box; display: block; text-align: center; width: 40px; cursor: pointer;"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                </div>
                                                <input type="text" class="qty" value="1" min="1" style="background: none repeat scroll 0 0 #fff; border: 1px solid #f2f2f2; box-sizing: border-box; font-size: 15px; height: 35px;left: 0; padding: 0 20px 0 18px; position: absolute; top: 0; width: 70px;z-index: 1;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="cart clearfix animate-effect" style="margin-top: 0px !important">
                                        <div class="action">
                                            <div class="add-cart-button btn-group">
                                                <input type="hidden" class="product_id">
                                                <button class="btn btn-primary icon" data-toggle="tooltip" type="button" onclick="addToCart()">
                                                    <i class="fa fa-shopping-cart"></i>													
                                                </button>
                                                <button class="btn btn-primary cart-btn" data-toggle="tooltip" type="button" onclick="addToCart()"> @if(session()->get('language') == 'bangla') কার্টে যুক্ত করুন @else ADD TO CART @endif </button>
                            
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                </div><!-- /.row -->
                            </div><!-- /.quantity-container -->

                        </div><!-- /.product-info -->
                    </div><!-- /.col-sm-7 -->
                    <!-- ==============================================================================================================  -->                        
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closemodal" data-dismiss="modal">@if(session()->get('language') == 'bangla') বন্ধ করুন @else Close @endif</button>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================= Product View Modal  : END ============================================================= -->


<!-- JavaScripts placed at the end of the document so the pages load faster -->
<!-- <script src="{{ asset('admin') }}/lib/popper.js/popper.js"></script>
<script src="{{ asset('admin') }}/lib/bootstrap/bootstrap.js"></script> -->


<script src="{{ asset('frontend') }}/assets/js/jquery-1.11.1.min.js"></script> 
<script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script>


<script src="{{ asset('frontend') }}/assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/owl.carousel.min.js"></script>

<script src="{{ asset('frontend') }}/assets/js/echo.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/jquery.easing-1.3.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/bootstrap-slider.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/jquery.rateit.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/lightbox.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/bootstrap-select.min.js"></script>
<script src="{{ asset('frontend') }}/assets/js/wow.min.js"></script>   
<script src="{{ asset('frontend') }}/assets/js/scripts.js"></script>
<script src="{{ asset('frontend') }}/assets/js/sweetalert2@8.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{ asset('common') }}/jquery.form-validator.min.js"></script>
<script>
    $.validate({
        lang: 'en'
    });
</script>

<!--============================== Start Toastr Script =============================================--->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
            var type = "{{Session::get('alert-type','info')}}"
            switch (type){
    case 'info':
            toastr.info(" {{Session::get('message')}} ");
    break;
    case 'success':
            toastr.success(" {{Session::get('message')}} ");
    break;
    case 'warning':
            toastr.warning(" {{Session::get('message')}} ");
    break;
    case 'error':
            toastr.error(" {{Session::get('message')}} ");
    break;
    }
    @endif
</script>
<!--==================================== End : Toastr Script =============================================--->

<script type="text/javascript">

            //English digit to Bangla digit 
            var numbersE = {
                    0:'০',
                    1:'১',
                    2:'২',
                    3:'৩',
                    4:'৪',
                    5:'৫',
                    6:'৬',
                    7:'৭',
                    8:'৮',
                    9:'৯'
                    };
                    function replaceNumbersE2B(input) {
                        var output = [];
                        for (var i = 0; i < input.length; ++i) {
                            if (numbersE.hasOwnProperty(input[i])) {
                                output.push(numbersE[input[i]]);
                            } else {
                                output.push(input[i]);
                            }
                        }
                        return output.join('');
                    }


<!--================================== Product View Modal Script =============================================--->
                $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })

                           function productView(id){
                           $.ajax({
                           type:'GET',
                           url:"{{ url('/product/view/modal/') }}/"+ id,
                           dataType:'json',
                           success:function(data){
                               //Name    
                               $('.pnamebn').text(data.product.product_name_bn);
                               $('.pnameen').text(data.product.product_name_en);
                               //Id
                               $('.product_id').val(id);
                               //Quantity
                               $('.qty').val(1);
                               //Short Description
                               $('.pshortdescpbn').html(data.product.short_descp_bn);
                               $('.pshortdescpen').html(data.product.short_descp_en);
                               //Price
                               $('.psellingpriceen').empty();
                               $('.pdiscountpriceen').empty();
                               $('.psellingpricebn').empty();
                               $('.pdiscountpricebn').empty();
                               if (data.product.discount_price != null){
                               $('.pdiscountpriceen').append('৳' + data.product.discount_price)
                               $('.psellingpriceen').append('৳' + data.product.selling_price)
                               $('.pdiscountpricebn').append('৳' + replaceNumbersE2B(data.product.discount_price))
                               $('.psellingpricebn').append('৳' + replaceNumbersE2B(data.product.selling_price))
                               } else{
                                $('.pdiscountpriceen').append('৳' + data.product.selling_price)
                                $('.pdiscountpricebn').append('৳' + replaceNumbersE2B(data.product.selling_price))
                               }

                               //Stock
                               if (data.product.product_qty > 0){
                                   $('.instockbn').text('মজুদ আছে')
                                   $('.instocken').text('In Stock')
                                   $('.stockoutbn').text('')
                                   $('.stockouten').text('')
                               } else{
                                   $('.stockoutbn').text('মজুদ নাই')
                                   $('.stockouten').text('Out of Stock')
                                   $('.instockbn').text('')
                                   $('.instocken').text('')
                               }

                               //Brand
                               $('.pbrandbn').text(data.product.brand.brand_name_bn);
                                $('.pbrandbn').attr('href', 'products/brand/' + data.product.brand.brand_slug_bn);
                                $('.pbranden').text(data.product.brand.brand_name_en);
                               $('.pbranden').attr('href', 'products/brand/' + data.product.brand.brand_slug_en);
                               //category
                               $('.pcaten').text(data.product.category.category_name_en);
                               $('.pcaten').attr('href', 'products/category/' + data.product.category.category_slug_en);
                               $('.pcatbn').text(data.product.category.category_name_bn);
                               $('.pcatbn').attr('href', 'products/category/' + data.product.category.category_slug_bn);
                               //sub-category
                               $('.psubcaten').text(data.product.subcategory.subcategory_name_en);
                               $('.psubcaten').attr('href', 'products/subcategory/' + data.product.subcategory.subcategory_slug_en);
                               $('.psubcatbn').text(data.product.subcategory.subcategory_name_bn);
                               $('.psubcatbn').attr('href', 'products/subcategory/' + data.product.subcategory.subcategory_slug_bn);
                               //sub-sub-category
                               $('.psubsubcaten').text(data.product.sub_subcategory.sub_subcategory_name_en);
                               $('.psubsubcaten').attr('href', 'products/sub-subcategory/' + data.product.sub_subcategory.sub_subcategory_slug_en);
                               $('.psubsubcatbn').text(data.product.sub_subcategory.sub_subcategory_name_bn);
                               $('.psubsubcatbn').attr('href', 'products/sub-subcategory/' + data.product.sub_subcategory.sub_subcategory_slug_bn);
                               //color
                               $('select[name="pcoloren"]').empty();
                               $.each(data.colors_en, function(key, value){
                               $('select[name="pcoloren"]').append('<option value="' + value + '" >' + value + '</option>')
                                       if (data.colors_en == ''){
                               $('.colorArea').hide();
                               } else{
                               $('.colorArea').show();
                               }
                               })
                               $('select[name="pcolorbn"]').empty();
                               $.each(data.colors_bn, function(key, value){
                               $('select[name="pcolorbn"]').append('<option value="' + value + '" >' + value + '</option>')
                               if (data.colors_bn == ''){
                                    $('.colorArea').hide();
                               } else{
                                    $('.colorArea').show();
                               }
                               })

                               //size
                               $('select[name="psizeen"]').empty();
                               $.each(data.sizes_en, function(key, value){
                               $('select[name="psizeen"]').append('<option value="' + value + '" >' + value + '</option>')
                               if (data.sizes_en == ''){
                                    $('.sizeArea').hide();
                               } else{
                                    $('.sizeArea').show();
                               }
                               })
                               $('select[name="psizebn"]').empty();
                               $.each(data.sizes_bn, function(key, value){
                               $('select[name="psizebn"]').append('<option value="' + value + '" >' + value + '</option>')
                                if (data.sizes_bn == ''){
                                     $('.sizeArea').hide();
                                 } else{
                                     $('.sizeArea').show();
                                 }
                                })

                               //Thumbnail
                                $('.pthumbnail').attr('src', "{{ asset('uploads/product/thumbnail/') }}/" + data.product.product_thumbnail);
                               //Multi Images
                               $.each(data.multipleimg, function(key, value){
                               $('.pmultiimg').attr('src', "{{ asset('uploads/product/multiple-image/') }}/" + value.product_image);
                               })


                           }
                       })
                   }
<!--===================================== End : Product View Modal Script =============================================--->
<!--===================================== Add to Cart =============================================--->
                    function addToCart(){
                        var id = $('.product_id').val();
                        var qty = $('.qty').val();
                        var coloren = $('.coloren option:selected').text();
                        var colorbn = $('.colorbn option:selected').text();
                        var sizeen = $('.sizeen option:selected').text();
                        var sizebn = $('.sizebn option:selected').text();
                        $.ajax({
                                type:'POST',
                                url: "{{ url('/cart/data/store/') }}/"+ id,
                                dataType:'json',
                                data:{
                                qty:qty, coloren:coloren, colorbn:colorbn, sizeen:sizeen, sizebn:sizebn,
                                },
                                success:function(data){
                                miniCart();
                                $('.closemodal').click();
                                //  start message
                                const Toast = Swal.mixin({
                                toast: true,
                                        icon: 'success',
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                })
                                if ($.isEmptyObject(data.error)){
                                Toast.fire({
                                type: 'success',
                                title: data.success
                                })
                                } else{
                                Toast.fire({
                                type: 'error',
                                title: data.error
                                })
                                }
                                //  end message
                                }
                        })

            }
<!--====================================== End :  Add to Cart  =============================================--->
 
<!--====================================== Mini Cart Product Show =============================================--->
    function miniCart(){
                $.ajax({
                    type:'GET',
                    url:"{{ url('/product/mini/cart/') }}",
                    dataType:'json',
                    success:function(response){
                        $('.cartQtyen').text(response.cart_qty)
                        $('.cartQtybn').text(response.cart_qtybn)
                        $('.cart_totalen').text('৳' + response.cart_total)
                        $('.cart_totalbn').text('৳' + replaceNumbersE2B(response.cart_total))
                        var miniCart = ""
                        if(response.carts != ''){
                        $.each(response.carts,function(key, value){
                            miniCart += `<hr style="padding: 0px !important; margin: 5px 0px !important;">
                                        <div class="cart-item product-summary">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="image">
                                                    @if(session()->get('language') == 'bangla')
                                                        <a href="{{url('products/')}}/${value.options.slugbn}"><img src="{{ asset('uploads/product/thumbnail/') }}/${value.options.thumbnail}" alt=""></a>
                                                    @else
                                                        <a href="{{url('products/')}}/${value.options.slugen}"><img src="{{ asset('uploads/product/thumbnail/') }}/${value.options.thumbnail}" alt=""></a>
                                                    @endif
                                                </div>
                                                </div>
                                                <div class="col-xs-7">
                                                @if(session()->get('language') == 'bangla')
                                                    <h3 class="name"><a href="{{url('products/')}}/${value.options.slugbn}">${value.options.namebn}</a></h3>
                                                @else
                                                    <h3 class="name"><a href="{{url('products/')}}/${value.options.slugen}">${value.options.nameen}</a></h3>
                                                @endif
                                                <div class="price"> @if(session()->get('language') == 'bangla') ৳${value.options.pricebn} * ${value.options.qtybn} @else ৳${value.price} * ${value.qty} @endif </div>
                                                </div>
                                                <div class="col-xs-1 action">
                                                    <button type="submit" id="${value.rowId}" onclick="cartProductRemove(this.id)"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                     <div class="clearfix"></div>`
                        });
                        }else{
                        miniCart += `<hr style="padding: 0px !important; margin: 0px !important;"><br>
                                    <strong class="text-danger"><p class="text-center"> 
                                    @if(session()->get('language') == 'bangla') আপনার কার্ট টি খালি !! @else Your Cart is Empty !! @endif 
                                    </p></strong>`   
                        }
                        $('#miniCart').html(miniCart);
                    }
                })
                
            }   
            miniCart();
<!--============================== End: Mini Cart Product Show =============================================--->

<!--============================== View Cart Page =============================================--->
    function cartPageView(){
                $.ajax({
                    type:'GET',
                    url:"{{ url('/carts/view/ajax') }}",
                    dataType:'json',
                    success:function(response){
                        $('.cartTotalPrice').text('৳'+response.cart_total)
                        var rows = ""       
                        if(response.carts != ''){
                        $.each(response.carts,function(key, value){
                           
                            rows += `<tr class="text-center">
                                        <td style="padding: 5px !important">
                                            <img src="{{ asset('uploads/product/thumbnail/') }}/${value.options.thumbnail}" alt="photo" style="height: 100px; width: auto !important;">
                                        </td>
                                        <td style="padding: 0px !important">
                                            @if(session()->get('language')=='bangla')
                                             <div class="product-name"><a href="{{url('products/')}}/${value.options.slugbn}"><h4>${value.options.namebn}</h4></a></div>                               
                                             @else                               
                                            <div class="product-name"><a href="{{url('products/')}}/${value.options.slugen}"><h4>${value.options.nameen}</h4></a></div>
                                            @endif
                                        </td>
                                        <td style="padding: 5px !important">
                                            ${ value.options.coloren == null && value.options.colorbn == null
                                            ? `<b>---</b>`
                                            :
                                                `${ value.options.colorbn == null 
                                                ? `<b>${value.options.coloren}</b>`
                                                : `<b>${value.options.colorbn}</b>`
                                                }` 
                                            } 
                                        </td>
                                        <td style="padding: 5px !important">
                                            ${ value.options.sizeen == null && value.options.sizebn == null
                                            ? `<b>---</b>`
                                            :
                                                `${ value.options.sizebn == null 
                                                ? `<b>${value.options.sizeen}</b>`
                                                : `<b>${value.options.sizebn}</b>`
                                                } `
                                            } 
                                        </td>   
                                        <td>
                                            @if(session()->get('language') == 'bangla')
                                            <h4 class="price">৳${value.options.pricebn}</h4>
                                            @else
                                            <h4 class="price">৳${value.price}</h4>
                                            @endif
                                        </td>
                                        <td style="padding: 0px !important">
                                            <div class="btn-group">
                                            ${value.qty > 1 
                                            ? `<button class="btn btn-sm" style="border: 1px solid grey" id="${value.rowId}" onclick="cartQtyDecrement(this.id)"><strong>-</strong></button>`
                                            : `<button class="btn btn-sm" style="border: 1px solid grey"><strong>-</strong></button>`
                                            }                                

                                            <button class="btn btn-sm" style="border: 1px solid grey" disabled ><strong style="color: red">${value.qty}</strong></button> 
                                            <button class="btn btn-sm" style="border: 1px solid grey" id="${value.rowId}" onclick="cartQtyIncrement(this.id)"><strong>+</strong></button>  
                                            </div>
                                        </td> 
                                        <td>
                                           <h4 class="price">৳${ value.price*value.qty }</h4>
                                        </td>
                                        <td class="close-btn">
                                            <button type="submit" id="${ value.rowId }" onclick="cartProductRemove(this.id)" ><i class="fa fa-times"></i></button>
                                        </td>

                                    </tr>`
                        });
                            
                        }else{
                        
                        rows += `<tr>
                                    <td colspan="8">
                                        <h2 class="text-center text-danger">
                                        <img src="{{ asset('frontend/assets/images/empty-shopping.png') }}" class="img img-center" style="height: 300px; width: auto" alt="" >
                                        @if(session()->get('language') == 'bangla') 
                                        কোন পণ্য পাওয়া যায়নি!
                                        @else
                                        No Product Found!
                                        @endif
                                        </h2>
                                    </td>
                                 </tr>`   
                        }
                        $('#allCarts').html(rows);
                        
                    }
                })
                
            }   
            cartPageView();
<!--============================== End: View Cart Page =============================================--->

<!--============================== Cart Product Remove =============================================--->
            function cartProductRemove(rowId){
                $.ajax({
                    type:'GET',
                    url:"{{ url('/cart/product/remove/') }}/"+rowId,
                    dataType:'json',
                    success:function(data){
                    cartPageView();
                    couponDataShow();
                    miniCart();
                    //  start message
                        const Toast = Swal.mixin({
                               toast: true,
                               icon: 'success',
                               position: 'top-end',
                               showConfirmButton: false,
                               timer: 3000
                             })
                            if($.isEmptyObject(data.error)){
                                 Toast.fire({
                                   type: 'success',
                                   title: data.success
                                 })
                            }else{
                                  Toast.fire({
                                     type: 'error',
                                     title: data.error
                                 })
                            }
                        //  end message
                        
                    }
                })
                
            }
<!--============================== End: Cart Product Remove =============================================--->

<!--============================== Cart Product Increment =============================================--->
            function cartQtyIncrement(rowId){
                $.ajax({
                    type:'GET',
                    url:"{{ url('/cart/product/increment/') }}/"+rowId,
                    dataType:'json',
                    success:function(data){
                    miniCart();
                    cartPageView();
                    couponDataShow();
                    //  start message
                        const Toast = Swal.mixin({
                               toast: true,
                               icon: 'success',
                               position: 'top-end',
                               showConfirmButton: false,
                               timer: 3000
                             })
                            if($.isEmptyObject(data.error)){
                                 Toast.fire({
                                   type: 'success',
                                   title: data.success
                                 })
                            }else{
                                  Toast.fire({
                                     type: 'error',
                                     title: data.error
                                 })
                            }
                        //  end message
                        
                    }
                })
                
            }
<!--============================== End: Cart Product Increment =============================================--->

<!--============================== Cart Product Decrement =============================================--->
            function cartQtyDecrement(rowId){
                $.ajax({
                    type:'GET',
                    url:"{{ url('/cart/product/decrement/') }}/"+rowId,
                    dataType:'json',
                    success:function(data){
                    miniCart();
                    cartPageView();
                    couponDataShow();
                    //  start message
                        const Toast = Swal.mixin({
                               toast: true,
                               icon: 'success',
                               position: 'top-end',
                               showConfirmButton: false,
                               timer: 3000
                             })
                            if($.isEmptyObject(data.error)){
                                 Toast.fire({
                                   type: 'success',
                                   title: data.success
                                 })
                            }else{
                                  Toast.fire({
                                     type: 'error',
                                     title: data.error
                                 })
                            }
                        //  end message
                        
                    }
                })
                
            }
<!--============================== End: Cart Product Decrement =============================================--->

 <!--============================== Add to Wishlist Product =============================================--->
    function addToWishlist(id){
            
                $.ajax({
                    type:'POST',
                    url: "{{ url('/wishlist/data/store/') }}/"+id,
                    dataType:'json',
                    success:function(data){
                        //  start message
                        const Toast = Swal.mixin({
                               toast: true,
                               position: 'top-end',
                               showConfirmButton: false,
                               timer: 5000
                             })
                            if($.isEmptyObject(data.error)){
                                 Toast.fire({
                                   type: 'success',
                                   title: data.success
                                 })
                            }else{
                                  Toast.fire({
                                     type: 'error',
                                     title: data.error
                                 })
                                                }
                        //  end message
                    }
                }) 
    }
    <!--============================== End: Add to Wishlist Product =============================================--->

    <!--============================== View Wishlist Page =============================================--->
    function wishlistPageView(){
                $.ajax({
                    type:'GET',
                    url:"{{ url('/user/wishlists/view/ajax') }}",
                    dataType:'json',
                    success:function(response){
                        var rows = ""
                        if(response != ''){
                        $.each(response,function(key, value){
                           
                            rows += `<tr>
                                    <td class="col-md-2"><img src="{{ asset('uploads/product/thumbnail/') }}/${value.product.product_thumbnail}" alt="photo"></td>
                                    <td class="col-md-7">
                                        @if(session()->get('language')=='bangla')
                                         <div class="product-name"><a href="{{url('products/')}}/${value.product.product_slug_bn}">${value.product.product_name_bn}</a></div>                               
                                         @else                               
                                        <div class="product-name"><a href="{{url('products/')}}/${value.product.product_slug_en}">${value.product.product_name_en}</a></div>
                                        @endif
                                        <div class="rating">
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star rate"></i>
                                            <i class="fa fa-star non-rate"></i>
                                            <span class="review">( 06 Reviews )</span>
                                        </div>
                                        @if(session()->get('language') == 'bangla')
                                        <div class="price">
                                            ${ value.product.discount_price == null 
                                            ? `৳${ replaceNumbersE2B(value.product.selling_price) }`
                                            : `৳${ replaceNumbersE2B(value.product.discount_price) }
                                                <span>৳${ replaceNumbersE2B(value.product.selling_price) }</span>`
                                            }
                                        </div>
                                        @else
                                        <div class="price">
                                            ${ value.product.discount_price == null 
                                            ? `৳${ value.product.selling_price}`
                                            : `৳${ value.product.discount_price}
                                                <span>৳${ value.product.selling_price}</span>`
                                            }
                                        </div>
                                        @endif
                                    </td>
                                    <td class="col-md-2">
                                        <button  data-toggle="modal" data-target="#exampleModal" class="btn-upper btn btn-primary" type="button" id="${ value.product_id }" onclick="productView(this.id)">
                                           @if(session()->get('language') == 'bangla') কার্টে যুক্ত করুন @else Add to cart @endif 													
                                       </button>
                                    </td>
                                    <td class="col-md-1 close-btn">
                                        <button type="submit" id="${ value.id }" onclick="wishlistProductRemove(this.id)"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>`
                        });
                        }else{
                        rows += `<tr>
                                    <td colspan="8">
                                        <h2 class="text-center text-danger">
                                                                <img src="{{ asset('frontend/assets/images/empty-shopping.png') }}" class="img img-center" style="height: 300px; width: auto" alt="" >
                                        @if(session()->get('language') == 'bangla') 
                                        কোন পণ্য পাওয়া যায়নি!
                                        @else
                                        No Product Found!!
                                        @endif
                                        </h2>
                                    </td>
                                 </tr>`   
                        }
                        $('#allWishlists').html(rows);
                    }
                })
                
            }   
            wishlistPageView();
<!--============================== End: View Wishlist Page =============================================--->

<!--============================== Wishlist Product Remove =============================================--->
            function wishlistProductRemove(id){
                $.ajax({
                    type:'GET',
                    url:"{{ url('/user/wishlist/product/remove/') }}/"+id,
                    dataType:'json',
                    success:function(data){
                    wishlistPageView();
                    //  start message
                        const Toast = Swal.mixin({
                               toast: true,
                               icon: 'success',
                               position: 'top-end',
                               showConfirmButton: false,
                               timer: 3000
                             })
                            if($.isEmptyObject(data.error)){
                                 Toast.fire({
                                   type: 'success',
                                   title: data.success
                                 })
                            }else{
                                  Toast.fire({
                                     type: 'error',
                                     title: data.error
                                 })
                            }
                        //  end message
                        
                    }
                })
                
            }
<!--============================== End: Wishlist Product Remove =============================================--->

</script>

@yield('scripts')

<script>
       
<!--==============================  Apply Coupon =============================================--->
        function applyCoupon(){
            var coupon_code = $('#coupon_code').val();
            if(coupon_code != ''){
                $.ajax({
                    type:'POST',
                    url:"{{ url('/coupon-apply') }}",
                    dataType:'json',
                    data: {coupon_code:coupon_code},
                    success:function(data){
                        cartPageView()
                        couponDataShow();
                    //  start message
                        const Toast = Swal.mixin({
                               toast: true,
                               icon: 'success',
                               position: 'top-end',
                               showConfirmButton: false,
                               timer: 3000
                             })
                            if($.isEmptyObject(data.error)){
                                 Toast.fire({
                                   type: 'success',
                                   title: data.success
                                 })
                            }else{
                                $('#coupon_code').val('');
                                  Toast.fire({
                                     type: 'error',
                                     title: data.error
                                 })
                            }
                        //  end message
                        
                    }
                })
            }else{
                $('#coupon_code').val('Enter a Coupon');
            }
                
        }
<!--============================== End: Apply Coupon =============================================--->

<!--============================== Coupon Data Show =============================================--->
          function couponDataShow(){
                        $.ajax({
                            type:'GET',
                            url:"{{ url('/coupon-Data-Show') }}",
                            dataType:'json',
                            success:function(data){
                                
                                if(data.coupon_code){
                                    $('#couponArea').hide();
                                    $('#couponDataShow').html(`
                                        <tr>
                                            <th>
                                                <div class="cart-sub-total row">
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') মোট @else Total @endif</span>
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') ৳${data.cart_totalbn} @else ৳${data.cart_total} @endif</span>
                                                </div>
                                                <div class="cart-sub-total row">
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') কুপন কোড @else Coupon Code @endif</span>
                                                    <span class="col-md-6">${ data.coupon_code }
                                                    <a onclick="couponRemove()" style="color: red; cursor: pointer;" title="@if(session()->get('language')=='bangla') কুপন সরান @else Remove Coupon @endif"><i class="fa fa-times"></i></a>
                                                    </span>    
                                                </div>
                                                <div class="cart-sub-total row">
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') ছাড় @else Discount @endif</span>
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') ${ data.coupon_discountbn }% @else ${ data.coupon_discount }% @endif</span>
                                                </div>
                                                <div class="cart-sub-total row">
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') হ্রাসকৃত মুল্য @else Discount Amount @endif</span>
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') ৳${ data.discount_amountbn } @else ৳${ data.discount_amount } @endif</span>
                                                </div>
                                                <div class="cart-grand-total hasCoupon row">
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') সর্বমোট @else Grand Total @endif</span>
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') ৳${ data.amount_after_discountbn } @else ৳${ data.amount_after_discount } @endif</span>
                                                </div>
                                            </th>
                                        </tr>
                                    `)
                                }else{
                                    $('#couponArea').show();
                                    $('#coupon_code').val('');
                                    $('#couponDataShow').html(`
                                        <tr>
                                            <th>
                                                <div class="cart-grand-total hasCoupon row">
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') সর্বমোট @else Grand Total @endif</span>
                                                    <span class="col-md-6">@if(session()->get('language')=='bangla') ৳${data.cart_totalbn} @else ৳${data.cart_total} @endif</span>
                                                </div>
                                            </th>
                                        </tr>
                                    `)
                                }    
                            }
                        })
          
    }
    couponDataShow();
<!--============================== End: Coupon Data Show =============================================--->

<!--============================== Coupon Remove =============================================--->
        function couponRemove(){
                        $.ajax({
                            type:'GET',
                            url:"{{ url('/coupon-remove') }}",
                            dataType:'json',
                            success:function(data){
                            couponDataShow();
                            cartPageView();
                            
                            }
                        }) 
        }
<!--============================== End: Coupon Remove =============================================--->
             
</script>

<script type="text/javascript">
    $("body").on("keyup","#search",function () {
        let searchData = $("#search").val();
        if (searchData.length > 0) {
            $.ajax({
            type:'POST',
            url: "{{ url('/search-products-ajax') }}",
            data:{search:searchData},
            success:function(data){
                $('#suggestProduct').html(data)
            }
            });
        }else{
            $('#suggestProduct').html("");
        }
    })
</script>

<script>
    function showSearchResult(){
        $('#suggestProduct').slideDown();
    }
    function hideSearchResult(){
        $('#suggestProduct').slideUp();
    }
</script>


</body>

</html>