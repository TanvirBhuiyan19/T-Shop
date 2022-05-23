<footer id="footer" class="footer color-bg">


    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Contact Us</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class="toggle-footer" >
                            <li class="media">
                                <div class="pull-left">
                                    <span class="icon fa-stack fa-lg">
                                        <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    @if($settings->address) 
                                    <p>{{$settings->address}}</p> 
                                    @else 
                                    <p>ThemesGround, 789 Main rd, Anytown, CA 12345 USA</p> 
                                    @endif
                                </div>
                            </li>

                            <li class="media">
                                <div class="pull-left">
                                    <span class="icon fa-stack fa-lg">
                                        <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    @if($settings->mobile) 
                                    <a href="tel:{{$settings->mobile}}"><p>{{$settings->mobile}}</p></a> 
                                    @else 
                                    <p>+(888) 123-4567<br>+(888) 456-7890</p>
                                    @endif
                                </div>
                            </li>

                            <li class="media">
                                <div class="pull-left">
                                    <span class="icon fa-stack fa-lg">
                                        <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    @if($settings->email) 
                                    <a href="mailto:{{$settings->email}}">
                                        <span>{{$settings->email}}</span> 
                                    </a>
                                    @else 
                                    <span><a href="#">flipmart@themesground.com</a></span>
                                    @endif
                                </div>
                            </li>

                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Customer Service</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a href="#" title="Contact us">My Account</a></li>
                            <li><a href="#" title="About us">Order History</a></li>
                            <li><a href="#" title="faq">FAQ</a></li>
                            <li><a href="#" title="Popular Searches">Specials</a></li>
                            <li class="last"><a href="#" title="Where is my order?">Help Center</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Corporation</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a title="Your Account" href="#">About us</a></li>
                            <li><a title="Information" href="#">Customer Service</a></li>
                            <li><a title="Addresses" href="#">Company</a></li>
                            <li><a title="Addresses" href="#">Investor Relations</a></li>
                            <li class="last"><a title="Orders History" href="#">Advanced Search</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Why Choose Us</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a href="#" title="About us">Shopping Guide</a></li>
                            <li><a href="#" title="Blog">Blog</a></li>
                            <li><a href="#" title="Company">Company</a></li>
                            <li><a href="#" title="Investor Relations">Investor Relations</a></li>
                            <li class=" last"><a href="contact-us.html" title="Suppliers">Contact Us</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-padding social">
                <ul class="link">
                    @isset($settings->facebook)
                    <li class="fb pull-left"><a target="_blank" rel="nofollow" href="{{$settings->facebook}}" title="Facebook"></a></li>
                    @endisset
                    @isset($settings->twitter)
                    <li class="tw pull-left"><a target="_blank" rel="nofollow" href="{{$settings->twitter}}" title="Twitter"></a></li>
                    @endisset
                    @isset($settings->instagram)
                    <li class="ig pull-left"><a target="_blank" rel="nofollow" href="{{$settings->instagram}}" title="Instagram"></a></li>
                    @endisset
                    @isset($settings->pinterest)
                    <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="{{$settings->pinterest}}" title="PInterest"></a></li>
                    @endisset
                    @isset($settings->linkedin)
                    <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="{{$settings->linkedin}}" title="Linkedin"></a></li>
                    @endisset
                    @isset($settings->youtube)
                    <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="{{$settings->youtube}}" title="Youtube"></a></li>
                    @endisset
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="clearfix payment-methods">
                    <ul>
                        <li><img src="{{ asset('frontend') }}/assets/images/payments/1.png" alt=""></li>
                        <li><img src="{{ asset('frontend') }}/assets/images/payments/2.png" alt=""></li>
                        <li><img src="{{ asset('frontend') }}/assets/images/payments/3.png" alt=""></li>
                        <li><img src="{{ asset('frontend') }}/assets/images/payments/4.png" alt=""></li>
                        <li><img src="{{ asset('frontend') }}/assets/images/payments/5.png" alt=""></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div>
    </div>
</footer>