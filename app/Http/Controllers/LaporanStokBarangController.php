<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
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
        $tipe = $request->tipe;
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

        $keluar = DB::table('barang_keluars')
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
            ->whereBetween('tgl_keluar', [$tgl_awal, $tgl_akhir]);

        if ($tipe == 'masuk') {
            $history = $masuk;
        } elseif ($tipe == 'keluar') {
            $history = $keluar;
        } else {
            $history = $keluar->union($masuk);
        }

        $history->orderBy('created_at', 'desc')
            ->get();

        return DataTables::of($history)->make(true);
        // return $request->tipe;
    }

    public function export_pdf(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $tipe = $request->tipe;

        // Ambil data dengan logika UNION yang sama
        $masuk = DB::table('barang_masuks')
            ->select('tgl_masuk as tgl', 'nama_barang', 'jumlah', 'harga_beli as harga', DB::raw('jumlah * harga_beli as total'), DB::raw("'masuk' as tipe"))
            ->whereBetween('tgl_masuk', [$tgl_awal, $tgl_akhir]);

        $keluar = DB::table('barang_keluars')
            ->select('tgl_keluar as tgl', 'nama_barang', 'jumlah', 'harga_jual as harga', DB::raw('jumlah * harga_jual as total'), DB::raw("'keluar' as tipe"))
            ->whereBetween('tgl_keluar', [$tgl_awal, $tgl_akhir]);

        if ($tipe == 'masuk') {
            $data = $masuk;
            $jenis = "MASUK";
        } elseif ($tipe == 'keluar') {
            $data = $keluar;
            $jenis = "KELUAR";
        } else {
            $data = $keluar->union($masuk);
            $jenis = "";
        }
        // dd($data);
        $data = $data->orderBy('tgl', 'asc')->get();
        // Hitung Ringkasan
        $total_jumlah = $data->sum('jumlah');
        $grand_total = $data->sum('total');

        $pdf = Pdf::loadView('laporan_stok_barang.export_pdf', compact('data', 'tgl_awal', 'tgl_akhir', 'total_jumlah', 'grand_total','jenis'));

        // Set kertas ke A4 (opsional)
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan-Stok.pdf');
        // dd($data);
        // return view('laporan_stok_barang.export_pdf', compact('data', 'tgl_awal', 'tgl_akhir', 'total_jumlah', 'grand_total','jenis'));
    }
}
