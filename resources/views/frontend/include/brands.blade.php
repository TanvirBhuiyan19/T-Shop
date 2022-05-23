<br><br>

<div id="brands-carousel" class="logo-slider wow fadeInUp">

    <div class="logo-slider-inner">	
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
           
            @php
            $brands = App\Models\Brand::orderBy('id','DESC')->get();
            @endphp
            @foreach($brands as $brand)
            <div class="item text-center" style="width: 210px !important">
                @if(session()->get('language') == 'bangla')
                    <a href="{{url('products/brand/'.$brand->brand_slug_bn)}}" class="image" title="{{ $brand->brand_name_bn }}">
                        <img data-echo="{{ asset('uploads/brand/'.$brand->brand_logo) }}" src="{{ asset('uploads/brand/'.$brand->brand_logo) }}" 
                         alt="" style="height: 70px; padding-right: 20px; max-width: 190px !important;">
                    </a>
                @else
                    <a href="{{url('products/brand/'.$brand->brand_slug_en)}}" class="image" title="{{ $brand->brand_name_en }}">
                        <img data-echo="{{ asset('uploads/brand/'.$brand->brand_logo) }}" src="{{ asset('uploads/brand/'.$brand->brand_logo) }}" 
                         alt="" style="height: 70px; padding-right: 20px; max-width: 190px !important;">
                    </a>
                @endif
            </div><!--/.item-->
            @endforeach
            
        </div><!-- /.owl-carousel #logo-slider -->
    </div><!-- /.logo-slider-inner -->

</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->