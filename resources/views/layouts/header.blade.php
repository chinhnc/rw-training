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
                <a class="navbar-brand logo" href="{{ route('home') }}"><img src="/assets/img/logo.png" alt=""></a>
            </div>
            <!-- brand and toggle menu for mobile End -->

            <!-- Navbar Start -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li><a href="{{ route('login') }}"><i class="lnr lnr-enter"></i> ログイン</a></li>
                        <li><a href="{{ route('register') }}"><i class="lnr lnr-user"></i> 登録</a></li>
                    @else
                        <li>
                            <a href="{{ route('user_show') }}"><i class="lnr lnr-user"></i>{{ Auth::user()->nickname }}</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="lnr lnr-enter"></i>
                                ログアウト
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