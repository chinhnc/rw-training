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
                <div id="logo">
                    <a class="sm-logo" href="{{ route('home') }}"><span>アフリエイトサイト</span></a>
                    @if(Auth::user())
                        <a class="sm-user-pb" href="{{ route('passbook') }}">
                            <span class="sm-pb">
                                {{ Auth::user()->getCurrentPoint ? Auth::user()->getCurrentPoint->approval_point : 0 }}pt
                            </span>
                            (判定中
                            <span class="sm-pb">
                                {{ Auth::user()->getCurrentPoint ? Auth::user()->getCurrentPoint->pending_point : 0 }}pt
                            </span>)
                        </a>
                    @endif
                </div>
            </div>
            <!-- brand and toggle menu for mobile End -->

            <!-- Navbar Start -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('news') }}">お知らせ</a></li>
                    <li><a href="{{ route('contact.create') }}">問い合わせ</a></li>
                    @guest
                        <li><a href="{{ route('login') }}"><i class="lnr lnr-enter"></i> ログイン</a></li>
                        <li><a href="{{ route('register') }}"><i class="lnr lnr-user"></i> 登録</a></li>
                    @else
                        <li>
                            <a href="{{ route('passbook') }}">
                                <span style="color: #ff5500;">
                                    {{ Auth::user()->getCurrentPoint ? Auth::user()->getCurrentPoint->approval_point : 0 }}pt
                                </span>
                                (判定中
                                <span style="color: #ff5500;">{{ Auth::user()->getCurrentPoint ? Auth::user()->getCurrentPoint->pending_point : 0 }}
                                    pt
                                </span>)
                            </a>
                        </li>
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
    <!-- Off Canvas Navigation -->
    <div class="navmenu navmenu-default navmenu-fixed-left offcanvas sm-categories">
        <!--- Off Canvas Side Menu -->
        <div class="close" data-toggle="offcanvas" data-target=".navmenu">
            <i class="fa fa-close"></i>
        </div>
        <h3 class="title-menu">カテゴリー</h3>
        <ul class="nav navmenu-nav"> <!--- Menu -->
            @foreach($categories as $category)
                <li><a href="{{ route('show_items_by_category', $category->id) }}">{{ $category->name }} ({{ sizeof($category->items) }})</a></li>
            @endforeach
        </ul><!--- End Menu -->
    </div> <!--- End Off Canvas Side Menu -->
    <div class="tbtn wow pulse sm-categories" id="menu" data-wow-iteration="infinite" data-wow-duration="500ms" data-toggle="offcanvas" data-target=".navmenu">
        <p>カテゴリー</p>
    </div>
</div>
<!-- Header Section End -->