<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'kegiatan'], function(){
    Route::get('/tampilkan', 'KegiatanController@show')->name('kegiatan.tampilkan');
});
Route::get('/dashboard', 'HomeController@index')->name('dashboard.index');
Route::get('/daftar', 'DaftarBarangCController@index')->name('daftar.index');
Route::get('/daftar', 'DaftarBarangCController@index')->name('daftar.barang');
Route::get('/transaksi', 'TransaksiController@index')->name('transaksi.index');
Route::get('/transaksi', 'TransaksiController@index')->name('Transaksi.barang');

Route::group(['prefix' => 'barang'], function() {
    Route::get('/daftar', 'DaftarBarangController@index')->name('daftar.barang');
    Route::get('create','DaftarBarangController@create')->name('daftar.create');
    Route::get('edit/{daftars}', 'DaftarBarangController@edit')->name('daftar.edit');
    Route::post('store','DaftarBarangController@store')->name('daftar.store');
    Route::patch('update/{daftars}','DaftarBarangController@update')->name('daftar.update');
    Route::delete('delete/{daftars}', 'DaftarBarangController@destroy')->name('daftar.destroy');
});

Route::group(['prefix' => 'edit-data'], function() {
    Route::get('/daftar', 'DaftarBarangController@edit')->name('edit-data.barang');
});

Route::group(['prefix' => 'tambah-data'], function() {
    Route::post('/barang', 'DaftarBarangController@create')->name('tambah-data.barang');
    Route::post('/transaksi/{transactions}', 'TransaksiController@create')->name('tambah-data.transaksi');
});

Route::group(['prefix' => 'transaksi'], function() {
    Route::get('/siswa', 'TransaksiController@index')->name('daftar.transaksi');
    Route::get('create/{id}','TransaksiController@create')->name('transaksi.create'); 
    Route::post('store/{transactions}','TransaksiController@store')->name('transaksi.store');

});

Route::group(['prefix' => 'pengembalian'], function() {
    Route::get('/siswa', 'PengembalianController@index')->name('pengembalian.transaksi');
    route::get('create/{id}', 'PengembalianController@create')->name('pengembalian.create');
    route::post('store/{transaksi}','PengembalianController@store')->name('pengembalian.store');
});

Route::group(['prefix' =>'destroy'], function(){
    route::delete('daftar','DaftarBarangController@destroy')->name('destroy.daftar.barang');
});

Route::group(['prefix' => 'edit-data'], function() {
    Route::get('daftar', 'DaftarBarangController@edit')->name('edit-daftar.barang');
});

Route::group(['prefix' => 'sms'], function() {
    Route::get('create', 'SmsController@create')->name('sms.create');
    Route::post('sms/{sms}', 'SmsController@store')->name('sms.send');
});

Route::group(['prefix' => 'laporan'], function(){
    Route::get('laporan/index', 'CetakController@index')->name('laporan.daftar');
    Route::get('laporan/edit', 'CetakController@edit')->name('laporan.transaksi');
    Route::get('laporan/create', 'CetakController@create')->name('laporan.pengembalian');
    Route::get('laporan/dashboard', 'CetakController@dashboard')->name('laporan.dashboard');
});

