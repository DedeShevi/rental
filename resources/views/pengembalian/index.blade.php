@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card border">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.Pengembalian</th>
                                    <th>No.Faktur</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Penyewa</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Lama Penyewaan</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($returns as $rts)
                                <tr>
                                    <td>{{$rts->no_pengembalian}}</td>
                                    <td>{{$rts->transaksi->no_faktur}}</td>
                                    <td>{{$rts->daftar->kode_barang}}</td>
                                    <td>{{$rts->transaksi->nama_peminjam}}</td>
                                    <td>{{$rts->transaksi->tanggal_pinjam}}</td>
                                    <td>{{$rts->transaksi->tanggal_kembali}}</td>
                                    <td>
                                        <?php
                                        $datetime2 = strtotime($rts->transaksi->tanggal_kembali) ;
                                        $datenow = strtotime($rts->transaksi->tanggal_pinjam);
                                        $durasi = ($datenow - $datetime2) / 86400 ;
                                        $durasi2 = ($durasi);
                                    ?>
                                    @if ($datenow == $datetime2  ) 
                                            <span class="text-danger">Waktunya mengembalikan</span> 
                                        @elseif($datenow > $datetime2)
                                            Sudah lewat {{$durasi}} Hari
                                        @else
                                        <?php $durasi1 = abs($durasi) ?> {{ $durasi1 }} Hari
                                    @endif
                                    </td>
                                </tr>
                                @empty 
                                <tr>
                                    <td >
                                    <td colspan="8  " class="text-center text-danger">Maaf data pengembalian tidak tersedia</td></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection