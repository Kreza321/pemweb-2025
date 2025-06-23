<?php

use App\Http\Controllers\TestController;

use Illuminate\Support\Facades\Route;


Route::get('/tests', [TestController::class, 'index'])->name('tests');
Route::get('/tests/{test}', [TestController::class, 'show'])->name('tests.show');
Route::post('/tests', [TestController::class, 'store'])->name('tests.store');
Route::put('/tests/{test}', [TestController::class, 'update'])->name('tests.update');
Route::delete('/tests/{test}', [TestController::class, 'destroy'])->name('tests.destroy');