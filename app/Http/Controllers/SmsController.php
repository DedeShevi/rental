<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{
    public function store(Request $request, $id)
    {
        $transaksi = Transaction::findOrFail($id);
        Nexmo::message()->send([
            'to' =>  $request->phone,
            'from' => 'sender',
            'text' => 'Test Sms'

           . 'Nama Peminjam'.$transaksi->nama_peminjam
           .'Tanggal Peminjam'.$transaksi->tanggal_pinjam
           .'Tanggal Kembali'.$transaksi->tanggal_kembali
           .'Jumlah'.$transaksi->jumlah
           .'Harga'.$transaksi->idr
           .'Terima Kasih'
            
        ]);

        return redirect()->back();
    }

}
