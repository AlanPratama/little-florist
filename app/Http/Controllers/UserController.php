<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function homepage()
    {
        $products = Product::where('sold', 'desc')->get();

        return view('pages.user.homepage', compact('products'));
    }
}
