@forelse($products as $product)
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
<!--<div class="col-md-12"></div>
<h3 class="text-center text-danger" style="margin-top: 120px"> @if(session()->get('language') == 'bangla') পণ্য পাওয়া যায়নি @else No Product Found !! @endif </h3>-->

@endforelse