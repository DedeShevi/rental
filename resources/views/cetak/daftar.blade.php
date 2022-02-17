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
    <title>Daftar</title>
</head>
<body>
    <div class="">
        <div class="row">
            <div class="">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stock Barang</th>
                                <th>Harga Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftar as $item)
                            <tr>      
                                <td>{{$item->kode_barang}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->jumlah_barang}}</td>
                                <td>{{$item->idr}}</td>                 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                </div>
            </div>
        </div>
    </div>
</body>
</html>