<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Pengembalian</title>
</head>
<body>
    <div class="row">
        <div class="col-md-12">
        <h3 class="ml-3">Mari Rental</h3>
        <p class="ml-3">Laporan Data Pengembalian</p>
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
                @forelse ($return as $rts)
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
                        <?php $durasi1 = abs($durasi) ?> {{ $durasi1 }} Hari
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
</body>
</html>