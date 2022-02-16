<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Daftar;
use App\Pengembalian;
use Nexmo\Laravel\Facade\Nexmo;

class PengembalianController extends Controller
{
    public function index()
    {
        $returns = Pengembalian::with('daftar','transaksi')->get();
        
        return view('pengembalian.index', compact('returns'));
    }

    public function create($id)
    {
       $transaksi = Transaction::findOrFail($id);
      
        return view('pengembalian.create', compact('transaksi'));
    }

    public function store(Request $request, $id)
    {
        $return = Pengembalian::create([
            'kodebarang_id' => $request->kodebarang_id,
            'namapeminjam_id' => $request->namapeminjam_id,
            'tglpinjam_id' => $request->tglpinjam_id,
            'tglkembali_id' => $request->tglkembali_id,
            'nofaktur_id' => $request->nofaktur_id,
        ]);
        
        if ($return->save()) {
            $transaksi = Transaction::findOrFail($id);

            Nexmo::message()->send([
                'to' =>   $transaksi->phone,
                'from' => 'RENTAL',
                'text'  => 'Hello, we from MariRental would like to inform you that you have returned the item'

               . 'Borrower Name:'.$transaksi->nama_peminjam
               . 'Borrower Date:'. $transaksi->tanggal_pinjam
               . 'Return Date:'.$transaksi->tanggal_kembali
               . 'Amount:'.$transaksi->jumlah
               . 'Price:'. $transaksi->idr
               . 'Thanks You!'
                ]);
                
                $get = Daftar::findOrFail($return->kodebarang_id);

                $hitung = $get->jumlah_barang + $transaksi->jumlah;

                $get->update([
                    'jumlah_barang' =>$hitung
                ]);
        }
        return redirect()->back();
    }
}