@extends('layouts.frontendMaster')

@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title') 
    @if($settings->site_name) {{$settings->site_name}} | {{$settings->site_title}} 
    @else {{ config('app.name') }} | Online Shopping Mall @endif
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

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
        <!-- ============================================== SIDEBAR ============================================== -->	
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                <!-- ================================== TOP NAVIGATION ================================== -->
                @include('frontend.include.leftbar.categories')
                <!-- ================================== TOP NAVIGATION : END ================================== -->

                <!-- ============================================== HOT DEALS ============================================== -->
                @include('frontend.include.leftbar.hot-deals')
                <!-- ============================================== HOT DEALS: END ============================================== -->
                
                <!-- ============================================== SPECIAL OFFER ============================================== -->
                @include('frontend.include.leftbar.special-offer')
                <!-- ============================================== SPECIAL OFFER : END ============================================== -->
                
                <!-- ============================================== SHORT BY PRODUCTS ============================================== -->
                @include('frontend.include.leftbar.brands')
                @include('frontend.include.leftbar.colors')
                @include('frontend.include.leftbar.product-tags')
                <!-- ============================================== SHORT BY PRODUCTS : END ============================================== -->
                
                <!-- ============================================== SPECIAL DEALS ============================================== -->
                <br><br>
                @include('frontend.include.leftbar.special-deals')
                <!-- ============================================== SPECIAL DEALS : END ============================================== -->
                
                <!-- ============================================== DOWNLOAD APP ============================================== -->
                @include('frontend.include.leftbar.banner')
                <!-- ============================================== DOWNLOAD APP : END ============================================== -->
                
            </div><!-- /.sidemenu-holder -->
        <!-- ============================================== SIDEBAR : END ============================================== -->


            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                <!-- ========================================== SECTION – HERO ========================================= -->

                <div id="hero">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

                        @foreach($sliders as $slider)
                        <div class="item" >  
                            <a href="{{$slider->url}}" target="_blank"> <img src="{{ asset('uploads/slider/')}}/{{$slider->slider_image }}"> </a>
                            @if($slider->slider_title_en)
                            <div class="container-fluid">
                                <div class="caption bg-color vertical-center text-left">
                                    <div><br></div>
                                    <div class="big-text fadeInDown-1">
                                        @if(session()->get('language') == 'bangla')
                                        {{ $slider->slider_title_bn }}
                                        @else
                                        {{ $slider->slider_title_en }}
                                        @endif
                                    </div>

                                    <div class="excerpt fadeInDown-2 hidden-xs">
                                        @if(session()->get('language') == 'bangla')
                                        <span>{{ $slider->slider_description_bn }}</span>
                                        @else
                                        <span>{{ $slider->slider_description_en }}</span>
                                        @endif

                                    </div>

                                    <div class="button-holder fadeInDown-3">
                                        <a href="{{$slider->url}}" target="_blank" class="btn-lg btn btn-uppercase btn-primary shop-now-button">
                                            @if(session()->get('language') == 'bangla')
                                            এখনই ক্রয় করুন
                                            @else
                                            Shop Now
                                            @endif
                                        </a>
                                    </div>
                                </div><!-- /.caption -->
                            </div><!-- /.container-fluid -->
                            @endif
                        </div><!-- /.item -->
                        @endforeach

                    </div><!-- /.owl-carousel -->
                </div>

                <!-- ========================================= SECTION – HERO : END ========================================= -->	

                <!-- ============================================== INFO BOXES ============================================== -->
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">

                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">
                                                @if(session()->get('language') == 'bangla')
                                                টাকা ফেরত
                                                @else
                                                money back
                                                @endif
                                            </h4>
                                        </div>
                                    </div>	
                                    <h6 class="text">
                                        @if(session()->get('language') == 'bangla')
                                        ৩০ দিনের টাকা ফেরত গ্যারান্টি
                                        @else
                                        30 Days Money Back Guarantee</h6>
                                    @endif
                                </div>
                            </div><!-- .col -->

                            <div class="hidden-md col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">

                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">
                                                @if(session()->get('language') == 'bangla')
                                                ফ্রি ডেলিভারী
                                                @else
                                                free shipping
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                    <h6 class="text">
                                        @if(session()->get('language') == 'bangla')
                                        ৯৯ টাকার বেশি ক্রয় করলেই
                                        @else
                                        Shipping on orders over ৳99
                                        @endif
                                    </h6>	
                                </div>
                            </div><!-- .col -->

                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">

                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">
                                                @if(session()->get('language') == 'bangla')
                                                স্পেশাল ছাড়
                                                @else
                                                Special Sale
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                    <h6 class="text">
                                        @if(session()->get('language') == 'bangla')
                                        সকল পন্যের উপর অতিরিক্ত ৫% ছাড়!
                                        @else
                                        Extra 5% off on all items! 
                                        @endif
                                    </h6>	
                                </div>
                            </div><!-- .col -->
                        </div><!-- /.row -->
                    </div><!-- /.info-boxes-inner -->

                </div><!-- /.info-boxes -->
                <!-- ============================================== INFO BOXES : END ============================================== -->
                <!-- ============================================== SCROLL TABS ============================================== -->
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        {{-- <h3 class="new-product-title pull-left"> @if(session()->get('language') == 'bangla') নতুন পণ্যসমুহ @else New Products @endif </h3> --}}

                        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                            @if(session()->get('language') == 'bangla')
                            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab"><b>সব</b></a></li>
                            @foreach($categories as $category)
                            <li><a data-transition-type="backSlide" href="#category{{$category->id}}" data-toggle="tab">{{ $category->category_name_bn }}</a></li>
                            @endforeach
                            @else
                            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab"><b>All</b></a></li>
                            @foreach($categories as $category)
                            <li><a data-transition-type="backSlide" href="#category{{$category->id}}" data-toggle="tab">{{ $category->category_name_en }}</a></li>
                            @endforeach
                            @endif

                        </ul><!-- /.nav-tabs -->
                    </div>

                    <div class="tab-content outer-top-xs" style="min-height: 340px;">
                        <div class="tab-pane in active" id="all">			
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                                    @forelse($products as $product)
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
                                                        $avgCeilRating = ceil($avgRating);
                                                        @endphp                                            
                                                        <span class="summary">                                            
                                                            @for($i=1; $i<=5; $i++)                                            
                                                            <span class="glyphicon glyphicon-star{{ ($i <= $avgCeilRating) ? '' : '-empty' }}" style="color: #F9C922" title="{{$avgRating}} / 5"></span>                                            
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
                                    <h3 class="text-center text-danger" style="margin-top: 100px"> @if(session()->get('language') == 'bangla') পণ্য পাওয়া যায়নি @else No Product Found @endif </h3>

                                    @endforelse

                                </div><!-- /.home-owl-carousel -->
                            </div><!-- /.product-slider -->
                        </div><!-- /.tab-pane -->

                        @foreach($categories as $category)
                        <div class="tab-pane" id="category{{$category->id}}">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">

                                    @php
                                    $catwise_products = App\Models\Product::where('status', 1)->where('category_id', $category->id)->orderBy('id', 'DESC')->take(6)->get();
                                    @endphp
                                    @forelse($catwise_products as $product)
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
                                                        $avgCeilRating = ceil($avgRating);
                                                        @endphp                                            
                                                        <span class="summary">                                            
                                                            @for($i=1; $i<=5; $i++)                                            
                                                            <span class="glyphicon glyphicon-star{{ ($i <= $avgCeilRating) ? '' : '-empty' }}" style="color: #F9C922" title="{{$avgRating}} / 5"></span>                                            
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
                            </div><!-- /.product-slider -->
                        </div><!-- /.tab-pane -->
                        @endforeach

                    </div><!-- /.tab-content -->
                </div><!-- /.scroll-tabs -->
                <!-- ============================================== SCROLL TABS : END ============================================== -->
                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="wide-banner cnt-strip">
                                <div class="image">
                                    <img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/home-banner1.jpg" alt="">
                                </div>

                            </div><!-- /.wide-banner -->
                        </div><!-- /.col -->
                        <div class="col-md-5 col-sm-5">
                            <div class="wide-banner cnt-strip">
                                <div class="image">
                                    <img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/home-banner2.jpg" alt="">
                                </div>

                            </div><!-- /.wide-banner -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.wide-banners -->

                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title"> @if(session()->get('language') == 'bangla') ফিচারড পণ্যসমুহ @else Featured products @endif </h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs" style="min-height: 200px;">

                        @forelse ($feature_products->chunk(2) as $chunk)
                        <div class="item item-carousel">
                            <div class="products">

                                @foreach($chunk as $product)
                                <div class="product" style="height: 310px">		
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
                                            $avgCeilRating = ceil($avgRating);
                                            @endphp                                            
                                            <span class="summary">                                            
                                                @for($i=1; $i<=5; $i++)                                            
                                                <span class="glyphicon glyphicon-star{{ ($i <= $avgCeilRating) ? '' : '-empty' }}" style="color: #F9C922" title="{{$avgRating}} / 5"></span>                                            
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
                                <hr>
                                @endforeach

                            </div><!-- /.products -->
                        </div><!-- /.item -->
                        @empty
                        <br>
                        <h4 class="text-center text-danger" style="margin-top: 70px">
                            @if(session()->get('language') == 'bangla')
                            পণ্য পাওয়া যায়নি
                            @else
                            No Product Found
                            @endif
                        </h4>

                        @endforelse

                    </div><!-- /.home-owl-carousel -->
                </section><!-- /.section -->
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                <!-- ============================================== All Category PRODUCTS ============================================== -->
                @foreach($categories as $category)
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title"> @if(session()->get('language') == 'bangla') {{$category->category_name_bn}} @else {{$category->category_name_en}} @endif </h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs" style="min-height: 200px;">

                        @php
                        $products = App\Models\Product::where('status', 1)->where('category_id', $category->id)->orderBy('id', 'ASC')->get();
                        @endphp
                        @forelse ($products as $product)
                        <div class="item item-carousel">
                            <div class="products">

                                <div class="product" style="height: 310px">		
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
                                            $avgCeilRating = ceil($avgRating);
                                            @endphp                                            
                                            <span class="summary">                                            
                                                @for($i=1; $i<=5; $i++)                                            
                                                <span class="glyphicon glyphicon-star{{ ($i <= $avgCeilRating) ? '' : '-empty' }}" style="color: #F9C922" title="{{$avgRating}} / 5"></span>                                            
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

                                                <!--                                                <li class="lnk">
                                                                                                    <a class="add-to-cart" href="detail.html" title="Compare">
                                                                                                        <i class="fa fa-signal" aria-hidden="true"></i>
                                                                                                    </a>
                                                                                                </li>-->

                                            </ul>
                                        </div><!-- /.action -->
                                    </div><!-- /.cart -->
                                </div><!-- /.product -->
                                <hr>

                            </div><!-- /.products -->
                        </div><!-- /.item -->
                        @empty
                        <br>
                        <h4 class="text-center text-danger" style="margin-top: 70px">
                            @if(session()->get('language') == 'bangla')
                            পণ্য পাওয়া যায়নি
                            @else
                            No Product Found
                            @endif
                        </h4>

                        @endforelse

                    </div><!-- /.home-owl-carousel -->
                </section><!-- /.section -->
                @endforeach
                <!-- ============================================== Skip Category PRODUCTS : END ============================================== -->
               
            </div><!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div><!-- /.row -->


        @endsection