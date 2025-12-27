<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'id_customer',
        'nama_customer',
        'alamat',
        'email',
        'telepon',
    ];

    protected $primaryKey = 'id_customer';

    public function invoicePenjualan()
    {
        return $this->hasMany(InvoicePembelian::class, 'id_customer', 'id_customer');
    }
}
