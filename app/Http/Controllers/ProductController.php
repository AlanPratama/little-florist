<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productsIndex()
    {
        $products = Product::all();
        return view('pages.user.product.productIndex', compact('products'));
    }

    public function detailProduct($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('pages.user.product.productDetail', compact('product'));
    }
}
