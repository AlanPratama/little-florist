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
        // dd($request->all());

        $idProducts = $request->products;
        $soldArray = $request->sold;

        // PRODUCT FUNCTION
        // for ($i=1; $i <= $request->total_products; $i++) {
        //     $data = [
        //         'code' => Str::random(5) . '-' . Auth::user()->username . '-' . Carbon::now(),
        //         'user_id' => Auth::user()->id,
        //         'product_id' => $idProducts[$loop->index],
        //         'message' => $request->message,
        //         'address' => $request->address,
        //         'total_product' => $request->totalProducts,
        //         'date' => Carbon::now()->toDateString(),
        //         'status' => 'Belum Bayar',
        //     ];
        // }

        foreach ($request->products as $lala) {
            $data = [
                'code' => Str::random(5) . '-' . Auth::user()->username . '-' . Carbon::now(),
                'user_id' => Auth::user()->id,
                'product_id' => $lala,
                'message' => $request->message,
                'address' => $request->address,
                'total_price' => $request->total_price,
                'total_product' => $request->total_sold,
                'date' => Carbon::now()->toDateString(),
                'status' => 'Belum Bayar',
            ];
            Transaction::create($data);
        }

    }
}
