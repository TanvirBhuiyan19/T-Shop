@php
$categories = App\Models\Category::orderBy('category_name_en', 'ASC')->get();
@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
                    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> 
                        @if(session()->get('language') == 'bangla')
                        ক্যাটাগরিগুলি
                        @else
                        Categories
                        @endif
                    </div>        
                    <nav class="yamm megamenu-horizontal" role="navigation">
                        <ul class="nav">

                            @foreach($categories as $category)
                            <li class="dropdown menu-item">
                                @if(session()->get('language') == 'bangla')
                                <a href="{{ url('products/category/'.$category->category_slug_bn) }}" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa {{$category->category_icon}}" aria-hidden="true"></i>{{$category->category_name_bn}}</a>
                                @else
                                <a href="{{ url('products/category/'.$category->category_slug_en) }}" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa {{$category->category_icon}}" aria-hidden="true"></i>{{$category->category_name_en}}</a>
                                @endif  

                                <ul class="dropdown-menu mega-menu" style="min-height: 300px;">
                                    <li class="yamm-content">
                                        <div class="row">

                                            <div class="col-lg-7 col-md-6 col-sm-12">
                                                <div class="row">
                                                    @php
                                                    $subcategories = App\Models\Subcategory::where('category_id', $category->id)->orderBy('subcategory_name_en','ASC')->get();
                                                    @endphp
                                                    @foreach($subcategories as $subcat)

                                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                                        @if(session()->get('language') == 'bangla')
                                                        <h2 class="title"><a href="{{ url('products/subcategory/'.$subcat->subcategory_slug_bn) }}" style="padding: 0px !important;">{{ $subcat->subcategory_name_bn }}</a></h2>
                                                        @else
                                                        <h2 class="title"><a href="{{ url('products/subcategory/'.$subcat->subcategory_slug_en) }}" style="padding: 0px !important;">{{ $subcat->subcategory_name_en }}</a></h2>
                                                        @endif

                                                        <hr style="padding: 0px !important; margin: 0px !important;">
                                                        <ul class="links list-unstyled"> 
                                                            @php
                                                            $sub_subcategories = App\Models\SubSubcategory::where('subcategory_id', $subcat->id)->orderBy('sub_subcategory_name_en','ASC')->get();
                                                            @endphp
                                                            @foreach($sub_subcategories as $sub_subcat)
                                                            <li>
                                                                @if(session()->get('language') == 'bangla')
                                                                <a href="{{ url('products/sub-subcategory/'.$sub_subcat->sub_subcategory_slug_bn) }}">{{ $sub_subcat->sub_subcategory_name_bn }}</a>
                                                                @else
                                                                <a href="{{ url('products/sub-subcategory/'.$sub_subcat->sub_subcategory_slug_en) }}">{{ $sub_subcat->sub_subcategory_name_en }}</a>
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div><!-- /.col -->
                                                    @endforeach
                                                </div><!-- /.row -->
                                                <br><br>
                                            </div><!-- /.col -->

                                            <div class="col-lg-5 col-md-6 col-sm-12">
                                                <div class="dropdown-banner-holder " style="margin: -13px -4px;">
                                                    @if(session()->get('language') == 'bangla')
                                                    <a href="{{ url('products/category/'.$category->category_slug_bn) }}" style="padding: 0px !important;"><img alt="" src="{{ asset('frontend') }}/assets/images/banners/banner-side.png" /></a>
                                                    @else
                                                    <a href="{{ url('products/category/'.$category->category_slug_en) }}" style="padding: 0px !important;"><img alt="" src="{{ asset('frontend') }}/assets/images/banners/banner-side.png" /></a>
                                                    @endif
                                                </div>
                                            </div>

                                        </div><!-- /.row -->
                                    </li><!-- /.yamm-content -->                    
                                </ul><!-- /.dropdown-menu -->  
                            </li><!-- /.menu-item -->
                            @endforeach

                        </ul><!-- /.nav -->
                    </nav><!-- /.megamenu-horizontal -->
                </div><!-- /.side-menu -->