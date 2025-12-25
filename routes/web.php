<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
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

Route::controller(KategoriController::class)->group(function () {
    Route::get('kategori', 'kategori');
    Route::get('getkategori', 'getkategori')->name('getkategori');
    Route::post('kategori', 'store')->name('kategori.store');
    Route::delete('kategori/{id}', 'destroy')->name('kategori.destroy');
    Route::get('kategori/edit/{id}', 'edit')->name('kategori.edit');
    Route::post('kategori/update/{id}', 'update')->name('kategori.update');
});

Route::controller(BarangController::class)->group(function () {
    Route::get('barang', 'barang');
    Route::get('getbarang', 'getbarang')->name('getbarang');
    Route::get('barang/getkategori', 'getkategori')->name('barang.getkategori');
    Route::post('barang', 'store')->name('barang.store');
    Route::delete('barang/{id}', 'destroy')->name('barang.destroy');
    Route::get('barang/edit/{id}', 'edit')->name('barang.edit');
    Route::post('barang/update/{id}', 'update')->name('barang.update');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('customer', 'customer');
    Route::get('getcustomer', 'getcustomer')->name('getcustomer');
    Route::post('customer', 'store')->name('customer.store');
    Route::delete('customer/{id}', 'destroy')->name('customer.destroy');
    Route::get('customer/edit/{id}', 'edit')->name('customer.edit');
    Route::post('customer/update/{id}', 'update')->name('customer.update');
});

Route::controller(SupplierController::class)->group(function () {
    Route::get('supplier', 'supplier');
    Route::get('getsupplier', 'getsupplier')->name('getsupplier');
    Route::post('supplier', 'store')->name('supplier.store');
    Route::delete('supplier/{id}', 'destroy')->name('supplier.destroy');
    Route::get('supplier/edit/{id}', 'edit')->name('supplier.edit');
    Route::post('supplier/update/{id}', 'update')->name('supplier.update');
});

Route::controller(BarangKeluarController::class)->group(function () {
    Route::get('barang_keluar', 'barang_keluar');
});

Route::controller(BarangMasukController::class)->group(function () {
    Route::get('barang_masuk', 'barang_masuk');
});
