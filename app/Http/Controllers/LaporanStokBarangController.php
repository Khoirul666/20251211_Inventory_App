<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LaporanStokBarangController extends Controller
{
    public function laporan_stok_barang()
    {
        return view('laporan_stok_barang.laporan_stok_barang');
    }

    public function get_data(Request $request)
    {
        $tgl_awal = $request->tgl_awal ?: now()->toDateString();
        $tgl_akhir = $request->tgl_akhir ?: now()->toDateString();
        $masuk = DB::table('barang_masuks')
            ->select(
                'id_barangmasuk as id',
                'tgl_masuk as tgl',
                'nama_barang',
                'jumlah',
                'harga_beli as harga',
                DB::raw('jumlah*harga_beli as total'),
                'created_at',
                DB::raw("'masuk' as tipe")
            )->whereBetween('tgl_masuk', [$tgl_awal, $tgl_akhir]);

        $history = DB::table('barang_keluars')
            ->select(
                'id_barangkeluar as id',
                'tgl_keluar as tgl',
                'nama_barang',
                'jumlah',
                'harga_jual as harga',
                DB::raw('jumlah*harga_jual as total'),
                'created_at',
                DB::raw("'keluar' as tipe")
            )
            ->whereBetween('tgl_keluar', [$tgl_awal, $tgl_akhir])
            ->union($masuk)
            ->orderBy('created_at', 'desc')
            ->get();

        return DataTables::of($history)->make(true);
    }
}
