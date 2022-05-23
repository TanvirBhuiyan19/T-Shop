<!-- ============================================== MANUFACTURES============================================== -->
@php
    $brands = App\Models\Brand::all();
@endphp
@php
    $brandSelect = '';
    if( isset($brandSlug) ){
        $brandSelect = $brandSlug;
    }
@endphp

<div class="sidebar-widget product-tag wow fadeInUp ">
    <h3 class="section-title"> @if(session()->get('language') == 'bangla' ) উৎপাদনকারী @else Manufactures @endif </h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">					
            @foreach($brands as $brand)
            @if(session()->get('language') == 'bangla' ) 
                @if($brandSelect == $brand->brand_slug_bn)
                <a class="item active" title="{{ $brand->brand_name_bn }}" href="{{ url('products/brand/'.$brand->brand_slug_bn) }}">{{ $brand->brand_name_bn }}</a>
                @else
                <a class="item " title="{{ $brand->brand_name_bn }}" href="{{ url('products/brand/'.$brand->brand_slug_bn) }}">{{ $brand->brand_name_bn }}</a>
                @endif
            @else
                @if($brandSelect == $brand->brand_slug_en)
                <a class="item active" title="{{  $brand->brand_name_en }}" href="{{ url('products/brand/'.$brand->brand_slug_en) }}">{{ $brand->brand_name_en }}</a>
                @else
                <a class="item " title="{{  $brand->brand_name_en }}" href="{{ url('products/brand/'.$brand->brand_slug_en) }}">{{ $brand->brand_name_en }}</a>
                @endif
            @endif
            @endforeach
        </div><!-- /.tag-list -->
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== MANUFACTURES: END ============================================== -->