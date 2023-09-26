<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PelangganController;

Route::get('Home',[HomeController::class,'index']);
Route::get('profile',[HomeController::class,'profile']);
Route::get('contact',[HomeController::class,'contact']);
Route::get('faq',[HomeController::class,'faq']);
Route::get('/dashboard',[DashboardController::class,'index']);
Route::resource('produk', ProdukController::class);
Route::resource('pemasok', PemasokController::class);
Route::resource('barang', BarangController::class);
Route::resource('pembelian', PembelianController::class);
Route::resource('pelanggan', PelangganController::class);
// Route::get('download/produk', [ProdukController::class,'download']);
Route::get('download/produk', [ProdukController::class,'exportData'])->name('export_produk');
