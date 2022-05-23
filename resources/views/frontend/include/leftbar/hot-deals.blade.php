<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title"> @if(session()->get('language') == 'bangla') হট ডিল'স @else hot deals @endif </h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">

        @php
            $hot_deals = App\Models\Product::where('status', 1)->where('hot_deal', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->get();
            @endphp
        @foreach($hot_deals as $product)
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image">
                        <img src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" alt="">
                    </div>

                    @php 
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount / $product->selling_price) * 100;
                    @endphp
                    <div class="sale-offer-tag"><span> @if(session()->get('language') == 'bangla') {{ bn_price(round($discount)) }}%<br>ছাড় @else {{ round($discount) }}%<br>off @endif </span></div>

                    <div class="timing-wrapper">
                        <div class="box-wrapper">
                            <div class="date box">
                                <span class="key">120</span>
                                <span class="value">DAYS</span>
                            </div>
                        </div>

                        <div class="box-wrapper">
                            <div class="hour box">
                                <span class="key">20</span>
                                <span class="value">HRS</span>
                            </div>
                        </div>

                        <div class="box-wrapper">
                            <div class="minutes box">
                                <span class="key">36</span>
                                <span class="value">MINS</span>
                            </div>
                        </div>

                        <div class="box-wrapper hidden-md">
                            <div class="seconds box">
                                <span class="key">60</span>
                                <span class="value">SEC</span>
                            </div>
                        </div>
                    </div>
                </div><!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
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

                </div><!-- /.product-info -->

                <div class="cart clearfix animate-effect">
                    <div class="action">

                        <div class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="modal" data-target="#exampleModal" type="button" id="{{$product->id}}" onclick="productView(this.id)">
                                <i class="fa fa-shopping-cart"></i>													
                            </button>
                            <button class="btn btn-primary cart-btn" data-toggle="modal" data-target="#exampleModal" type="button" id="{{$product->id}}" onclick="productView(this.id)"> @if(session()->get('language') == 'bangla') কার্টে যুক্ত করুন @else Add to cart @endif </button>

                        </div>

                    </div><!-- /.action -->
                </div><!-- /.cart -->
            </div>	
        </div>			        
        @endforeach

    </div><!-- /.sidebar-widget -->
</div>