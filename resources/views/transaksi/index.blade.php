@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.Faktur</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Penyewa</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Lama Penyewaan</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $trx)
                                <tr>
                                    <td>{{$trx->no_faktur}}</td>
                                    <td>{{$trx->daftar->kode_barang}}</td>
                                    <td>{{$trx->daftar->nama_barang}}</td>
                                    <td>{{$trx->nama_peminjam}}</td>
                                    <td>{{$trx->tanggal_pinjam}}</td>
                                    <td>{{$trx->tanggal_kembali}}</td>
                                    
                                    <td>
                                        <?php
                                        $datetime2 = strtotime($trx->tanggal_kembali) ;
                                        $datenow = strtotime($trx->tanggal_pinjam);
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
                                    <td>
                                        <form action="{{route('sms.send', $trx->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="phone" class="form-control" value="{{$trx->phone}}">
                                            <button type="submit" class="btn btn-outline-primary btn-sm mb-2" style="width: 130px; height:25px">Kirim notifikasi</button>
                                        </form>
                                        <form action="{{route('pengembalian.store', $trx->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="kodebarang_id" class="form-control" value="{{$trx->daftar->id}}">
                                            <input type="hidden" name="nofaktur_id" class="form-control" value="{{$trx->id}}">
                                            <input type="hidden" name="namapeminjam_id" class="form-control" value="{{$trx->id}}">
                                            <input type="hidden" name="tglpinjam_id" id="" class="form-control" value="{{$trx->id}}">
                                            <input type="hidden" name="tglkembali_id" id="" class="form-control" value="{{$trx->id}}">

                                            <button type="submit" class="btn btn-outline-primary btn-sm" style="width: 130px; height:25px;">Buat pengembalian</button>
                                        </form>
                                    </td>
                                    
                                </tr>
                                @empty
                                <tr>
                                    <td>
                                        <td colspan="8" class="text-center text-danger">Maaf data peminjaman belum tersedia</td>
                                    </td>
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