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

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'id_supplier', 'id_supplier');
    }
}
