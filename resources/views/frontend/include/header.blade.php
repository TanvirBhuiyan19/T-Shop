<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">                       

                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="{{ route('wishlistPage') }}"><i class="icon fa fa-heart"></i>
                                @if(session()->get('language') == 'bangla') ইচ্ছেতালিকা @else Wishlist @endif
                            </a></li>
                        <li><a href="{{ route('cartPage') }}"><i class="icon fa fa-shopping-cart"></i>
                                @if(session()->get('language') == 'bangla') আমার কার্ট @else My Cart @endif
                            </a></li>
                        <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>
                                @if(session()->get('language') == 'bangla') চেক-আউট @else Checkout @endif    
                            </a></li>

                    </ul>
                </div>

                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">


                        <li class="dropdown dropdown-small">
                            <a href="" data-toggle="modal" data-target=".bd-example-modal-sm"><span class="value">
                                @if(session()->get('language') == 'bangla') ওয়ার্ডারের গতিপথ @else Track Order @endif
                            </span></a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                @guest
                                @if (Route::has('login'))
                                <a href="{{url('/login')}}"><strong class="icon fa fa-sign-in value" style="margin-right: -5px;"></strong>
                                    <span class="value"> @if(session()->get('language') == 'bangla') লগিন/রেজিষ্টেশন @else Login/Register @endif </span>
                                </a>
                                @endif
                                @else

                                <span class="value">{{ Auth::user()->name }}</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/user/dashboard')}}" style="color: #59B210;"> 
                                        @if(session()->get('language') == 'bangla')
                                        ড্যাশবোর্ড
                                        @else
                                        Dashboard
                                        @endif
                                    </a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" style="color: red"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        <i class="icon ion-power" ></i> @if(session()->get('language') == 'bangla') লগ-আউট @else {{ __('Logout') }} @endif
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            @endguest
                        </li>



                        <li class="dropdown dropdown-small">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value"> 
                                    @if(session()->get('language') == 'bangla')
                                    বাংলা
                                    @else
                                    English
                                    @endif
                                </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @if(session()->get('language') == 'bangla')
                                <li><a href="{{route('english.language')}}">English</a></li>
                                @else
                                <li><a href="{{route('bangla.language')}}">বাংলা</a></li>
                                @endif
                            </ul>
                        </li>


                    </ul><!-- /.list-unstyled -->
                </div><!-- /.cnt-cart -->

<!--========================== Order Track Modal ================================================-->
                <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                            @if(session()->get('language') == 'bangla') আপনার ওয়ার্ডারের গতিপথ বের করুণ @else Track Your Order @endif
                            </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px; color: red;">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          <form action="{{ route('order.track') }}" method="POST">
                              @csrf
                            <div class="modal-body">
                                  <br>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">
                                    @if(session()->get('language') == 'bangla') ইনভয়েস নাম্বার দিনঃ @else Invoice Number: @endif
                                    </label>
                                  <input type="text" class="form-control" name="invoice_no">
                                </div>
                                  <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: left">
                                    @if(session()->get('language') == 'bangla') বন্ধ করুণ @else Close @endif
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    @if(session()->get('language') == 'bangla') গতিপথ @else Track Order @endif
                                </button>
                            </div>
                          </form>
                      </div>
                    </div>
                </div>
<!--========================== End: Order Track Modal ================================================-->

                <div class="clearfix"></div>
            </div><!-- /.header-top-inner -->

        </div><!-- /.container -->
    </div><!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo">
                        <a href="{{url('/')}}">
                            @if($settings->site_logo) 
                            <img style="margin-left:10px" src="{{ asset('uploads/settings/'.$settings->site_logo ) }}" >
                            @elseif($settings->site_name) 
                            {{$settings->site_name}} 
                            @else {{ config('app.name') }} @endif
                            {{-- <img src="{{ asset('frontend') }}/assets/images/logo.png" alt=""> --}}

                        </a>
                    </div><!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->				
                </div><!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form action="{{ url('/search-products/') }}" method="GET">
                             
                            <div class="control-group">
                                <input class="search-field" onfocus="showSearchResult()" onblur="hideSearchResult()" name="search" id="search" style="width: 81%;" 
                                       autocomplete="off" placeholder="@if(session()->get('language') == 'bangla') এখানে অনুসন্ধান করুন... @else Search here... @endif" />
                                <button class="search-button" type="submit"></button>
                            </div>
                        </form>
                        
                        <div id="suggestProduct"></div>
                    </div><!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->				
                </div><!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart">
                        <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket" style="border: none;">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                </div>
                                <div class="basket-item-count">
                                    @if(session()->get('language') == 'bangla')
                                    <span class="count cartQtybn"></span>
                                    @else
                                    <span class="count cartQtyen"></span>
                                    @endif
                                </div>
                                <div class="total-price-basket">
                                    <span class="lbl"> @if(session()->get('language') == 'bangla') কার্ট - @else cart - @endif </span>
                                    <span class="total-price">
                                        @if(session()->get('language') == 'bangla')
                                        <span class="sign cart_totalbn"></span>
                                        @else
                                        <span class="sign cart_totalen"></span>
                                        @endif
                                    </span>
                                </div>


                            </div>
                        </a>
                        <ul class="dropdown-menu" style="width: 300px">
                            <li>
                                <!--==================================== Mini Cart ================================-->
                                <div id="miniCart" style=" padding-right: 15px; max-height: 310px !important; overflow-y: visible; overflow-x: hidden;">

                                </div>
                                <!--==================================== End: Mini Cart ================================--> 
                                <hr>

                                <div class="clearfix cart-total">
                                    <div class="pull-right">
                                        <span class="text"> @if(session()->get('language') == 'bangla') মোট : @else Subtotal : @endif </span>
                                        @if(session()->get('language') == 'bangla')
                                        <span class='price cart_totalbn'></span>
                                        @else
                                        <span class='price cart_totalen'></span>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>

                                    <a href="{{ route('cartPage') }}" class="btn btn-upper btn-primary btn-block m-t-20">
                                        @if(session()->get('language') == 'bangla')
                                        কার্ট দেখুন
                                        @else
                                        View Cart
                                        @endif
                                    </a>	
                                </div><!-- /.cart-total-->


                            </li>
                        </ul><!-- /.dropdown-menu-->
                    </div><!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
            </div><!-- /.row -->

        </div><!-- /.container -->

    </div><!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw">
                                    {{-- <a href="{{url('/')}}" >@if(session()->get('language') == 'bangla') হোম @else Home @endif</a> --}}
                                    <a href="{{ route('shop') }}">
                                        @if(session()->get('language') == 'bangla')
                                        শপ 
                                        @else
                                        Shop
                                        @endif
                                    </a>
                                </li>

                                @php
                                $categories = App\Models\Category::orderBy('category_name_en','ASC')->get();
                                @endphp
                                @foreach($categories as $category)
                                <li class="dropdown yamm mega-menu">

                                    @if(session()->get('language') == 'bangla')
                                    <a href="{{ url('products/category/'.$category->category_slug_bn) }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{$category->category_name_bn}}</a>
                                    @else
                                    <a href="{{ url('products/category/'.$category->category_slug_en) }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{$category->category_name_en}}</a>
                                    @endif                                       


                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">

                                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                                        <div class="row">
                                                            @php
                                                            $subcategories = App\Models\Subcategory::where('category_id', $category->id)->orderBy('subcategory_name_en','ASC')->get();
                                                            @endphp
                                                            @foreach($subcategories as $subcat)
                                                            <div class="col-xs-12 col-sm-6 col-md-3 col-menu">

                                                                @if(session()->get('language') == 'bangla')
                                                                <h2 class="title"><a href="{{ url('products/subcategory/'.$subcat->subcategory_slug_bn) }}" style="padding: 0px !important;">{{ $subcat->subcategory_name_bn }}</a></h2>
                                                                @else
                                                                <h2 class="title"><a href="{{ url('products/subcategory/'.$subcat->subcategory_slug_en) }}" style="padding: 0px !important;">{{ $subcat->subcategory_name_en }}</a></h2>
                                                                @endif

                                                                <hr style="padding: 0px !important; margin: 0px !important;">
                                                                <ul class="links">
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
                                                    </div><!-- /.col -->


                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-menu banner-image">
                                                        @if(session()->get('language') == 'bangla')
                                                        <a href="{{ url('products/category/'.$category->category_slug_bn) }}" style="padding: 0px !important;"><img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/top-menu-banner.jpg" alt=""></a>
                                                        @else
                                                        <a href="{{ url('products/category/'.$category->category_slug_en) }}" style="padding: 0px !important;"><img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/top-menu-banner.jpg" alt=""></a>
                                                        @endif

                                                    </div><!-- /.yamm-content -->					
                                                </div>
                                            </div>

                                        </li>
                                    </ul>

                                </li>

                                @endforeach


                            </ul><!-- /.navbar-nav -->
                            <div class="clearfix"></div>				
                        </div><!-- /.nav-outer -->
                    </div><!-- /.navbar-collapse -->


                </div><!-- /.nav-bg-class -->
            </div><!-- /.navbar-default -->
        </div><!-- /.container-class -->

    </div><!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>