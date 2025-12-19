<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'jumlah',
        'harga_beli',
        'harga_jual',
        'id_kategori',
    ];

    protected $primaryKey = 'id_barang';
}
