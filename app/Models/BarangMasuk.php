<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{

    protected $fillable = [
        'id_barangmasuk',
        'tgl_masuk',
        'nama_barang',
        'harga_beli',
        'id_supplier',
        'id_barang',
    ];

    protected $primaryKey = 'id_barangmasuk';
}
