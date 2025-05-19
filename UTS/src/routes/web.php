<?php

use App\Livewire\ShowAbout;
use App\Models\Beasiswa;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Livewire\ShowHomePage;
use App\Livewire\ShowProfile;
use Illuminate\Http\Request;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/

// Halaman utama
Route::get('/', ShowHomePage::class)->name('home');

// Halaman profil
Route::get('/profile', ShowProfile::class)->name('profile');

// Halaman tentang
Route::get('/about', ShowAbout::class)->name('about');

// ========================
// ✨ Tambahan: Route Export Beasiswa
// ========================

// Export satu beasiswa
Route::get('/beasiswa/{beasiswa}/export', function (Beasiswa $beasiswa) {
    // TODO: Ganti dengan logic export file jika dibutuhkan
    return response()->json([
        'message' => 'Export data beasiswa: ' . $beasiswa->nama,
        'id' => $beasiswa->id,
    ]);
})->name('beasiswa.export');

// Export beberapa beasiswa sekaligus (bulk export)
Route::get('/beasiswa/export/all/{ids}', function ($ids) {
    $idArray = explode(',', $ids);
    $beasiswas = Beasiswa::whereIn('id', $idArray)->get();

    return response()->json([
        'message' => 'Export data beberapa beasiswa',
        'jumlah' => $beasiswas->count(),
        'data' => $beasiswas,
    ]);
})->name('beasiswa.export.all');
