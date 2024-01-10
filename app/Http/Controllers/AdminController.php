<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        if ($request->filter) {
            if ($request->filter == 'terbaru') {
                $diproses = Transaction::where('status', 'Diproses')
                    ->orderBy('created_at', 'desc')
                    ->get();
            } elseif ($request->filter == 'terlama') {
                $diproses = Transaction::where('status', 'Diproses')
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
        } elseif ($request->kode) {
            if ($request->kode) {
                $diproses = Transaction::where('status', 'Diproses')
                    ->orderBy('created_at', 'desc')
                    ->where('code', 'like', '%' . $request->kode . '%')
                    ->get();
            }
        } else {
            $diproses = Transaction::where('status', 'Diproses')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        $totalTran = Transaction::where('status', '!=', 'Belum Bayar')->get();
        $totalPem = 0;

        foreach ($totalTran as $item) {
            $totalPem += $item->total_price;
        }

        return view('pages.admin.other.dashboard', compact('diproses', 'totalTran', 'totalPem'));
    }


    public function productIndex(Request $request)
    {
        if ($request->filter) {
            if ($request->filter == 'terlaris') {
                $products = Product::orderBy('sold', 'desc')->get();
            } elseif ($request->filter == 'stokTerbanyak') {
                $products = Product::orderBy('stock', 'desc')->get();
            }
        } elseif ($request->nama) {
            if ($request->nama) {
                $products = Product::where('name', 'like', '%' . $request->nama . '%')->get();
            }
        } else {
            $products = Product::all();
        }

        return view('pages.admin.other.products', compact('products'));
    }

    public function productEdit(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();

        $data = $request->validate([
            'name' => 'required|unique:products,name,' . $product->id,
            'stock' => 'required',
            'price_before' => 'required',
            'price_after' => 'required',
            'description' => 'required',
        ]);

        $product->update($data);

        return redirect()->route('productIndexAdmin')->with('berhasil', 'INFORMASI PRODUK BERHASIL DIPERBARUI');
    }




    public function userIndex(Request $request)
    {
        if ($request->filter) {
            if ($request->filter == 'terlaris') {
                $users = User::orderByRaw("FIELD(role, 'Admin', 'User')")->get();
            } elseif ($request->filter == 'stokTerbanyak') {
                $users = User::orderByRaw("FIELD(role, 'Admin', 'User')")->get();
            }
        } elseif ($request->nama) {
            if ($request->nama) {
                $users = User::where('name', 'like', '%' . $request->nama . '%')->get();
            }
        } else {
            $users = User::orderByRaw("FIELD(role, 'Admin', 'User')")->get();
        }

        return view('pages.admin.other.users', compact('users'));
    }


    public function userEdit(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->first();
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'role' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
            'password' => '',
        ]);

        $user->update($data);

        return redirect()->route('userIndexAdmin')->with('berhasil', 'INFORMASI USER TELAH DIPERBARUI');

    }


































    public function belumBayar(Request $request)
    {
        if ($request->filter) {
            if ($request->filter == 'terbaru') {
                $belumBayar = Transaction::where('status', 'Belum Bayar')
                    ->orderBy('created_at', 'desc')
                    ->get();
            } elseif ($request->filter == 'terlama') {
                $belumBayar = Transaction::where('status', 'Belum Bayar')
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
        } elseif ($request->kode) {
            if ($request->kode) {
                $belumBayar = Transaction::where('status', 'Belum Bayar')
                    ->orderBy('created_at', 'desc')
                    ->where('code', 'like', '%' . $request->kode . '%')
                    ->get();
            }
        } else {
            $belumBayar = Transaction::where('status', 'Belum Bayar')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('pages.admin.transactions.belumBayar', compact('belumBayar'));
    }


    // THIS FUNCTION IS FOR CHANGE THE TRANSACTION STATUS FROM 'BELUM BAYAR' TO 'DIPROSES'... BELUM BAYAR => DIPROSES
    public function transactionProcess(Request $request, $code)
    {
        $transaction = Transaction::where('code', $code)->where('status', 'Belum Bayar')->get();
        foreach ($transaction as $item) {
            $item->date_end = $request->date_end;
            $item->status = 'Diproses';
            $item->save();
        }

        return redirect('/admin/transaksi/belum-bayar')->with('berhasil', 'TRANSAKSI TELAH AKTIF');
    }









    public function diproses(Request $request)
    {

        if ($request->filter) {
            if ($request->filter == 'terbaru') {
                $diproses = Transaction::where('status', 'Diproses')
                    ->orderBy('created_at', 'desc')
                    ->get();
            } elseif ($request->filter == 'terlama') {
                $diproses = Transaction::where('status', 'Diproses')
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
        } elseif ($request->kode) {
            if ($request->kode) {
                $diproses = Transaction::where('status', 'Diproses')
                    ->orderBy('created_at', 'desc')
                    ->where('code', 'like', '%' . $request->kode . '%')
                    ->get();
            }
        } else {
            $diproses = Transaction::where('status', 'Diproses')
                ->orderBy('created_at', 'desc')
                ->get();
        }



        return view('pages.admin.transactions.diproses', compact('diproses'));
    }

    // THIS FUNCTION IS FOR CHANGE THE TRANSACTION STATUS FROM 'DIPROSES' TO 'DIKIRIM'... DIPROSES => DIKIRIM
    public function transactionSend($code)
    {
        $transaction = Transaction::where('code', $code)->where('status', 'Diproses')->get();
        foreach ($transaction as $item) {
            $item->status = 'Dikirim';
            $item->save();
        }

        return redirect('/admin/transaksi/diproses')->with('berhasil', 'STATUS TRANSAKSI TELAH DIKIRIM');
    }








    public function dikirim(Request $request)
    {

        if ($request->filter) {
            if ($request->filter == 'terbaru') {
                $dikirim = Transaction::where('status', 'Dikirim')
                    ->orderBy('created_at', 'desc')
                    ->get();
            } elseif ($request->filter == 'terlama') {
                $dikirim = Transaction::where('status', 'Dikirim')
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
        } elseif ($request->kode) {
            if ($request->kode) {
                $dikirim = Transaction::where('status', 'Dikirim')
                    ->orderBy('created_at', 'desc')
                    ->where('code', 'like', '%' . $request->kode . '%')
                    ->get();
            }
        } else {
            $dikirim = Transaction::where('status', 'Dikirim')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('pages.admin.transactions.dikirim', compact('dikirim'));
    }





    // FUNCTION FOR TRANSACTION DONE WRITTED IN TRANSACTION CONTROLLER. 'DIKIRIM' => 'SELESAI'







    public function selesai(Request $request)
    {

        if ($request->filter) {
            if ($request->filter == 'terbaru') {
                $selesai = Transaction::where('status', 'Selesai')
                    ->orderBy('created_at', 'desc')
                    ->get();
            } elseif ($request->filter == 'terlama') {
                $selesai = Transaction::where('status', 'Selesai')
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
        } elseif ($request->kode) {
            if ($request->kode) {
                $selesai = Transaction::where('status', 'Selesai')
                    ->orderBy('created_at', 'desc')
                    ->where('code', 'like', '%' . $request->kode . '%')
                    ->get();
            }
        } else {
            $selesai = Transaction::where('status', 'Selesai')
                ->orderBy('created_at', 'desc')
                ->get();
        }



        return view('pages.admin.transactions.selesai', compact('selesai'));
    }
}
