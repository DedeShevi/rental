<?php

namespace App\Http\Controllers;

use App\Daftar;
use App\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'daftars' => Daftar::count(),
            'transaksi' => Transaction::count(),
            'omset' => Transaction::sum('idr'),
            'late'  => Transaction::where('durasi','Terlambat')->count(),
        ];

        return view('home', $data);
    }
}
