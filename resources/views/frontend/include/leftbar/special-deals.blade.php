<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title"> @if(session()->get('language') == 'bangla' ) স্পেশাল ডিল'স @else Special Deals @endif </h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">

            @php
            $special_deals = App\Models\Product::where('status', 1)->where('special_deal', 1)->orderBy('id', 'DESC')->get();
            @endphp
            @foreach ($special_deals->chunk(3) as $chunk)
            <div class="item">
                <div class="products special-product">

                    @foreach($chunk as $product)
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image">
                                            @if(session()->get('language') == 'bangla')
                                            <a href="{{url('products/'.$product->product_slug_bn)}}"><img  src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" alt=""></a>
                                            @else
                                            <a href="{{url('products/'.$product->product_slug_en)}}"><img  src="{{ asset('uploads/product/thumbnail/') }}/{{$product->product_thumbnail}}" alt=""></a>
                                            @endif					
                                        </div><!-- /.image -->


                                    </div><!-- /.product-image -->
                                </div><!-- /.col -->
                                <div class="col col-xs-7">
                                    <div class="product-info">
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
                                            </span>                                        
                                        @else                                            
                                            @for($i=1; $i<=5; $i++)                                            
                                            <span class="glyphicon glyphicon-star-empty" style="color: #F9C922" title="No review"></span>                                            
                                            @endfor                                        
                                        @endif
                                        <div class="product-price">	
                                            @if($product->discount_price != NULL)
                                            <span class="price"> @if(session()->get('language') == 'bangla') ৳{{ bn_price($product->discount_price) }} @else ৳{{ $product->discount_price }} @endif </span>
                                            @else
                                            <span class="price"> @if(session()->get('language') == 'bangla') ৳{{ bn_price($product->selling_price) }} @else ৳{{ $product->selling_price }} @endif </span>
                                            @endif
                                        </div><!-- /.product-price -->

                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.product-micro-row -->
                        </div><!-- /.product-micro -->
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

        </div>
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->