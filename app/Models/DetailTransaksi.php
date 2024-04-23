<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'tbl_detail_transaksi';

    protected $guarded = [];

    public function Transaksi(){
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function Barang(){
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }

}
