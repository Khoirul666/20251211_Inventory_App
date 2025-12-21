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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function invoicePembelian()
    {
        return $this->hasOne(InvoicePembelian::class, 'id_barangmasuk', 'id_barangmasuk');
    }
}
