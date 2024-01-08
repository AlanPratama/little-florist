<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productsIndex()
    {
        $products = Product::orderBy('sold', 'desc')->get();

        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('pages.user.product.productIndex', compact('products', 'carts'));
        } else {
            return view('pages.user.product.productIndex', compact('products'));
        }
    }

    public function detailProduct($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('pages.user.product.productDetail', compact('product', 'carts'));
        } else {
            return view('pages.user.product.productDetail', compact('product'));
        }
    }
























    public function addToCart(Request $request)
    {
        $productSlug = $request->input('productSlug');
        $product = Product::where('slug', $productSlug)->first();
        $cart = Cart::where('product_id', $product->id)->where('user_id', Auth::user()->id)->first();

        if ($cart) {
            $cart->total_product += 1;
            $cart->update();
        } else {
            $data = [
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
            ];

            Cart::create($data);
        }

        return response()->json(['success' => true, 'message' => 'Produk ditambahkan ke keranjang']);
    }


    public function deleteCart($id)
    {
        // Cart::where('id', $id)->delete();
        Cart::where('id', $id)->where('user_id', Auth::user()->id)->delete();


        return response()->json(['status' => 200]);
    }

}
