<?php

namespace App\Http\Controllers;

use App\Models\InvoicePenjualan;
use Illuminate\Http\Request;

class InvoicePenjualanController extends Controller
{
    public function get_data()
    {
        $barang = InvoicePenjualan::with(['customer', 'barangkeluar'])
            ->orderBy('invoice_penjualans.created_at', 'desc') // Urutkan di tingkat database
            ->get();
        return response()->json(['data' => $barang]);
    }
}
