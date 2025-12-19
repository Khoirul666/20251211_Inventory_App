<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $fillable = [
        'id_barangkeluar',
        'tgl_keluar',
        'nama_barang',
        'harga_jual',
        'id_customer',
        'id_barang',
    ];

    protected $primaryKey = 'id_barangkeluar';
}
