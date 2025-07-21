<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini kamu bisa mendefinisikan semua route untuk API aplikasi kamu.
| Route ini otomatis memiliki prefix "/api" dan menggunakan grup middleware "api".
|
*/

// Endpoint untuk memastikan API berjalan
Route::get('/check', function () {
    return response()->json(['message' => 'API is working']);
});

// Endpoint publik tanpa API Key (jika dibutuhkan bisa dipindah ke dalam grup middleware)
Route::get('/products', [ProductApiController::class, 'index'])->middleware('apikey');

// Grup endpoint lengkap produk dengan middleware apikey
Route::prefix('products')->middleware('apikey')->group(function () {
    Route::post('/decrypt', [ProductApiController::class, 'decryptResponse']);
    Route::get('/{id}', [ProductApiController::class, 'show']);
    Route::post('/', [ProductApiController::class, 'store']);
    Route::put('/{id}', [ProductApiController::class, 'update']);
    Route::delete('/{id}', [ProductApiController::class, 'destroy']);
});