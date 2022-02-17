<?php

namespace App\Http\Controllers;

use App\Daftar;
use App\Transaction;
use App\User;
use App\Pengembalian;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transactions = \App\Transaction::with('daftar')->get();
        
        return view('transaksi.index', compact('transactions'));
    }

    public function create($id)
    {
        $transactions = Daftar::findOrFail($id);

        return view('transaksi.create', compact('transactions'));
    }

    public function store(Request $request, $id)
    {
        $transaction = Transaction::create([
            'kodebarang_id' => $request->kodebarang_id,
            'namabarang_id' => $request->namabarang_id,
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah' => $request->jumlah,
            'idr'   => $request->idr,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'email' => $request->email,
            'phone' => $request->phone,
            'durasi' => $request->durasi
        ]);

         if ($transaction->save()) {
             $harga = Daftar::findOrFail($transaction->kodebarang_id);

             $jumlah = $transaction->jumlah * $harga->idr;

             $transaction->update ([
                'idr' => $jumlah
             ]);
         }

         if($transaction->save()) {
             $get = Daftar::findOrFail($transaction->kodebarang_id);

             $hitung = $get->jumlah_barang - $transaction->jumlah;

             $get->update([
                'jumlah_barang' => $hitung
             ]);
        }

        if ($transaction->save()) {
            $datetime2 = strtotime($transaction->tanggal_kembali) ;
            $datenow = strtotime(date('Y-m-d'));
            $durasi = ($datenow - $datetime2) / 86400 ;
            $durasi2 = ($durasi).'Hari';
           
            if ($datenow > $datetime2) {
                'Terlambat';
            }
            if ($datenow ==$datetime2) {
                $durasi2 = 'Kembalikan';
            }

            $transaction->update([
                'durasi' => $durasi2
            ]);
        }
        return redirect()->back();
    }
}