<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function barang()
    {
        return view("barang.barang");
    }

    public function getbarang()
    {
        $barang = Barang::with('kategori')->get();
        return response()->json(['data' => $barang]);
    }

    public function getkategori()
    {
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        return response()->json($barang);
    }

    public function update($id, Request $request)
    {
        $barang = Barang::find($id);
        $barang->update([
            'id_kategori' => $request->id_kategori,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
        ]);
        return response()->json(['success' => 'barang berhasil diperbarui!']);
    }

    public function store(Request $request)
    {
        // dd($request);
        $barang = Barang::create(
            [
                'id_kategori' => $request->id_kategori,
                'nama_barang' => $request->nama_barang,
                'jumlah' => $request->jumlah,
                'harga_jual' => $request->harga_jual,
                'harga_beli' => $request->harga_beli,
            ]

        );
        return response()->json(['success' => 'barang berhasil ditambah!']);
        // return response()->json(['success' => $barang]);
    }

    public function destroy($id)
    {
        Barang::find($id)->delete();
        return response()->json(['success' => 'Barang dihapus!']);
    }
}
