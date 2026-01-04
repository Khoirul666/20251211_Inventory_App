<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoicePembelianController;
use App\Http\Controllers\InvoicePenjualanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanStokBarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(UserController::class)->group(function () {
    Route::get('login', 'login');
    Route::post('login', 'plogin');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'dashboard');
    Route::get('dashboard', 'dashboard');
});

Route::controller(KategoriController::class)->prefix('kategori')->name('kategori.')->group(function () {
    Route::get('/', 'kategori');
    Route::get('getkategori', 'getkategori')->name('getkategori');
    Route::post('/', 'store')->name('store');
    Route::delete('/{id}', 'destroy')->name('destroy');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
});

Route::controller(BarangController::class)->prefix('barang')->name('barang.')->group(function () {
    Route::get('/', 'barang');
    Route::get('/getbarang', 'getbarang')->name('getbarang');
    Route::get('/getkategori', 'getkategori')->name('getkategori');
    Route::post('/', 'store')->name('store');
    Route::delete('/{id}', 'destroy')->name('destroy');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
});

Route::controller(CustomerController::class)->prefix('customer')->name('customer.')->group(function () {
    Route::get('/', 'customer');
    Route::get('getcustomer', 'getcustomer')->name('getcustomer');
    Route::post('/', 'store')->name('store');
    Route::delete('/{id}', 'destroy')->name('destroy');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
});

Route::controller(SupplierController::class)->prefix('supplier')->name('supplier.')->group(function () {
    Route::get('/', 'supplier');
    Route::get('getsupplier', 'getsupplier')->name('getsupplier');
    Route::post('/', 'store')->name('store');
    Route::delete('/{id}', 'destroy')->name('destroy');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
});

Route::controller(BarangKeluarController::class)->prefix('barang_keluar')->name('barang_keluar.')->group(function () {
    Route::get('/', 'barang_keluar');
    Route::post('/', 'set_customer');
    Route::get('/pilih_barang', 'pilih_barang');
    Route::post('/pilih_barang', 'pilih_barang_store')->name('store');
    Route::get('/list_barang', 'list_barang')->name('list_barang');
    Route::get('/pilih_barang/edit/{id}', 'list_barang_edit')->name('list_barang_edit');
    Route::post('/pilih_barang/edit/{id}', 'list_barang_update')->name('list_barang_update');
    Route::delete('/pilih_barang/edit/{id}', 'list_barang_delete')->name('list_barang_delete');
    Route::get('/batal/pilih_barang', 'forget_customer');
    Route::get('/checkout', 'checkout');
    Route::get('/getcheckout', 'getcheckout');
});

Route::controller(BarangMasukController::class)->prefix('barang_masuk')->name('barang_masuk.')->group(function () {
    Route::get('/', 'barang_masuk');
    Route::post('/', 'set_supplier');
    Route::get('/pilih_barang', 'pilih_barang');
    Route::post('/pilih_barang', 'pilih_barang_store')->name('store');
    Route::get('/list_barang', 'list_barang')->name('list_barang');
    Route::get('/pilih_barang/edit/{id}', 'list_barang_edit')->name('list_barang_edit');
    Route::post('/pilih_barang/edit/{id}', 'list_barang_update')->name('list_barang_update');
    Route::delete('/pilih_barang/edit/{id}', 'list_barang_delete')->name('list_barang_delete');
    Route::get('/batal/pilih_barang', 'forget_supplier');
    Route::get('/checkout', 'checkout');
    Route::get('/getcheckout', 'getcheckout');
});

Route::controller(InvoicePenjualanController::class)->prefix('invoice_penjualan')->name('invoice_penjualan.')->group(function () {
    Route::get('/get_data', 'get_data')->name('get_data');
});

Route::controller(InvoicePembelianController::class)->prefix('invoice_pembelian')->name('invoice_pembelian.')->group(function () {
    Route::get('/get_data', 'get_data')->name('get_data');
});

Route::controller(LaporanStokBarangController::class)->prefix('laporan_stok_barang')->name('laporan_stok_barang.')->group(function () {
    Route::get('/', 'laporan_stok_barang')->name('laporan_stok_barang');
    Route::get('/get_data', 'get_data')->name('get_data');
});
