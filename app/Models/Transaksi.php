<?php

// Transaksi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tbl_transaksi';

    // Relasi dengan DetailTransaksi
    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');

    }


}


