<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function supplier()
    {
        return view("supplier.supplier");
    }

    public function getsupplier()
    {
        $supplier = Supplier::all();
        return response()->json(['data' => $supplier]);
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    public function update($id, Request $request)
    {
        $supplier = Supplier::find($id);
        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ]);
        return response()->json(['success' => 'supplier berhasil diperbarui!']);
    }

    public function store(Request $request)
    {
        // dd($request);
        $supplier = Supplier::create(
            [
                'nama_supplier' => $request->nama_supplier,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'telepon' => $request->telepon,
            ]

        );
        return response()->json(['success' => 'supplier berhasil ditambah!']);
    }

    public function destroy($id)
    {
        Supplier::find($id)->delete();
        return response()->json(['success' => 'Supplier dihapus!']);
    }

    public function export_pdf()
    {
        $data = Supplier::get();

        $pdf = Pdf::loadView('supplier.export_pdf', compact('data'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan-Supplier.pdf');

        // return view('barang.export_pdf', compact('data'));
    }
}
