@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title')  
@if(session()->get('language') == 'bangla') {{$sub_subcategory->sub_subcategory_name_bn}} @else {{$sub_subcategory->sub_subcategory_name_en}} @endif 
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
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
                <li class='active'>{{$sub_subcategory->sub_subcategory_name_bn}}</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>{{$sub_subcategory->sub_subcategory_name_en}}</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>
                <!-- ============================================== HOT DEALS ============================================== -->
                @include('frontend.include.leftbar.hot-deals')
                <!-- ============================================== HOT DEALS: END ============================================== -->                   
                @include('frontend.include.leftbar.brands')
                @include('frontend.include.leftbar.colors')
                @include('frontend.include.leftbar.product-tags')
            </div><!-- /.sidebar -->
            <div class='col-md-9'>
                <!-- ========================================== SECTION – HERO ========================================= -->
                @include('frontend.include.hero')
                <!-- ========================================= SECTION – HERO : END ========================================= -->
                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                        <div class="col col-sm-6 col-md-2 col-lg-2">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                    <li class="active">
                                        <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                                </ul>
                            </div><!-- /.filter-tabs -->
                        </div><!-- /.col -->
                        <div class="col col-sm-12 col-md-6 col-lg-6">
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt">
                                    
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <select class="form-control lbl" name="sortBy" id="sortBy" style="width: auto; height: auto;">
                                                <option disabled selected >Sort by Product</option>
                                                <option value="priceLowesttoHighest" {{ ($sort == 'priceLowesttoHighest') ? 'selected' : '' }}>Price: Lowest to HIghest</option>
                                                <option value="priceHighesttoLowest" {{ ($sort == 'priceHighesttoLowest') ? 'selected' : '' }}>Price: HIghest to Lowest</option>
                                                <option value="nameAtoZ" {{ ($sort == 'nameAtoZ') ? 'selected' : '' }}>Name: A to Z</option>
                                                <option value="nameZtoA" {{ ($sort == 'nameZtoA') ? 'selected' : '' }}>Name: Z to A</option>
                                            </select>
                                        </div>
                                    </div><!-- /.fld -->
                                </div><!-- /.lbl-cnt -->
                            </div><!-- /.col -->
                            
                        </div><!-- /.col -->
                        <div class="col col-sm-6 col-md-4 col-lg-4 text-right">
                            {{ $sub_subcat_wise_products->appends($_GET)->links('vendor.pagination.custom') }}
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>
                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list"  style="min-height: 300px !important">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row">									

                                    @forelse($sub_subcat_wise_products as $product)
                                    <div class="col-sm-6 col-md-4 wow fadeInUp" style="max-height: 390px;">
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
                                    <div class="col-md-12"></div>
                                    <h3 class="text-center text-danger" style="margin-top: 120px"> @if(session()->get('language') == 'bangla') পণ্য পাওয়া যায়নি @else No Product Found !! @endif </h3>
                                    @endforelse

                                </div><!-- /.row -->
                            </div><!-- /.category-product -->

                        </div><!-- /.tab-pane -->

                        <div class="tab-pane "  id="list-container">
                            <div class="category-product">

                                @forelse($sub_subcat_wise_products as $product)
                                <div class="category-product-inner wow fadeInUp">
                                    <div class="products">				
                                        <div class="product-list product">
                                            <div class="row product-list-row">
                                                <div class="col col-sm-4 col-lg-4">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            @if(session()->get('language') == 'bangla')
                                                            <a href="{{url('products/'.$product->product_slug_bn)}}"><img  src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" alt=""></a>
                                                            @else
                                                            <a href="{{url('products/'.$product->product_slug_en)}}"><img  src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" alt=""></a>
                                                            @endif
                                                        </div>
                                                    </div><!-- /.product-image -->
                                                </div><!-- /.col -->
                                                <div class="col col-sm-8 col-lg-8">
                                                    <div class="product-info" style="margin-top: -18px !important;">
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

                                                        <div class="product-price">
                                                            @if($product->discount_price != NULL)
                                                            <span class="price"> @if(session()->get('language') == 'bangla') ৳{{ bn_price($product->discount_price) }} @else ৳{{ $product->discount_price }} @endif </span>
                                                            <span class="price-before-discount"> @if(session()->get('language') == 'bangla') ৳ {{ bn_price($product->selling_price) }} @else ৳ {{ $product->selling_price }} @endif </span>
                                                            @else
                                                            <span class="price"> @if(session()->get('language') == 'bangla') ৳{{ bn_price($product->selling_price) }} @else ৳{{ $product->selling_price }} @endif </span>
                                                            @endif
                                                        </div><!-- /.product-price -->
                                                        <div class="description m-t-10">@if(session()->get('language') == 'bangla') {!! $product->short_descp_bn !!} @else {!! $product->short_descp_en !!} @endif </div>
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <button class="btn btn-primary icon" type="button" data-toggle="modal" data-target="#exampleModal"  id="{{$product->id}}" onclick="productView(this.id)">
                                                                            <i class="fa fa-shopping-cart"></i>													
                                                                        </button>
                                                                        <button class="btn btn-primary cart-btn" type="button" data-toggle="modal" data-target="#exampleModal"  id="{{$product->id}}" onclick="productView(this.id)"> @if(session()->get('language') == 'bangla') কার্টে যুক্ত করুন @else Add to Cart @endif </button>

                                                                    </li>

                                                                    <li class="link wishlist">
                                                                        <button  data-toggle="tooltip" class="btn btn-success icon" type="button" id="{{ $product->id }}" onclick="addToWishlist(this.id)"
                                                                                 title=" @if(session()->get('language') == 'bangla') ইচ্ছেতালিকায় যুক্ত করুন @else Add Wishlist @endif ">
                                                                            <i class="icon fa fa-heart"></i>													
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div><!-- /.action -->
                                                        </div><!-- /.cart -->

                                                    </div><!-- /.product-info -->	
                                                </div><!-- /.col -->
                                            </div><!-- /.product-list-row -->

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

                                        </div><!-- /.product-list -->
                                    </div><!-- /.products -->
                                </div><!-- /.category-product-inner -->
                                    @empty
                                    <div class="col-md-12"></div>
                                    <h3 class="text-center text-danger" style="margin-top: 120px"> @if(session()->get('language') == 'bangla') পণ্য পাওয়া যায়নি @else No Product Found !! @endif </h3>
                                    @endforelse

                            </div><!-- /.category-product -->
                        </div><!-- /.tab-pane #list-container -->
                    </div><!-- /.tab-content -->
                    <div class="clearfix filters-container">

                        <div class="text-right">
                            {{ $sub_subcat_wise_products->appends($_GET)->links('vendor.pagination.custom') }}
                        </div><!-- /.text-right -->

                    </div><!-- /.filters-container -->

                </div><!-- /.search-result-container -->

            </div><!-- /.col -->
        </div><!-- /.row -->

@endsection   

@section('scripts')

    <script>
            $('#sortBy').change(function(e) {
                e.preventDefault();
                let sortBy = $('#sortBy').val();
                window.location = "{{ url('' . $route . '') }}/{{ $subSubCatSlug }}?sortBy="+sortBy;
            });
        </script>
@endsection