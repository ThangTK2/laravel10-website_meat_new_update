@extends('master.main')
@section('title', 'Giỏ Hàng Của Bạn')
@section('main')
    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Giỏ Hàng Của Bạn</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your Carts</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- contact-area -->
        <section class="contact-area">
            <div class="container" style="padding: 125px 0">
                <table class="table table-striped table-inverse table-responsive table-bordered text-center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Hình ảnh</th>
                            <th>Ngày</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->prod->name ?? 'Sản phẩm không tồn tại' }}</td>
                                <!-- ->isFuture() trong Carbon dùng để kiểm tra xem một thời điểm có nằm trong tương lai hay không -->
                                <td>
                                    @if ($item->prod && $item->prod->sale_price > 0 && $item->prod->sale_end_date && \Carbon\Carbon::parse($item->prod->sale_end_date)->isFuture()) 
                                        <u style="text-decoration: line-through; padding-right: 5px;">{{ number_format($item->prod->price) }} đ</u>
                                        {{ number_format($item->prod->sale_price) }} đ
                                    @else
                                        {{ number_format($item->prod->price) }} đ
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('cart.update', $item->product_id) }}" method="get">
                                        <input type="number" min="1" name="quantity" value="{{ $item->quantity }}" style="width: 50px; text-align: center">
                                        <button><i class="fa fa-save"></i></button>
                                    </form>
                                </td>
                                <td>
                                    @if ($item->prod)
                                        <img src="{{ asset('uploads/product/' . $item->prod->image) }}" width="50" alt="{{ $item->prod->name }}">
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a title="Xóa sản phẩm" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" href="{{ route('cart.delete', $item->product_id) }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>
                <br>
                <div class="text-center">
                    <a href="" class="btn"><i class="fa fa-arrow-left" style="padding-right: 12px"></i>Tiếp tục mua sắm</a>
                    @if ($carts->count())
                        <a href="{{ route('cart.clear') }}" class="btn" onclick="return confirm('Do you want to remove all product from your cart?')"><i style="padding-right: 12px" class="fa fa-trash"></i>Xóa tất cả</a>
                        <a href="{{ route('order.checkout') }}" class="btn">Đặt hàng <i style="padding-left: 12px" class="fa fa-arrow-right"></i></a>
                    @endif
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
