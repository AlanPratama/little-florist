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
        $products = Product::all();
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('pages.user.product.productIndex', compact('products', 'carts'));
    }

    public function detailProduct($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('pages.user.product.productDetail', compact('product'));
    }



    public function addToCart(Request $request)
    {
        $productSlug = $request->input('productSlug');
        $product = Product::where('slug', $productSlug)->first();
        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
        ];

        Cart::create($data);

        return response()->json(['success' => true, 'message' => 'Produk ditambahkan ke keranjang']);
    }

}
