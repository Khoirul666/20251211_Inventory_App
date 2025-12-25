<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customer()
    {
        return view("customer.customer");
    }

    public function getcustomer()
    {
        $customer = Customer::all();
        return response()->json(['data' => $customer]);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    public function update($id, Request $request)
    {
        $customer = Customer::find($id);
        $customer->update([
            'nama_customer' => $request->nama_customer,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ]);
        return response()->json(['success' => 'Customer berhasil diperbarui!']);
    }

    public function store(Request $request)
    {
        // dd($request);
        $customer = Customer::create(
            [
                'nama_customer' => $request->nama_customer,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'telepon' => $request->telepon,
            ]

        );
        return response()->json(['success' => 'Customer berhasil ditambah!']);
    }

    public function destroy($id)
    {
        Customer::find($id)->delete();
        return response()->json(['success' => 'Customer dihapus!']);
    }
}
