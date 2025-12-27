<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $fillable = [
        'id_barangkeluar',
        'id_barang',
        'id_invoicepenjualan',
        'tgl_keluar',
        'nama_barang',
        'jumlah',
        'harga_jual',
    ];

    protected $primaryKey = 'id_barangkeluar';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function invoicePenjualan()
    {
        return $this->belongsTo(InvoicePenjualan::class, 'id_invoicepenjualan', 'id_invoicepenjualan');
    }
}
