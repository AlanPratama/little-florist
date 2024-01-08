<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function homepage()
    {
        $products = Product::orderBy('sold', 'desc')->get();
        if (Auth::user()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('pages.user.homepage', compact('products', 'carts'));
        } else {
            return view('pages.user.homepage', compact('products'));
        }
    }
}
