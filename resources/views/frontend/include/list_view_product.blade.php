@forelse($products as $product)
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
                            <span class="price"> @if(session()->get('language') == 'bangla') ???{{ bn_price($product->discount_price) }} @else ???{{ $product->discount_price }} @endif </span>
                            <span class="price-before-discount"> @if(session()->get('language') == 'bangla') ??? {{ bn_price($product->selling_price) }} @else ??? {{ $product->selling_price }} @endif </span>
                            @else
                            <span class="price"> @if(session()->get('language') == 'bangla') ???{{ bn_price($product->selling_price) }} @else ???{{ $product->selling_price }} @endif </span>
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
                                        <button class="btn btn-primary cart-btn" type="button" data-toggle="modal" data-target="#exampleModal"  id="{{$product->id}}" onclick="productView(this.id)"> @if(session()->get('language') == 'bangla') ?????????????????? ??????????????? ???????????? @else Add to Cart @endif </button>

                                    </li>

                                    <li class="link wishlist">
                                        <button  data-toggle="tooltip" class="btn btn-success icon" type="button" id="{{ $product->id }}" onclick="addToWishlist(this.id)"
                                                 title=" @if(session()->get('language') == 'bangla') ???????????????????????????????????? ??????????????? ???????????? @else Add Wishlist @endif ">
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
            <div class="tag new"><span> @if(session()->get('language') == 'bangla') ???????????? @else new @endif </span></div>
            @endif

        </div><!-- /.product-list -->
    </div><!-- /.products -->
</div><!-- /.category-product-inner -->

@empty
<!--<div class="col-md-12"></div>
<h3 class="text-center text-danger" style="margin-top: 120px"> @if(session()->get('language') == 'bangla') ???????????? ??????????????? ??????????????? @else No Product Found !! @endif </h3>-->

@endforelse