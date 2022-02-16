<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Daftar;
use App\Pengembalian;
use PDF;

class CetakController extends Controller
{
    public function index()
    {
        $daftar = Daftar::all();

        $pdf = PDF::loadView('cetak.daftar', compact('daftar'))->setPaper('a4','landscape');

        return $pdf->stream('laporan.data.daftarbarang.pdf');
    }

    public function edit()
    {
        $transactions = Transaction::all();

        $pdf = PDF::loadView('cetak.transaksi', compact('transactions'))->setPaper('a4','landscape');

        return $pdf->stream('laporan.data.pengembalian.pdf');
    }

    public function create()
    {
        $return = Pengembalian::all();

        $pdf = PDF::loadView('cetak.pengembalian', compact('return'))->setPaper('a4','landscape');

        return $pdf->stream('laporan.data.pengembalian.pdf');
    }
    
    public function dashboard()
    {
        $pdf = PDF::loadView('cetak.dashboard')->setPaper('a4','landscape');

        return $pdf->stream('laporan.data.pengembalian.pdf');
    }
}
