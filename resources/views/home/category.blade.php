@extends('master.main')
@section('title', $cat->name)
@section('main')
    <!-- main-area -->
    <main>
        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">{{ $cat->name }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $cat->name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- shop-area -->
        <section class="shop-area shop-bg" data-background="assets/img/bg/shop_bg.jpg">
            <div class="container custom-container-five">
                <div class="shop-inner-wrap">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="shop-item-wrap">
                                <div class="row">
                                    @foreach ($products as $item)
                                        <div class="col-xl-4 col-md-6">
                                            <div class="product-item-three inner-product-item">
                                                <div class="product-thumb-three">
                                                    <a href="{{ route('home.product', $item->id) }}"><img src="uploads/product/{{ $item->image }}" alt="Image"></a>
                                                    <span class="batch">New<i class="fas fa-star"></i></span>
                                                </div>
                                                <div class="product-content-three">
                                                    <a style="padding-bottom: 8px" class="tag">{{ $cat->name }}</a>
                                                    <h2 class="title"><a href="{{ route('home.product', $item->id) }}">{{ $item->name }}</a></h2>
                                                    <div>
                                                        @if ($item->sale_price > 0)
                                                            <span style="padding-right: 8px"><s>{{ number_format($item->price) }} đ</s></span>
                                                            <span style="color:#df2614; font-size:24px; font-weight:700; grid-area:auto; line-height:48px" class="price">{{ number_format($item->sale_price) }} đ</span>
                                                        @else
                                                            <span class="price">{{ number_format($item->price) }} đ</span>
                                                        @endif
                                                    </div>

                                                    <div class="favorite-action" style="display: flex; align-items: center; justify-content: center; padding-bottom: 8px">
                                                        @if (auth('cus')->check())
                                                            @if ($item->favorited)
                                                                <span><a title="Unlike" onclick="return confirm('Bạn có muốn bỏ thích sản phẩm này?')" href="{{ route('home.favorite', $item->id) }}"><i class="fas fa-heart"></i></a></span>
                                                            @else
                                                                <span><a title="Like" href="{{ route('home.favorite', $item->id) }}"><i class="far fa-heart"></i></a></span>
                                                            @endif

                                                            <div style="padding-left: 10px"><a title="Add to cart" href="{{ route('cart.add', $item->id) }}"><i class="fa fa-shopping-cart"></i></a> </div>
                                                        @else
                                                            <a title="Add to cart" href="{{route('account.login')}}" onclick="return confirm('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng')"><i class="fa fa-shopping-cart"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="product-shape-two">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 303 445" preserveAspectRatio="none">
                                                        <path d="M319,3802H602c5.523,0,10,5.24,10,11.71l-10,421.58c0,6.47-4.477,11.71-10,11.71H329c-5.523,0-10-5.24-10-11.71l-10-421.58C309,3807.24,313.477,3802,319,3802Z" transform="translate(-309 -3802)" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <div class="shop-sidebar">
                                <div class="shop-widget">
                                    <h4 class="sw-title">Lọc theo giá</h4>
                                    <form action="{{ route('home.category', $cat->id) }}" method="GET" id="filterForm">
                                        <div class="price_filter">
                                            <div id="slider-range"></div>
                                            <div class="price_slider_amount mt-3">
                                                <input type="text" id="amount" readonly>
                                                <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price', 0) }}">
                                                <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price', 1000000) }}">
                                                <input type="submit" class="btn" value="Lọc">
                                            </div>
                                            <div class="clear-btn mt-2">
                                                <a href="{{ route('home.category', $cat->id) }}" class="btn btn-light">
                                                    Xóa
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="shop-widget">
                                    <h4 class="sw-title">Sản phẩm mới nhất</h4>
                                    @foreach ($new_products as $item)
                                    <div class="latest-products-wrap">
                                        <div class="lp-item">
                                            <div class="lp-thumb">
                                                <a href="{{ route('home.product', $item->id) }}"><img src="uploads/product/{{ $item->image }}" alt="Image"></a>
                                            </div>
                                            <div class="lp-content">
                                                <h4 class="title"><a href="{{ route('home.product', $item->id) }}">{{ $item->name }}</a></h4>
                                                <div style="display: flex; align-items: center; justify-content: center;">
                                                    @if ($item->sale_price > 0)
                                                        <div style="color: #7F6F6C; padding-right: 8px"><span><s>{{ number_format($item->price) }} đ</s></span></div>
                                                        <span style="color:#df2614; font-size:20px; font-weight:700; grid-area:auto; line-height:48px" >{{ number_format($item->sale_price) }} đ</span>
                                                    @else
                                                        <span>{{ number_format($item->price) }} đ</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop-area-end -->

    </main>
    <!-- main-area-end -->
    <!-- paginate -->
    {{ $products->appends(request()->all())->links() }}
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            let min = parseInt("{{ request('min_price', 0) }}");
            let max = parseInt("{{ request('max_price', 1000000) }}");

            // Slider jQuery UI
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1000000,
                step: 10000, // step 10.000đ
                values: [min, max],
                slide: function (event, ui) {
                    $("#amount").val(
                        ui.values[0].toLocaleString("vi-VN") +
                            " đ - " +
                            ui.values[1].toLocaleString("vi-VN") +
                            " đ"
                    );
                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);
                },
            });
            $("#amount").val(
                $("#slider-range").slider("values", 0).toLocaleString("vi-VN") +
                    " đ - " +
                    $("#slider-range").slider("values", 1).toLocaleString("vi-VN") +
                    " đ"
            );
        });
    </script>
@endsection