<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePembelian extends Model
{
    protected $fillable = [
        'id_invoicepembelian',
        'total_harga',
        'tgl_cetak',
        'id_barangmasuk',
    ];

    protected $primaryKey = 'id_invoicepembelian';

    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'id_barangmasuk', 'id_barangmasuk');
    }
}
