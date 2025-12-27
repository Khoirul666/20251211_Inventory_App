<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePembelian extends Model
{
    protected $fillable = [
        'id_invoicepembelian',
        'total_harga',
        'tgl_cetak',
        'id_supplier',
    ];

    protected $primaryKey = 'id_invoicepembelian';

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_invoicepembelian', 'id_invoicepembelian');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }
}
