<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function kategori()
    {
        return view("kategori.kategori");
    }

    public function getkategori()
    {
        $kategori = Kategori::all();
        return response()->json(['data' => $kategori]);
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return response()->json($kategori);
    }

    public function update($id, Request $request)
    {
        $kategori = Kategori::find($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return response()->json(['success' => 'Kategori berhasil diperbarui!']);
    }

    public function store(Request $request)
    {
        // dd($request);
        $kategori = Kategori::create(
            [
                'nama_kategori' => $request->nama_kategori,
            ]

        );
        return response()->json(['success' => 'Kategori berhasil ditambah!']);
    }

    public function destroy($id)
    {
        kategori::find($id)->delete();
        return response()->json(['success' => 'Produk dihapus!']);
    }
}
