@php
$products = App\Models\Product::orderBy('id', 'DESC')->get();
$tags_en = $products->map(fn($product) => explode(',', $product->product_tag_en))
->flatten()
->unique()   // avoid repeating tags
->sort()     // optional
->values();
$tags_bn = $products->map(fn($product) => explode(',', $product->product_tag_bn))
->flatten()
->unique()  
->sort()    
->values();                   
@endphp

@php
    $tagSelect = '';
    if( isset($tag_name) ){
        $tagSelect = $tag_name;
    }
@endphp

<div class="sidebar-widget product-tag wow fadeInUp outer-top-vs">
    <h3 class="section-title"> @if(session()->get('language') == 'bangla' ) পন্যের ট্যাগসমুহ @else Product tags @endif </h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">					
            @if(session()->get('language') == 'bangla' )  
                @foreach($tags_bn as $tag)
                    @if($tag == $tagSelect)
                    <a class="item active" title="{{ $tag }}" href="{{ url('products/tag/'.$tag) }}">{{ $tag }}</a>
                    @else
                    <a class="item " title="{{ $tag }}" href="{{ url('products/tag/'.$tag) }}">{{ $tag }}</a>
                    @endif
                @endforeach
            @else
                @foreach($tags_en as $tag)
                    @if($tag == $tagSelect)
                    <a class="item active" title="{{ $tag }}" href="{{ url('products/tag/'.$tag) }}">{{ $tag }}</a>
                    @else
                    <a class="item " title="{{ $tag }}" href="{{ url('products/tag/'.$tag) }}">{{ $tag }}</a>
                    @endif
                @endforeach
            @endif
        </div><!-- /.tag-list -->
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
