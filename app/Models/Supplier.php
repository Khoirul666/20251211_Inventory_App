<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'id_supplier',
        'nama_supplier',
        'alamat',
        'email',
        'telepon',
    ];

    protected $primaryKey = 'id_supplier';

    public function invoicePembelian()
    {
        return $this->hasMany(InvoicePembelian::class, 'id_supplier', 'id_supplier');
    }
}
