<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon; //thư viện hỗ trợ làm việc với ngày và giờ
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $customerId = auth('cus')->id();
        $carts = Cart::where('customer_id', $customerId)->get();

        // Kiểm tra và cập nhật giá nếu khuyến mãi đã hết hạn
        foreach ($carts as $cart) {
            $product = $cart->prod;
            if ($product) {
                if ($product->sale_price > 0 && $product->sale_end_date && Carbon::parse($product->sale_end_date)->isPast()) {
                    // Reset sale trong DB product
                    $product->sale_price = 0;
                    $product->sale_end_date = null;
                    $product->save();

                    // Cập nhật lại giá trong cart
                    $cart->update(['price' => $product->price]);
                }
            }
        }

        // Lấy lại danh sách mới sau khi cập nhật
        $carts = Cart::where('customer_id', $customerId)->get();

        return view('home.cart', compact('carts'));
    }

    public function add(Product $product, Request $request)
    {
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $customerId = auth('cus')->id();

        // Kiểm tra nếu khuyến mãi đã hết hạn
        if ($product->sale_price > 0 && $product->sale_end_date && Carbon::parse($product->sale_end_date)->isPast()) {
            $product->sale_price = 0;
            $product->sale_end_date = null;
            $product->save();
        }

        // Chọn giá đúng (giá giảm nếu còn hạn, ngược lại giá gốc)
        $price = ($product->sale_price > 0) ? $product->sale_price : $product->price;

        $cartExits = Cart::where(['customer_id' => $customerId, 'product_id' => $product->id])->first();
        if ($cartExits) {
            $cartExits->increment('quantity', $quantity);
            return redirect()->route('cart.index')->with('success', 'Cập nhật giỏ hàng thành công');
        } else {
            $data = [
                'customer_id' => $customerId,
                'product_id' => $product->id,
                'price' => $price,
                'quantity' => $quantity
            ];
            if (Cart::create($data)) {
                return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
            }
        }
        return redirect()->back()->with('error', 'Không thể thêm sản phẩm vào giỏ hàng');
    }

    public function update(Product $product, Request $request) {
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $cartExits = Cart::where(['customer_id' => auth('cus')->id(), 'product_id' => $product->id])->first();
        if ($cartExits) {
            Cart::where(['customer_id' => auth('cus')->id(), 'product_id' => $product->id])->update(['quantity'=> $quantity]);
            return redirect()->route('cart.index')->with('success', 'Bạn đã cập nhật giỏ hàng thành công');
        }
        return redirect()->back()->with('error', 'Bạn đã cập nhật giỏ hàng không thành công');
    }

    public function delete($product_id) {
        Cart::where(['customer_id' => auth('cus')->id(), 'product_id' => $product_id])->delete();
        return redirect()->back()->with('success', 'Bạn đã xóa thành công sản phẩm trong giỏ hàng');
    }

    public function clear() {
        Cart::where(['customer_id' => auth('cus')->id()])->delete();
        return redirect()->back()->with('success', 'Bạn đã xóa thành công tất cả các sản phẩm trong giỏ hàng');
    }

}
