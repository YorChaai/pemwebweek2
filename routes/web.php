<?php

use App\Http\Controllers\ContohController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

//Route::get('/Contoh', function () {
//return view('Contoh');
//});

Route::get('/contoh', [ContohController::class, 'TampilContoh']);
Route::get('/produk', [ProdukController::class, 'ViewProduk']);
Route::get('/produk/add', [ProdukController::class, 'ViewAddProduk']);
Route::post('/produk/add', [ProdukController::class, 'CreateProduk']);
Route::delete('/produk/delete/{kode_produk}', [ProdukController::class, 'DeleteProduk']);

Route::get('/produk/edit/{kode_produk}', [ProdukController::class, 'ViewEditProduk']);
Route::put('/produk/edit/{kode_produk}', [ProdukController::class, 'UpdateProduk']);

// Route untuk halaman produk
//Route::get('/produk', function () {
//    return view('produk'); // Pastikan Anda memiliki file produk.blade.php di resources/views
//});
