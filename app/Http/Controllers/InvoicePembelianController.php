<?php

namespace App\Http\Controllers;

use App\Models\InvoicePembelian;
use Illuminate\Http\Request;

class InvoicePembelianController extends Controller
{
    public function get_data()
    {
        $barang = InvoicePembelian::with(['supplier', 'barangmasuk'])
            ->orderBy('invoice_pembelians.created_at', 'desc') // Urutkan di tingkat database
            ->get();
        return response()->json(['data' => $barang]);
    }
}
