@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title')  
@if(session()->get('language') == 'bangla') {{$category->category_name_bn}} @else {{$category->category_name_en}} @endif 
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
                <li class='active'>{{$category->category_name_bn}}</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>{{$category->category_name_en}}</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>
                <!-- ================================== TOP NAVIGATION ================================== -->
                @include('frontend.include.leftbar.categories')
                <!-- ================================== TOP NAVIGATION : END ================================== -->
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
                                    <!--<span class="lbl">Sort by</span>-->
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
                            
<!--                            {{ $products->appends($_GET)->links('vendor.pagination.custom') }}-->
                            		
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>
                <div class="search-result-container">
                    <div id="myTabContent" class="tab-content category-list"  style="min-height: 300px !important">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row" id="grid_view_product">									
                                    
                                   @include('frontend.include.grid_view_product')

                                </div><!-- /.row -->
                            </div><!-- /.category-product -->

                        </div><!-- /.tab-pane -->

                        <div class="tab-pane "  id="list-container">
                            <div class="category-product" id="list_view_product">

                                @include('frontend.include.list_view_product')

                            </div><!-- /.category-product -->
                        </div><!-- /.tab-pane #list-container -->
                    </div><!-- /.tab-content -->
                    <div class="clearfix filters-container">
                        
                        <div class="text-right">
                            
                        <!--{{ $products->appends($_GET)->links('vendor.pagination.custom') }}-->	
                        
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
            window.location = "{{ url('' . $route . '') }}/{{ $catSlug }}?sortBy="+sortBy;
        });
    </script>
    
    
    <script>
        function loadmoreProduct(page) {
            $.ajax({
                    type: "get",
                    url: "?page=" + page,
                    beforeSend: function(response) {
                        $('.ajax-loadmore-product').show();
                    }
                })

                .done(function(data) {
                    if (data.grid_view == " " || data.list_view == " ") {
                        $('.ajax-loadmore-product').html('No More Product Found');
                        return;
                    }
                    $('.ajax-loadmore-product').hide();

                    $('#grid_view_product').append(data.grid_view);
                    $('#list_view_product').append(data.list_view);
                })

                .fail(function() {
                    alert('something went wrong')
                });

        }
        var page = 1;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadmoreProduct(page);
            }
        });

    </script>
    
@endsection