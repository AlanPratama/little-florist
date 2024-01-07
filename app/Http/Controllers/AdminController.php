<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('pages.admin.dashboard');
    }





    public function belumBayar()
    {
        $belumBayar = Transaction::where('status', 'Belum Bayar')
                ->orderBy('created_at', 'desc')
                ->get();

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









    public function diproses()
    {
        $diproses = Transaction::where('status', 'Diproses')
                ->orderBy('created_at', 'desc')
                ->get();

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

        return redirect('/admin/transaksi/dikirim')->with('berhasil', 'STATUS TRANSAKSI TELAH DIKIRIM');
    }








    public function dikirim()
    {
        $dikirim = Transaction::where('status', 'Dikirim')
                ->orderBy('created_at', 'desc')
                ->get();

        return view('pages.admin.transactions.dikirim', compact('dikirim'));
    }







    public function selesai()
    {
        $selesai = Transaction::where('status', 'Selesai')
                ->orderBy('created_at', 'desc')
                ->get();

        return view('pages.admin.transactions.selesai', compact('selesai'));
    }


}
