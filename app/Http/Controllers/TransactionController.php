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
        $soldArray = $request->sold;
        $code = Str::random(6) . '-' . Auth::user()->username . '-' . Carbon::now()->toDateString();

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

        foreach ($products as $index => $product) {
            $totalPrice = $product->price_after * $soldArray[$index];
            $data = [
                'code' => $code,
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'message' => $request->message,
                'address' => $request->address,
                'total_price' => $totalPrice,
                'total_product' => $soldArray[$index],
                'date' => Carbon::now()->toDateString(),
                'status' => 'Belum Bayar',
            ];
            Transaction::create($data);
        }

        return redirect('transaksi/belum-bayar/'.$code)->with('berhasil', 'Berhasil Membuat Order');
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
        return view('pages.user.transaction.detailTransactionNow', compact('product', 'sold', 'carts'));
    }


    public function orderNow(Request $request)
    {
        $code = Str::random(6) . '-' . Auth::user()->username . '-' . Carbon::now()->toDateString();
        $sold = $request->sold;


        $product = Product::where('slug', $request->product)->first();
        $product->stock -= $sold;
        $product->sold += $sold;

        if ($product->stock == 0) {
            $product->status = 'Habis';
        }
        $product->save();


        $totalPrice = $product->price_after * $sold;
        $data = [
            'code' => $code,
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'message' => $request->message,
            'address' => $request->address,
            'total_price' => $totalPrice,
            'total_product' => $sold,
            'date' => Carbon::now()->toDateString(),
            'status' => 'Belum Bayar',
        ];
        Transaction::create($data);

        return redirect('transaksi/belum-bayar/'.$code)->with('berhasil', 'Berhasil Membuat Order');
    }


















    public function transactionIndex()
    {

    }


    public function belumBayarDetail($code)
    {
        $transaction = Transaction::where('code', $code)->where('status', 'Belum Bayar')->get();
        $products = Transaction::where('status', 'Belum Bayar')->get();
        if (Auth::user()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('pages.user.transaction.belumBayar.belumBayar', compact('carts', 'transaction', 'products'));
        } else {
            return view('pages.user.transaction.belumBayar.belumBayar');
        }
    }
}
