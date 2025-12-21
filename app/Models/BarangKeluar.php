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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function invoicePenjualan()
    {
        return $this->hasOne(InvoicePenjualan::class, 'id_barangkeluar', 'id_barangkeluar');
    }
}
