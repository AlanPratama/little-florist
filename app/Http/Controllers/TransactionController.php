<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function start(Request $request)
    {
        $productArray = $request->product;
        $soldArray = $request->sold;
        session()->put('productArray', $productArray);
        session()->put('soldArray', $soldArray);

        return redirect()->route('transaction.detail');
    }

    public function detail(Request $request)
    {
        $productArray = session()->get('productArray');
        $soldArray = session()->get('soldArray');

        $products = Product::whereIn('id', $productArray)
            ->orderByRaw("FIELD(id, " . implode(',', $productArray) . ")")
            ->get();

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('pages.user.transaction.detailTransaction', compact('products', 'soldArray', 'carts'));
    }

    public function order(Request $request)
    {
        $idProducts = $request->products;
        $soldArray = $request->sold;
        $code = Str::random(5) . '-' . Auth::user()->username . '-' . Carbon::now();

        $carts = Cart::whereIn('product_id', $request->products)
            ->orderByRaw("FIELD(id, " . implode(',', $request->products) . ")")
            ->get();

        foreach ($carts as $cart) {
            $cart->delete();
        }



        $products = Product::whereIn('id', $request->products)
            ->orderByRaw("FIELD(id, " . implode(',', $request->products) . ")")
            ->get();

        foreach ($products as $index => $item) {
            $sold = $soldArray[$index];

            $item->stock -= $sold;
            $item->sold += $sold;

            if ($item->stock == 0) {
                $item->status = 'Habis';
            }

            $item->save();
        }

        foreach ($request->products as $product) {
            $data = [
                'code' => $code,
                'user_id' => Auth::user()->id,
                'product_id' => $product,
                'message' => $request->message,
                'address' => $request->address,
                'total_price' => $request->total_price,
                'total_product' => $request->total_sold,
                'date' => Carbon::now()->toDateString(),
                'status' => 'Belum Bayar',
            ];
            Transaction::create($data);
        }

        dd('BERHASIL');
    }






    public function startNow(Request $request, $id)
    {
        $product = Product::find($id);

        $product = $product->id;
        $sold = $request->sold;

        session()->put('product', $product);
        session()->put('sold', $sold);

        return redirect()->route('transaction.detail.now');
    }

    public function detailNow(Request $request)
    {
        $productId = session()->get('product');
        $sold = session()->get('sold');

        $product = Product::where('id', $productId)->first();

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        dd('alalalal');
        return view('pages.user.transaction.detailTransactionNow', compact('product', 'sold', 'carts'));
    }


    public function orderNow(Request $request)
    {
        $soldArray = $request->sold;
        $code = Str::random(5) . '-' . Auth::user()->username . '-' . Carbon::now();


        $products = Product::whereIn('id', $request->products)
            ->orderByRaw("FIELD(id, " . implode(',', $request->products) . ")")
            ->get();

        // foreach ($products as $index => $item) {
        //     $sold = $soldArray[$index];

        //     $item->stock -= $sold;
        //     $item->sold += $sold;

        //     if ($item->stock == 0) {
        //         $item->status = 'Habis';
        //     }

        //     $item->save();
        // }

        // foreach ($request->products as $product) {
        //     $data = [
        //         'code' => $code,
        //         'user_id' => Auth::user()->id,
        //         'product_id' => $product,
        //         'message' => $request->message,
        //         'address' => $request->address,
        //         'total_price' => $request->total_price,
        //         'total_product' => $request->total_sold,
        //         'date' => Carbon::now()->toDateString(),
        //         'status' => 'Belum Bayar',
        //     ];
        //     Transaction::create($data);
        // }

        // dd('BERHASIL');
    }
}
