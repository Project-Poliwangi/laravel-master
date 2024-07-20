<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\PeminjamanRuangan\Http\Controllers\KelolaGedung\KelolaGedungController;
use Modules\PeminjamanRuangan\Http\Controllers\KelolaPeminjaman\KelolaPeminjamanController;

Route::prefix('kelola-peminjaman')->group(function() {
    Route::get('', [KelolaPeminjamanController::class, 'index']);
});

Route::prefix('kelola-gedung')->group(function() {
    Route::get('', [KelolaGedungController::class, 'index'])->name('gedung');
    Route::get('create', [KelolaGedungController::class, 'create'])->name('gedung.create');
    Route::post('store', [KelolaGedungController::class, 'store'])->name('gedung.store');
    Route::delete('{gedung}/delete', [KelolaGedungController::class, 'index'])->name('gedung.delete');
    Route::post('{gedung}/update', [KelolaGedungController::class, 'update'])->name('gedung.update');
    Route::get('edit', [KelolaGedungController::class, 'edit'])->name('gedung.edit');
});
