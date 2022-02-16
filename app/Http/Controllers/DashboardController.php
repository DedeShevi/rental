<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Daftar;
use App\Pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
    
        $data = [
            'daftars' => Daftar::count(),
            'transaksi' => Transaction::count(),
            'omset' => Transaction::sum('idr'),
            'late'  => Transaction::where('durasi','Terlambat')->count(),
        ];
        return view('dashboard.index', $data);
    }
}
