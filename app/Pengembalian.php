<?php

namespace App;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use AutoNumberTrait;

    protected $table = 'returns';
    protected $guarded = [];

    public function getAutoNumberOptions()
    {
        return [
            'no_pengembalian' => [
                'format' => function(){
                    return 'PG'.date('Ymd').'/?';
                }, 'length' => 5           
            ]
            ];
        
    }
    
    public function daftar()
    {
        return $this->belongsTo(Daftar::class, 'kodebarang_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaction::class, 'nofaktur_id');
    }
}