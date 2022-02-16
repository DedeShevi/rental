@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{route('daftar.create')}}" class="btn btn-success">Tambah barang</a>      
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="mt-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Stock Barang</th>
                                                <th>Harga Satuan</th>
                                                <th>Option</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($daftars as $daftar)
                                            <tr>
                                                <td>
                                                <a href="{{route('transaksi.create', $daftar->id)}}"
                                               class="btn btn-outline-info btn-sm">                              
                                                {{$daftar->kode_barang}}</a></td>
                                                <td>{{$daftar->nama_barang}}</td>
                                                <td>{{$daftar->jumlah_barang}}</td>
                                                <td>{{$daftar->idr}}</td>
                                                <td>
                                                <form action="{{route('daftar.destroy', $daftar->id)}}" method="post">
                                                <a href="{{route('daftar.edit', $daftar->id)}}" class="btn btn-secondary btn-sm">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class=" btn btn-danger btn-sm">Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection