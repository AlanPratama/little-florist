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

        return redirect('transaksi/belum-bayar/' . $code)->with('berhasil', 'Berhasil Membuat Order');
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

        return redirect('transaksi/belum-bayar/' . $code)->with('berhasil', 'Berhasil Membuat Order');
    }









    public function cancelTransaction($code)
    {
        $transacitions = Transaction::where('code', $code)->where('status', '!=', 'Dikirim')->where('status', '!=', 'Selesai')->get();

        foreach ($transacitions as $item) {
            $item->products->stock += $item->total_product;
            $item->products->sold -= $item->total_product;
            $item->products->save();

            $item->delete();
        }


        return response()->json([
            'status' => 200
        ]);
    }





























    public function transactionIndex()
    {
        $belumBayar = Transaction::where('user_id', Auth::user()->id)
            ->orderBy('date', 'desc')->where('status', 'Belum Bayar')->get();


        $diproses = Transaction::where('user_id', Auth::user()->id)
            ->orderBy('date', 'desc')->where('status', 'Diproses')->get();

        $dikirim = Transaction::where('user_id', Auth::user()->id)
            ->orderBy('date', 'desc')->where('status', 'Dikirim')->get();

        $selesai = Transaction::where('user_id', Auth::user()->id)
            ->orderBy('date', 'desc')->where('status', 'Selesai')->get();

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        return view('pages.user.transaction.collectionOfTransaction', compact('belumBayar', 'diproses', 'dikirim', 'selesai', 'carts'));
    }







    public function belumBayarDetail($code)
    {
        $transaction = Transaction::where('code', $code)->where('status', 'Belum Bayar')->get();

        if ($transaction->count() > 0) {
            $products = Transaction::where('status', 'Belum Bayar')->get();
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            return view('pages.user.transaction.status.belumBayar', compact('carts', 'transaction', 'products'));
        } else {
            if (Auth::user()->role == 'User') {
                return redirect('/transaksi');
            } else {
                return redirect('/admin/transaksi/belum-bayar');
            }
        }
    }


    public function diprosesDetail($code)
    {
        $transaction = Transaction::where('code', $code)->where('status', 'Diproses')->get();

        if ($transaction->count() > 0) {
            $products = Transaction::where('status', 'Diproses')->get();
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            return view('pages.user.transaction.status.diproses', compact('carts', 'transaction', 'products'));
        } else {
            if (Auth::user()->role == 'User') {
                return redirect('/transaksi');
            } else {
                return redirect('/admin/transaksi/diproses');
            }
        }
    }

    public function dikirimDetail($code)
    {
        $transaction = Transaction::where('code', $code)->where('status', 'Dikirim')->get();

        if ($transaction->count() > 0) {
            $products = Transaction::where('status', 'Dikirim')->get();
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            return view('pages.user.transaction.status.dikirim', compact('carts', 'transaction', 'products'));
        } else {
            if (Auth::user()->role == 'User') {
                return redirect('/transaksi');
            } else {
                return redirect('/admin/transaksi/dikirim');
            }
        }
    }





    // THIS FUNCTION IS FOR CHANGE THE TRANSACTION STATUS FROM 'DIKIRIM' TO 'SELESAI'... DIKIRIM => SELESAI
    public function transactionDone($code)
    {
        $transacition = Transaction::where('code', $code)
            ->where('status', 'Dikirim')
            ->get();

        foreach ($transacition as $item) {
            $item->actualDateEnd = Carbon::now()->toDateString();
            $item->status = 'Selesai';
            $item->save();
        }

        if (Auth::user()->role == 'Admin') {
            return redirect('/admin/transaksi/dikirim')->with('berhasil', 'TRANSAKSI TELAH SELESAI');
        } else {
            return redirect('/produk')->with('berhasil', 'TRANSAKSI TELAH SELESAI');
        }
    }







    public function selesaiDetail($code)
    {
        $transaction = Transaction::where('code', $code)->where('status', 'Selesai')->get();

        if ($transaction->count() > 0) {
            $products = Transaction::where('status', 'Selesai')->get();
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            return view('pages.user.transaction.status.selesai', compact('carts', 'transaction', 'products'));
        } else {
            if (Auth::user()->role == 'User') {
                return redirect('/transaksi');
            } else {
                return redirect('/admin/transaksi/selesai');
            }
        }
    }
}
