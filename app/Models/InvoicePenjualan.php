<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePenjualan extends Model
{
    protected $fillable = [
        'id_invoicepenjualan',
        'id_customer',
        'total_harga',
        'tgl_cetak',
    ];

    protected $primaryKey = 'id_invoicepenjualan';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }
    public function barangkeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_invoicepenjualan', 'id_invoicepenjualan');
    }
}
