<?php

namespace App;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    Use AutoNumberTrait;
    protected $table = 'daftars';
    protected $guarded = [];

    public function getAutoNumberOptions()
    {
        return [
            'kode_barang' => [
                'format' => function() {
                    return 'BR/'.date('Ymd').'/?';
                },
                'length' => 5
            ]
            ];
    }

    public function transaksi()
    {
        return $this->hasMany(Transaction::class);
    }
}
