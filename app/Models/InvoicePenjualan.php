<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePenjualan extends Model
{
    protected $fillable = [
        'id_invoicepenjualan',
        'total_harga',
        'tgl_cetak',
        'id_barangkeluar',
    ];

    protected $primaryKey = 'id_invoicepenjualan';

    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class, 'id_barangkeluar', 'id_barangkeluar');
    }
}
