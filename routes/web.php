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
});

Route::controller(BarangController::class)->group(function () {
    Route::get('barang', 'barang');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('customer', 'customer');
});

Route::controller(SupplierController::class)->group(function () {
    Route::get('supplier', 'supplier');
});

Route::controller(BarangKeluarController::class)->group(function () {
    Route::get('barang_keluar', 'barang_keluar');
});

Route::controller(BarangMasukController::class)->group(function () {
    Route::get('barang_masuk', 'barang_masuk');
});
