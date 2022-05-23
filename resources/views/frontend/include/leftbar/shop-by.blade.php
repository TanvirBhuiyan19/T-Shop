<!-- ============================================== SIDEBAR CATEGORY ============================================== -->
<div class="sidebar-widget wow fadeInUp">
    <h3 class="section-title text-center"> @if(session()->get('language') == 'bangla') বাছাই করুণ @else Filter by @endif </h3>
    
    <div class="widget-header">
        <h4 class="widget-title"> @if(session()->get('language') == 'bangla') ক্যাটাগরিসমূহ @else Categories @endif</h4>
    </div>
    <div class="sidebar-widget-body">
        <div class="accordion">
            @if (!empty($_GET['category']))
                @php
                    $filterCat = explode(',', $_GET['category']);
                @endphp
            @endif
            @foreach($categories as $category)
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <lavel class='form-check-label'>
                            <input type="checkbox" class="form-check-input" name="category[]" 
                            @if (!empty($filterCat) && in_array($category->category_slug_en, $filterCat)) checked @endif      
                            value="{{$category->category_slug_en}}" onchange="this.form.submit();">
                                @if(session()->get('language') == 'bangla')
                                {{$category->category_name_bn}}
                                @else
                                {{$category->category_name_en}}
                                @endif
                        </lavel>
                    </div> 
                </div> <!-- accordion-group --> 
            @endforeach
        </div> <!-- accordion --> 
    </div> <!-- sidebar-widget-body --> 
   
  
</div> <!-- sidebar-widget -->
<!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

<!-- ============================================== MANUFACTURES============================================== -->
<div class="sidebar-widget product-tag wow fadeInUp">
    <div class="widget-header">
        <h4 class="widget-title"> @if(session()->get('language') == 'bangla') ব্র্যান্ডসমুহ @else Brands @endif</h4>
    </div>
    <div class="sidebar-widget-body">
        <div class="accordion">
            @if (!empty($_GET['brand']))
                @php
                    $filterBrand = explode(',', $_GET['brand']);
                @endphp
            @endif
            @foreach($brands as $brand)
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <lavel class='form-check-label'>
                            <input type="checkbox" class="form-check-input" name="brand[]" 
                            @if (!empty($filterBrand) && in_array($brand->brand_slug_en, $filterBrand)) checked @endif      
                            value="{{$brand->brand_slug_en}}" onchange="this.form.submit();">
                                @if(session()->get('language') == 'bangla')
                                {{$brand->brand_name_bn}}
                                @else
                                {{$brand->brand_name_en}}
                                @endif
                        </lavel>
                    </div> 
                </div> <!-- accordion-group --> 
            @endforeach
        </div> <!-- accordion --> 
    </div> <!-- sidebar-widget-body --> 
</div><!-- /.sidebar-widget -->
<!-- ============================================== MANUFACTURES: END ============================================== -->

<!-- ============================================== PRICE SILDER============================================== -->
<div class="sidebar-widget wow fadeInUp">
    <div class="widget-header">
        <h4 class="widget-title">Price Slider</h4>
    </div>
    <div class="sidebar-widget-body m-t-10">
        <div id="slider-range" class="price-filter-range" data-min="{{ Helper::minPrice() }}" data-max="{{ Helper::maxPrice() }}">
        </div> <br>
        <input type="hidden" name="price_range" id="price_range" value="@if (!empty($_GET['price'])) {{ $_GET['price'] }} @endif">
        @if (!empty($_GET['price']))
            @php
                $price = explode('-', $_GET['price']);
            @endphp
        @endif
        <input type="text" id="amount" value="@if (!empty($_GET['price'])) {{ $_GET['price'] }} @else {{ Helper::minPrice() }}-{{ Helper::maxPrice() }} @endif" readonly disabled  
               style="border:0; color:#666666; font-weight:bold; text-align:center; padding: 10px; inline-size:-webkit-fill-available;">
        <br><br>
        <button type="submit" class="btn btn-success btn-block">Filter</button>
    </div> <!-- price-range-holder price-range-holder -->
<br><br>
</div> <!-- price-range-holder price-range-holder -->
<!-- ============================================== PRICE SILDER : END ============================================== -->
