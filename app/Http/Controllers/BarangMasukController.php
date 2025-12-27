<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function barang_masuk()
    {
        return view('barang_masuk.barang_masuk');
    }
}
