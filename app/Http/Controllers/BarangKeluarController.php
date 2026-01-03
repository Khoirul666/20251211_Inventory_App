<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Customer;
use App\Models\InvoicePenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BarangKeluarController extends Controller
{
    public function barang_keluar()
    {
        if (!Session::has('selected_customer')) {
            return view('barang_keluar.barang_keluar');
        }
        $customer = Customer::find(Session::get('selected_customer'));
        return view('barang_keluar.pilih_barang', compact('customer'));
    }

    public function set_customer(Request $request)
    {
        Session::put('selected_customer', $request->id_customer);
        return redirect('barang_keluar/pilih_barang');
    }

    public function pilih_barang()
    {
        if (!Session::has('selected_customer')) {
            return view('barang_keluar.barang_keluar');
        }
        $customer = Customer::find(Session::get('selected_customer'));
        return view('barang_keluar.pilih_barang', compact('customer'));
    }

    public function list_barang()
    {
        $cart = Session::get('cart_barang', []);
        // return response()->json([
        //     'data' => array_values($cart)
        // ]);

        if (empty($cart)) {
            return response()->json(['data' => []]);
        }
        $ids = array_column($cart, 'id_barang');
        $dataBarangDB = Barang::with('kategori')
            ->whereIn('id_barang', $ids)
            ->get()
            ->keyBy('id_barang');

        $result = [];
        foreach ($cart as $item) {
            $barangDB = $dataBarangDB->get($item['id_barang']);

            $result[] = [
                'id_barang' => $item['id_barang'],
                'nama_barang' => $item['nama_barang'],
                'nama_kategori' => $barangDB && $barangDB->kategori ? $barangDB->kategori->nama_kategori : 'Tanpa Kategori',
                'jumlah' => $item['jumlah'],
                'harga_jual' => $item['harga_jual'],
                'jumlah_beli' => $item['jumlah_beli'],
                'total' => $item['total'],
            ];
        }

        return response()->json(['data' => $result]);
    }

    public function list_barang_edit($id)
    {
        $cart = Session::get('cart_barang');
        $data = $cart[$id] ?? null;
        if ($data) {
            return $data;
        }
    }

    public function list_barang_update($id, Request $request)
    {
        $cart = Session::get('cart_barang');
        if (isset($cart[$id])) {

            $cart[$id]['jumlah_beli'] = $request->jumlah;
            $cart[$id]['total'] = $cart[$id]['harga_jual'] * $request->jumlah;

            Session::put('cart_barang', $cart);
            return response()->json(['success' => 'Barang berhasil diubah']);
        }
        return response()->json(['message' => 'Barang tidak ditemukan'], 404);
    }

    public function list_barang_delete($id)
    {
        $cart = Session::get('cart_barang');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart_barang', $cart);
            return response()->json(['success' => 'Barang berhasil dihapus dari keranjang']);
        }

        return response()->json(['success' => 'Barang tidak ditemukan'], 404);
    }

    public function pilih_barang_store(Request $request)
    {
        $barang = Barang::findOrFail($request->id_barang);
        $cart = Session::get('cart_barang', []);
        $cart[$barang->id_barang] = [
            'id_barang' => $barang->id_barang,
            'id_kategori' => $barang->id_kategori,
            'nama_barang' => $barang->nama_barang,
            'jumlah' => $barang->jumlah,
            'harga_jual' => $barang->harga_jual,
            'jumlah_beli' => $request->jumlah,
            'total' => $request->jumlah * $barang->harga_jual,
        ];
        Session::put('cart_barang', $cart);

        return response()->json(['success' => 'barang berhasil ditambah!']);
    }

    public function forget_customer()
    {
        Session::forget('selected_customer');
        Session::forget('cart_barang');
        return redirect('barang_keluar');
    }

    public function checkout()
    {
        $data = [
            'data_barang' => Session::get('cart_barang'),
            'data_user' => Session::get('selected_customer')
        ];
        return $data;
    }

    public function getcheckout()
    {
        // return "aaa";
        $cart = Session::get('cart_barang');
        $id_cs = Session::get('selected_customer');
        // dd($cart, $id_cs);
        if (empty($cart) || !$id_cs) {
            return response()->json(['message' => 'Keranjang atau Customer kosong!'], 400);
        }
        try {
            DB::transaction(function () use ($cart, $id_cs) {
                $inv_penjualan = InvoicePenjualan::create([
                    'id_customer' => $id_cs,
                    'total_harga' => 0,
                    'tgl_cetak' => now(),
                ]);
                // var_dump($cart, $id_cs, $inv_penjualan);
                $count_total = 0;
                foreach ($cart as $cart_temp) {
                    // dd($cart_temp, $cart_temp['jumlah_beli']);
                    $data_barang = Barang::find($cart_temp['id_barang']);
                    BarangKeluar::create([
                        'id_barang' => $data_barang->id_barang,
                        'id_invoicepenjualan' => $inv_penjualan->id_invoicepenjualan,
                        'tgl_keluar' => $inv_penjualan->tgl_cetak,
                        'nama_barang' => $data_barang->nama_barang,
                        'jumlah' => $cart_temp['jumlah_beli'],
                        'harga_jual' => $cart_temp['harga_jual'],
                    ]);
                    $data_barang->update([
                        'jumlah' => $data_barang->jumlah - $cart_temp['jumlah_beli'],
                    ]);
                    $count_total += $cart_temp['jumlah_beli'] * $cart_temp['harga_jual'];
                }
                $inv_penjualan->update([
                    'total_harga' => $count_total,
                ]);

                Session::forget('cart_barang');
                Session::forget('selected_customer');
                // dd($cart, $id_cs, $inv_penjualan, $inv_penjualan->tgl_cetak);
            });
            return response()->json(['message' => 'Transaksi Berhasil Simpan!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }
}
