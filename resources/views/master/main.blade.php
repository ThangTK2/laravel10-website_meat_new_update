<!doctype html>
<html class="no-js" lang="en">
    <head>
        <base href="/">
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="Bemet - Butcher & Meat Shop HTML Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="uploads/favicon.png">
        <!-- Place favicon.ico in the root directory -->

        <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/flaticon.css">
        <link rel="stylesheet" href="assets/css/odometer.css">
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/default.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/css/customize.css">
    </head>
    <body>

        <!-- preloader -->
        {{-- <div id="preloader">
            <div id="loading-center">
                <div class="loader">
                    <div class="loader-outter"></div>
                    <div class="loader-inner"></div>
                </div>
            </div>
        </div> --}}
        <!-- preloader-end -->

		<!-- Scroll-top -->
        <button class="scroll-top scroll-to-target" data-target="html">
            <i class="fas fa-angle-up"></i>
        </button>
        <!-- Scroll-top-end-->

        <!-- header-area -->
        <header class="transparent-header">
            <div class="header-top-wrap">
                <div class="container custom-container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="header-top-left">
                                <ul class="list-wrap">
                                    <li class="header-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Đà Nẵng, Việt Nam
                                    </li>
                                    <li>
                                        <a href="mailto:info@example.com"><i class="fas fa-envelope"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4">
                            <div class="header-top-right">
                                <div class="header-top-menu">
                                    <ul class="list-wrap">
                                        @if ( auth('cus')->check())
                                            <li><a href="{{ route('account.profile') }}">Chào, {{ auth('cus')->user()->name }}</a></li>
                                            <li><a href="{{ route('account.favorite') }}">Sản phẩm yêu thích</a></li>
                                            <li><a href="{{ route('order.history') }}">Đơn hàng</a></li>
                                            <li><a href="{{ route('account.change_password') }}">Đổi mật khẩu</a></li>
                                            <li><a onclick="return confirm('Bạn có muốn đăng xuất không?')" href="{{ route('account.logout') }}">Đăng xuất</a></li>
                                        @else
                                            <li><a href="{{ route('account.login') }}">Đăng nhập</a></li>
                                            <li><a href="{{ route('account.register') }}">Đăng ký</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="header-top-social">
                                    <ul class="list-wrap">
                                        <li><a href="https://www.facebook.com/Thang.TK2"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://www.instagram.com/thawng.tk2?fbclid=IwAR1kZep39G4laTF2-QUpj8ieR9jTelI4MXKA_fCdml2Hhms3_UgsxOyCAdQ"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sticky-header" class="menu-area">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="menu-wrap">
                                <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                                <nav class="menu-nav">
                                    <div class="logo">
                                        <a href="{{ route('home.index') }}"><img src="uploads/logo/logo.png" alt="Logo"></a>
                                    </div>
                                    <div class="navbar-wrap main-menu d-none d-lg-flex">
                                        <ul class="navigation">
                                            <li class="{{ request()->routeIs('home.index') ? 'active' : '' }}">
                                                <a href="{{ route('home.index') }}">Trang chủ</a>
                                            </li>

                                            <li class="{{ request()->routeIs('home.product_all', 'home.category*') ? 'active' : '' }}">
                                                <a href="{{ route('home.product_all') }}">Sản phẩm</a>
                                                <ul class="sub-menu">
                                                    @foreach ($cats_home as $item)
                                                        <li><a href="{{ route('home.category', $item->id) }}">{{ $item->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>

                                            <li class="{{ request()->routeIs('home.about') ? 'active' : '' }}">
                                                <a href="{{ route('home.about') }}">Về chúng tôi</a>
                                            </li>

                                            <li class="{{ request()->routeIs('home.page') ? 'active' : '' }}">
                                                <a href="{{ route('home.page') }}">Pages</a>
                                            </li>

                                            <li class="{{ request()->routeIs('home.contact') ? 'active' : '' }}">
                                                <a href="{{ route('home.contact') }}">Liên hệ</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="header-action d-none d-md-block">
                                        <ul class="list-wrap">
                                            <form action="" class="form-inline">
                                                <li class="header-search">
                                                    <a href="#"><i class="flaticon-search"></i></a>
                                                </li>
                                            </form>
                                            <li class="header-shop-cart">
                                                <a href="{{ route('cart.index') }}">
                                                    <i class="flaticon-shopping-basket"></i>
                                                    <span>{{ $carts->sum('quantity') }}</span>
                                                </a>
                                            </li>
                                            <li class="header-btn"><a href="tel:0123456789" class="btn">0 929 029 035</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>

                            <!-- Mobile Menu  -->
                            <div class="mobile-menu">
                                <nav class="menu-box">
                                    <div class="close-btn"><i class="fas fa-times"></i></div>
                                    <div class="nav-logo">
                                        <a href="index-2.html"><img src="uploads/logo/logo.png" alt="Logo"></a>
                                    </div>
                                    <div class="menu-outer">
                                    </div>
                                    <div class="social-links">
                                        <ul class="clearfix list-wrap">
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="menu-backdrop"></div>
                            <!-- End Mobile Menu -->

                        </div>
                    </div>
                </div>
            </div>

            <!-- header-search -->
            <div class="search-popup-wrap" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="search-wrap text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="search-form">
                                    <form action="">
                                        <input type="text" name="keyword" placeholder="Enter your keyword...">
                                        <button class="search-btn"><i class="flaticon-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="search-backdrop"></div>
            <!-- header-search-end -->

        </header>
        <!-- header-area-end -->

        @yield('main')

        <!-- footer-area -->
        <footer>
            <div class="footer-area">
                <div class="footer-logo-area">
                    <div class="container">
                        <div class="footer-logo-wrap">
                            <ul class="list-wrap">
                                <li class="order-0 order-lg-2">
                                    <div class="footer-logo">
                                        <a href="{{ route('home.index') }}"><img src="uploads/logo/w_logo.png" alt=""></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-social">
                                        <ul class="list-wrap">
                                            <li><a href="https://www.facebook.com/Thang.TK2"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="order-lg-3">
                                    <div class="footer-newsletter">
                                        <h4 class="title">BẢN TIN CỦA CHÚNG TÔI</h4>
                                        <form action="#">
                                            <input type="email" placeholder="Email của bạn...">
                                            <button type="submit">subscribe</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="footer-widget">
                                    <h4 class="fw-title">giới thiệu</h4>
                                    <div class="footer-contact">
                                        <ul class="list-wrap">
                                            <li>Da Nang, Viet Nam</li>
                                            <li><a href="tel:0123456789">0 929 029 035</a></li>
                                            <li><a href="mailto:info@bemet.com">nht1072@gmail.com</a></li>
                                        </ul>
                                    </div>
                                    <!-- <div class="footer-content">
                                        <h4 class="title">Giờ mở cửa</h4>
                                        <p>Thứ 2 đến Chủ Nhật <span>08:00-18:00</span></p>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="footer-widget">
                                    <h4 class="fw-title">LIÊN KẾT QUAN TRỌNG</h4>
                                    <div class="footer-link">
                                        <ul class="list-wrap">
                                            <li><a href="{{ route('home.product_all') }}">Sản phẩm</a></li>
                                            <li><a href="{{ route('home.about') }}">Về chúng tôi</a></li>
                                            <li><a href="{{ route('home.page') }}">Pages</a></li>
                                            <li><a href="{{ route('home.contact') }}">Liên hệ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-4">
                                <div class="footer-widget">
                                    <h4 class="fw-title">Danh mục</h4>
                                    <div class="footer-link">
                                        <ul class="list-wrap">
                                            @foreach ($cats_home as $item)
                                                <li><a href="{{ route('home.category', $item->id) }}">{{ $item->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-8">
                                <div class="footer-widget">
                                    <!-- <h4 class="fw-title">instagram</h4> -->
                                    <div class="footer-instagram">
                                        <ul class="list-wrap">
                                            <li><a href="#"><img src="uploads/images/footer_insta01.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="uploads/images/footer_insta02.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="uploads/images/footer_insta03.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="uploads/images/footer_insta04.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="uploads/images/footer_insta05.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="uploads/images/footer_insta06.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="uploads/images/footer_insta07.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="uploads/images/footer_insta08.jpg" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-7">
                                <div class="copyright-text">
                                    <p>© {{ date('Y') }} <a href="https://www.facebook.com/Thang.TK2">Bemet</a>, All Rights Reserved</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5">
                                <div class="footer-card text-end">
                                    <img src="uploads/images/card.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer-area-end -->

        <!-- JS here -->
        <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/jquery.countdown.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/jquery.odometer.min.js"></script>
        <script src="assets/js/jquery.appear.js"></script>
        <script src="assets/js/tween-max.min.js"></script>
        <script src="assets/js/slick.min.js"></script>
        <script src="assets/js/slick-animation.min.js"></script>
        <script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/js/ajax-form.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/main.js"></script>

        @yield('js')
    </body>
</html>
