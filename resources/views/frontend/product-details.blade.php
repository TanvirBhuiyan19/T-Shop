@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title')  
@if(session()->get('language') == 'bangla') {{$product->product_name_bn}} @else {{$product->product_name_en}} @endif 
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection


@section('meta') 
<meta property="og:title" content="@if(session()->get('language') == 'bangla') {{$product->product_name_bn}} @else {{$product->product_name_en}} @endif" />
<meta property="og:url" content="{{ Request::fullUrl() }}" />
<meta property="og:image" content="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" />
<meta property="og:description" content="@if(session()->get('language') == 'bangla') {{ $product->short_descp_bn }} @else {{ $product->short_descp_en }} @endif" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
@endsection


@section('content')

@php
function bn_price($data){
$en = array(0,1,2,3,4,5,6,7,8,9);
$bn = array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
$result = str_replace($en, $bn, $data);
return $result;
}
@endphp


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'bangla')
                <li><a href="{{url('/')}}">হোম</a></li>
                <li><a href="{{url('products/category/'.$product->category->category_slug_bn)}}">{{$product->category->category_name_bn}}</a></li>
                <li><a href="{{url('products/subcategory/'.$product->subcategory->subcategory_slug_bn)}}">{{$product->subcategory->subcategory_name_bn}}</a></li>     
                <li><a href="{{url('products/sub-subcategory/'.$product->sub_subcategory->sub_subcategory_slug_bn)}}">{{$product->sub_subcategory->sub_subcategory_name_bn}}</a></li>     
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('products/category/'.$product->category->category_slug_en)}}">{{$product->category->category_name_en}}</a></li>
                <li><a href="{{url('products/subcategory/'.$product->subcategory->subcategory_slug_en)}}">{{$product->subcategory->subcategory_name_en}}</a></li>
                <li><a href="{{url('products/sub-subcategory/'.$product->sub_subcategory->sub_subcategory_slug_en)}}">{{$product->sub_subcategory->sub_subcategory_name_en}}</a></li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->


    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-3 sidebar'>
                    <!-- ============================================== HOT DEALS ============================================== -->
                    @include('frontend.include.leftbar.hot-deals')
                    <!-- ============================================== HOT DEALS: END ============================================== -->                   
                    @include('frontend.include.leftbar.brands')
                    @include('frontend.include.leftbar.colors')
                </div><!-- /.sidebar -->

                <div class='col-md-9'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">

                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">

                                        <div class="single-product-gallery-item" id="slide1">
                                            <img class="img-responsive" alt="" src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" data-echo="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" />
                                        </div> <!--  /.single-product-gallery-item -->
                                        @php
                                        $multipleimg = App\Models\ProductMultiImg::where('product_id',$product->id)->get();
                                        @endphp
                                        @foreach($multipleimg as $multiple_image)
                                        <div class="single-product-gallery-item" id="slide{{$multiple_image->id}}">
                                            <img class="img-responsive" alt="" src="{{ asset('frontend') }}/assets/images/blank.gif" data-echo="{{ asset('uploads/product/multiple-image/') }}/{{$multiple_image->product_image}}" />
                                        </div><!-- /.single-product-gallery-item -->
                                        @endforeach

                                    </div><!-- /.single-product-slider -->


                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">

                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="0" href="#slide{{$multiple_image->id}}">
                                                    <img class="img-responsive" width="85" alt="" src="{{ asset('frontend') }}/assets/images/blank.gif" data-echo="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" />
                                                </a>
                                            </div>

                                            @php
                                            $multipleimg = App\Models\ProductMultiImg::where('product_id',$product->id)->get();
                                            $slide = 1;
                                            @endphp
                                            @foreach($multipleimg as $multiple_image)
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="{{$slide}}" href="#slide{{$multiple_image->id}}">
                                                    <img class="img-responsive" width="85" alt="" src="{{ asset('frontend') }}/assets/images/blank.gif" data-echo="{{ asset('uploads/product/multiple-image/') }}/{{$multiple_image->product_image}}" />
                                                </a>
                                            </div>
                                            @php
                                            $slide = $slide+1;
                                            @endphp

                                            @endforeach

                                        </div><!-- /#owl-single-product-thumbnails -->
                                    </div><!-- /.gallery-thumbs -->
                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->  


                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name" style="font-size: 25px !important"> @if(session()->get('language') == 'bangla') {{$product->product_name_bn}} @else {{$product->product_name_en}} @endif </h1>

                                    <div class="rating-reviews m-t-20">
                                        <span class="summary">
                                            @for($i=1; $i<=5; $i++)
                                            <span class="glyphicon glyphicon-star{{ ($i <= $avgCeilRating) ? '' : '-empty' }}" style="color: #F9C922"></span>
                                            @endfor
                                            @if( count($product_reviews)!=0 )
                                            <b style="margin-left: 10px">({{$avgRating}} / 5)</b>
                                            ({{count($product_reviews)}} Reviews)
                                            @else
                                            <b style="margin-left: 10px">
                                                @if(session()->get('language') == 'bangla') (রিভিউ পাওয়া যায়নি) @else (No Reviews) @endif
                                            </b>
                                            @endif
                                        </span>

                                    </div><!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label"> @if(session()->get('language') == 'bangla') উপস্থিতি : @else Availability : @endif </span>
                                                </div>	
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    @if($product->product_qty)
                                                    <strong class="text-success"> @if(session()->get('language') == 'bangla') মজুদ আছে @else In Stock @endif </strong>
                                                    @else
                                                    <strong class="value"> @if(session()->get('language') == 'bangla') মজুদ নাই @else Out of Stock @endif </strong>
                                                    @endif 
                                                </div>	
                                            </div>
                                        </div><!-- /.row -->	
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        @if(session()->get('language') == 'bangla') {!! $product->short_descp_bn !!} @else {!! $product->short_descp_en !!} @endif
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if($product->discount_price != NULL)
                                                    <span class="price"> @if(session()->get('language') == 'bangla') ৳{{ bn_price($product->discount_price) }} @else ৳{{ $product->discount_price }} @endif </span>
                                                    <span class="price-strike"> @if(session()->get('language') == 'bangla') ৳{{ bn_price($product->selling_price) }} @else ৳{{ $product->selling_price }} @endif </span>
                                                    @else
                                                    <span class="price"> @if(session()->get('language') == 'bangla') ৳{{ bn_price($product->selling_price) }} @else ৳{{ $product->selling_price }} @endif </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
    <!--                                            <div class=" m-t-10 add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" type="button" id="{{$product->id}}" onclick="addToWishlist(this.id)" >
                                                        <i class="fa fa-heart"></i>													
                                                    </button>
                                                    <button class="btn" style="border: 1px solid green;"  id="{{$product->id}}" onclick="addToWishlist(this.id)"> @if(session()->get('language') == 'bangla') ইচ্ছেতালিকায় যুক্ত করুন @else ADD TO WISHLIST @endif </button>                                              
                                                </div>-->

                                                <!--    Product Share-->
                                                <div class="sharethis-inline-share-buttons" data-href="{{ Request::url() }}"></div>
                                            </div>
                                        </div><!-- /.row -->

                                        <div class="row">
                                            @if($product->product_color_en != NULL)
                                            <div class="col-md-6 col-lg-6 col-sm-12 form-group">
                                                <strong> @if(session()->get('language') == 'bangla') কালার নির্বাচন করুন @else Select a color @endif </strong>
                                                @if(session()->get('language') == 'bangla')
                                                <select class="form-control colorbn">
                                                    @foreach($colors_bn as $color)
                                                    <option value="{{$color}}">{{$color}}</option>
                                                    @endforeach
                                                </select>
                                                @else
                                                <select class="form-control coloren">
                                                    @foreach($colors_en as $color)
                                                    <option value="{{$color}}">{{$color}}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            </div>
                                            @endif
                                            @if($product->product_size_en != NULL)
                                            <div class="col-md-6 col-lg-6 col-sm-12 form-group">
                                                <strong> @if(session()->get('language') == 'bangla') সাইজ নির্বাচন করুন @else Select a size @endif </strong>
                                                @if(session()->get('language') == 'bangla')
                                                <select class="form-control sizebn">
                                                    @foreach($sizes_bn as $size)
                                                    <option value="{{$size}}">{{$size}}</option>
                                                    @endforeach
                                                </select>
                                                @else
                                                <select class="form-control sizeen">
                                                    @foreach($sizes_en as $size)
                                                    <option value="{{$size}}">{{$size}}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            </div>
                                            @endif
                                        </div>

                                    </div><!-- /.price-container -->

                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <span class="label"> @if(session()->get('language') == 'bangla') পরিমাণ : @else Quantity : @endif </span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
                                                        <input type="text" class="qty" value="1" min="1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-5">
                                                <input type="hidden" class="product_id" value="{{ $product->id }}">
                                                <button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> @if(session()->get('language') == 'bangla') কার্টে যুক্ত করুন @else ADD TO CART @endif </button>
                                            </div>
            {{--=============================== Chat Button =====================================--}}
                                            @auth
                                            <div class="col-sm-1" id="app">
                                                <send-message :product-id={{ $product->id }}></send-message>
                                            </div>
                                            @else
                                            <a href="{{ url('/login') }}"><h1 title="Login to message Admin" style="cursor: pointer; color: red; padding: 0px; margin: -5px;"><i class="fa fa-commenting"></i></h1></a>
                                            @endauth
            {{--=============================== Chat Button =====================================--}}

                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->

                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description"> @if(session()->get('language') == 'bangla') বর্ণনা @else DESCRIPTION @endif </a></li>
                                    <li><a data-toggle="tab" href="#review"> @if(session()->get('language') == 'bangla') রিভিউ @else REVIEW @endif </a></li>
                                    <li><a data-toggle="tab" href="#tags"> @if(session()->get('language') == 'bangla') ট্যাগসমুহ @else TAGS @endif </a></li>
                                    <li><a data-toggle="tab" href="#comments"> @if(session()->get('language') == 'bangla') কমেন্টগুলো @else Comments @endif </a></li>
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text"> @if(session()->get('language') == 'bangla') {!! $product->long_descp_bn !!} @else {!! $product->long_descp_en !!} @endif</p>
                                        </div>	
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            @foreach($product_reviews as $product_review)
                                            <div class="product-reviews">
                                                <div class="container">
                                                    <div class="row">
                                                        <img  src="{{ asset('frontend/assets/images/users/'.$product_review->user->image) }}" style="float: left; margin-right: 10px;" alt="" class="img-circle" width="30">
                                                        <h4 class="title"> {{$product_review->user->name}} </h4>
                                                    </div>
                                                </div>

                                                <div class="reviews">
                                                    <div class="review">
                                                        <div class="review-title">
                                                            <span class="summary">
                                                                @for($i=1; $i<=5; $i++)
                                                                <span class="glyphicon glyphicon-star{{ ($i <= $product_review->rating) ? '' : '-empty' }}" title="{{$product_review->rating}} Star" style="color: #F9C922"></span>
                                                                @endfor
                                                            </span>
                                                            <span class="date"><i class="fa fa-calendar"></i><span>{{$product_review->created_at->diffForHumans()}}</span></span>
                                                        </div>
                                                        <div class="text">"{{$product_review->comment}}"</div>

                                                    </div>
                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->
                                            @endforeach

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                    <div id="tags" class="tab-pane" style="padding-left: 0px">
                                        <div class="product-tag">

                                            <div class="sidebar-widget product-tag wow fadeInUp">
                                                <h3 class="section-title"> @if(session()->get('language') == 'bangla' ) পন্যের ট্যাগসমুহ @else Product tags @endif </h3>
                                                <div class="sidebar-widget-body outer-top-xs">
                                                    <div class="tag-list">					
                                                        @if(session()->get('language') == 'bangla' )  
                                                        @foreach($tags_bn as $tag)
                                                        <a class="item " title="{{ $tag }}" href="{{ url('products/tag/'.$tag) }}">{{ $tag }}</a>
                                                        @endforeach
                                                        @else
                                                        @foreach($tags_en as $tag)
                                                        <a class="item " title="{{ $tag }}" href="{{ url('products/tag/'.$tag) }}">{{ $tag }}</a>
                                                        @endforeach
                                                        @endif
                                                    </div><!-- /.tag-list -->
                                                </div><!-- /.sidebar-widget-body -->
                                            </div><!-- /.sidebar-widget -->

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->


                                    <div id="comments" class="tab-pane">
                                        <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5"></div>
                                    </div>


                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

                    <!-- ============================================== Related PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title"> @if(session()->get('language') == 'bangla') সংশ্লিষ্ট পণ্য @else Related products @endif </h3>
                        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

                            @forelse($subcatwise_products as $product)
                            <div class="item item-carousel">
                                <div class="products">

                                    <div class="product">		
                                        <div class="product-image">
                                            <div class="image">
                                                @if(session()->get('language') == 'bangla')
                                                <a href="{{url('products/'.$product->product_slug_bn)}}"><img  src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" alt=""></a>
                                                @else
                                                <a href="{{url('products/'.$product->product_slug_en)}}"><img  src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" alt=""></a>
                                                @endif
                                            </div><!-- /.image -->			

                                            @if($product->discount_price)

                                            @php 
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount / $product->selling_price) * 100;
                                            @endphp

                                            @if($discount < 25)
                                            <div class="tag sale"><strong> @if(session()->get('language') == 'bangla') {{ bn_price(round($discount)) }}% @else {{ round($discount) }}% @endif </strong></div>
                                            @else
                                            <div class="tag hot"><strong>  @if(session()->get('language') == 'bangla') {{ bn_price(round($discount)) }}%  @else {{ round($discount) }}% @endif </strong></div>
                                            @endif

                                            @else 
                                            <div class="tag new"><span> @if(session()->get('language') == 'bangla') নতুন @else new @endif </span></div>
                                            @endif
                                        </div><!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name">
                                                @if(session()->get('language') == 'bangla')
                                                <a href="{{url('products/'.$product->product_slug_bn) }}">{{$product->product_name_bn}}</a>
                                                @else 
                                                <a href="{{url('products/'.$product->product_slug_en) }}">{{$product->product_name_en}} </a>
                                                @endif
                                            </h3>
                                            @if(App\Models\ProductReview::where('product_id', $product->id)->where('status','Approve')->first())                                            
                                                @php                                            
                                                $product_reviews = App\Models\ProductReview::with('user')->where('product_id', $product->id)->where('status','Approve')->latest()->get();                                            
                                                $rating = App\Models\ProductReview::where('product_id', $product->id)->where('status','Approve')->avg('rating');                                            
                                                $avgRating = number_format($rating,1);                                            
                                                @endphp                                            
                                                <span class="summary">                                            
                                                    @for($i=1; $i<=5; $i++)                                            
                                                    <span class="glyphicon glyphicon-star{{ ($i <= $avgRating) ? '' : '-empty' }}" style="color: #F9C922" title="{{$avgRating}} / 5"></span>                                            
                                                    @endfor                                            
                                                    (</b>{{count($product_reviews)}} Reviews)                                            
                                                </span>                                        
                                            @else                                            
                                                @for($i=1; $i<=5; $i++)                                            
                                                <span class="glyphicon glyphicon-star-empty" style="color: #F9C922" title="No review"></span>                                            
                                                @endfor                                        
                                            @endif 
                                            <div class="description"></div>

                                            <div class="product-price">	
                                                @if($product->discount_price != NULL)
                                                <span class="price"> @if(session()->get('language') == 'bangla') ৳{{ bn_price($product->discount_price) }} @else ৳{{ $product->discount_price }} @endif </span>
                                                <span class="price-before-discount"> @if(session()->get('language') == 'bangla') ৳ {{ bn_price($product->selling_price) }} @else ৳ {{ $product->selling_price }} @endif </span>
                                                @else
                                                <span class="price"> @if(session()->get('language') == 'bangla') ৳{{ bn_price($product->selling_price) }} @else ৳{{ $product->selling_price }} @endif </span>
                                                @endif

                                            </div><!-- /.product-price -->

                                        </div><!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary icon" type="button"  id="{{$product->id}}" onclick="productView(this.id)" title=" @if(session()->get('language') == 'bangla') কার্টে যুক্ত করুন @else Add Cart @endif ">
                                                            <i class="fa fa-shopping-cart"></i>													
                                                        </button>
                                                        <button class="btn btn-primary cart-btn" type="button"> @if(session()->get('language') == 'bangla') কার্টে যুক্ত করুন @else Add Cart @endif </button>
                                                    </li> 

                                                    <li class="link wishlist">
                                                        <button  data-toggle="tooltip" class="btn btn-success icon" type="button" id="{{ $product->id }}" onclick="addToWishlist(this.id)"
                                                                 title=" @if(session()->get('language') == 'bangla') ইচ্ছেতালিকায় যুক্ত করুন @else Add Wishlist @endif ">
                                                            <i class="icon fa fa-heart"></i>													
                                                        </button>
                                                        <button class="btn btn-success cart-btn" type="button"> @if(session()->get('language') == 'bangla') ইচ্ছেতালিকায় যুক্ত করুন @else Add Wishlist @endif </button>
                                                    </li>

                                                </ul>
                                            </div><!-- /.action -->
                                        </div><!-- /.cart -->
                                    </div><!-- /.product -->

                                </div><!-- /.products -->
                            </div><!-- /.item -->
                            @empty
                            <br>
                            <h3 class="text-center text-danger" style="margin-top: 100px">
                                @if(session()->get('language') == 'bangla')
                                পণ্য পাওয়া যায়নি
                                @else
                                No Product Found
                                @endif
                            </h3>

                            @endforelse

                        </div><!-- /.home-owl-carousel -->
                    </section><!-- /.section -->
                    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->


<script src="{{ asset('js/app.js') }}" ></script>
        
<!-- Facebook Comment Script -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId=535397324534271&autoLogAppEvents=1" nonce="nT4X9lys"></script>

<!-- Share Product Script -->
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=615657f16a41fc001a0acfd1&product=inline-share-buttons" async="async"  data-href="{{ Request::url() }}" ></script>


@endsection        
