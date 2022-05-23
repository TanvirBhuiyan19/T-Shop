<!-- ============================================== COLOR============================================== -->
@php
$products = App\Models\Product::orderBy('id', 'DESC')->get();
$colors_en = $products->map(fn($product) => explode(',', $product->product_color_en))
->flatten()
->unique()   // avoid repeating tags
->sort()     // optional
->values();
$colors_bn = $products->map(fn($product) => explode(',', $product->product_color_bn))
->flatten()
->unique()  
->sort()    
->values();                   
@endphp

@php
    $colorSelect = '';
    if( isset($color_name) ){
        $colorSelect = $color_name;
    }
@endphp

<div class="sidebar-widget wow fadeInUp product-tag outer-top-vs">
    <h3 class="section-title"> @if(session()->get('language') == 'bangla' ) রঙসমুহ @else Colors @endif </h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">					
            @if(session()->get('language') == 'bangla' )  
                @foreach($colors_bn as $color_bn)
                    @if($color_bn == $colorSelect)
                    <a class="item active" title="{{ $color_bn }}" href="{{ url('products/color/'.$color_bn) }}">{{ $color_bn }}</a>
                    @else
                    <a class="item " title="{{ $color_bn }}" href="{{ url('products/color/'.$color_bn) }}">{{ $color_bn }}</a>
                    @endif
                @endforeach
            @else
                @foreach($colors_en as $color_en)
                    @if($color_en == $colorSelect)
                    <a class="item active" title="{{ $color_en }}" href="{{ url('products/color/'.$color_en) }}">{{ $color_en }}</a>
                    @else
                    <a class="item " title="{{ $color_en }}" href="{{ url('products/color/'.$color_en) }}">{{ $color_en }}</a>
                    @endif
                @endforeach
            @endif
        </div><!-- /.tag-list -->
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== COLOR: END ============================================== -->