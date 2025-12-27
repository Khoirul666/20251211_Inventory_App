<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{

    protected $fillable = [
        'id_barangmasuk',
        'id_invoicepembelian',
        'id_barang',
        'tgl_masuk',
        'nama_barang',
        'jumlah',
        'harga_beli',
    ];

    protected $primaryKey = 'id_barangmasuk';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function invoicePembelian()
    {
        return $this->belongsTo(InvoicePembelian::class, 'id_invoicepembelian', 'id_invoicepembelian');
    }
}
