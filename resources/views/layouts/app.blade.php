<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Main Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/jasny-bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/material-kit.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/fonts/line-icons/line-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/extras/animate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/extras/owl.carousel.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/extras/owl.theme.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/extras/settings.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}" type="text/css">
    @yield('stylesheet')
</head>
<body>
    <!-- Header Section Start -->
    <div class="header">
        <nav class="navbar navbar-default main-navigation" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <!-- Stat Toggle Nav Link For Mobiles -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- End Toggle Nav Link For Mobiles -->
                    <a class="navbar-brand logo" href="/home"><img src="assets/img/logo.png" alt=""></a>
                </div>
                <!-- brand and toggle menu for mobile End -->

                <!-- Navbar Start -->
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{ route('login') }}"><i class="lnr lnr-enter"></i> Login</a></li>
                            <li><a href="{{ route('register') }}"><i class="lnr lnr-user"></i> Signup</a></li>
                        @else
                            <li>
                                <a href="{{ route('user_show') }}"><i class="lnr lnr-user"></i>{{ Auth::user()->nickname }}</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="lnr lnr-enter"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
                <!-- Navbar End -->
            </div>
        </nav>
    </div>
    <!-- Header Section End -->

    <div id="app">
        @yield('content')
    </div>

    <!-- Footer Section Start -->
    <footer>
        <!-- Footer Area Start -->
        <section class="footer-Content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="widget">
                            <h3 class="block-title">About</h3>
                            <div class="textwidget">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lobortis tincidunt est, et euismod purus suscipit quis. Etiam euismod ornare elementum. Sed ex est, consectetur eget facilisis sed, auctor ut purus.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="widget">
                            <h3 class="block-title">Links</h3>
                            <ul class="menu">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Categories</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Left Sidebar</a></li>
                                <li><a href="#">Pricing Plans</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Full Width Page</a></li>
                                <li><a href="#">Notifications</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="widget">
                            <h3 class="block-title">Latest Tweets</h3>
                            <div class="twitter-content clearfix">
                                <ul class="twitter-list">
                                    <li class="clearfix">
                      <span>
                        Make sure you are following
                        <a href="#">@Graygrids</a> for all your Wingthemes needs!
                      </span>
                                    </li>
                                    <li class="clearfix">
                      <span>
                        Eight marketplaces, one Graygrids Market. Join us:
                        <a href="#">http://t.co/cLo2w7rWOx</a>
                      </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="widget">
                            <h3 class="block-title">Premium Ads</h3>
                            <ul class="featured-list">
                                <li>
                                    <img alt="" src="assets/img/featured/img1.jpg">
                                    <div class="hover">
                                        <a href="#"><span>$49</span></a>
                                    </div>
                                </li>
                                <li>
                                    <img alt="" src="assets/img/featured/img2.jpg">
                                    <div class="hover">
                                        <a href="#"><span>$49</span></a>
                                    </div>
                                </li>
                                <li>
                                    <img alt="" src="assets/img/featured/img3.jpg">
                                    <div class="hover">
                                        <a href="#"><span>$49</span></a>
                                    </div>
                                </li>
                                <li>
                                    <img alt="" src="assets/img/featured/img4.jpg">
                                    <div class="hover">
                                        <a href="#"><span>$49</span></a>
                                    </div>
                                </li>
                                <li>
                                    <img alt="" src="assets/img/featured/img5.jpg">
                                    <div class="hover">
                                        <a href="#"><span>$49</span></a>
                                    </div>
                                </li>
                                <li>
                                    <img alt="" src="assets/img/featured/img6.jpg">
                                    <div class="hover">
                                        <a href="#"><span>$49</span></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer area End -->

        <!-- Copyright Start  -->
        <div id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="site-info pull-left">
                            <p>Design & Development by <a rel="nofollow" href="http://http://realworld.co.jp/">REALWORLD</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

    </footer>
    <!-- Footer Section End -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/material.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/material-kit.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.parallax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/wow.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jasny-bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    @yield('javascript')
</body>
</html>
