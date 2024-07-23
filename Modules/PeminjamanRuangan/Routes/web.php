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

use Illuminate\Support\Facades\Route;
use Modules\PeminjamanRuangan\Http\Controllers\KelolaGedung\KelolaGedungController;
use Modules\PeminjamanRuangan\Http\Controllers\KelolaMataKuliah\KelolaMataKuliahController;
use Modules\PeminjamanRuangan\Http\Controllers\KelolaPeminjaman\KelolaPeminjamanController;
use Modules\PeminjamanRuangan\Http\Controllers\KelolaRuangan\KelolaRuanganController;
use Modules\PeminjamanRuangan\Http\Controllers\Peminjaman\PeminjamanController;
use Modules\PeminjamanRuangan\Http\Controllers\Penjadwalan\PenjadwalanController;
use Modules\PeminjamanRuangan\Http\Controllers\Ruang\RuangController;

Route::middleware(['auth', 'permission'])->group(function() {
    Route::prefix('kelola-peminjaman')->group(function() {
        Route::get('', [KelolaPeminjamanController::class, 'index']);
    });
    
    Route::prefix('kelola-gedung')->group(function() {
        Route::get('', [KelolaGedungController::class, 'index'])->name('gedung');
        Route::get('create', [KelolaGedungController::class, 'create'])->name('gedung.create');
        Route::post('store', [KelolaGedungController::class, 'store'])->name('gedung.store');
        Route::delete('{gedung}/delete', [KelolaGedungController::class, 'destroy'])->name('gedung.delete');
        Route::post('{gedung}/update', [KelolaGedungController::class, 'update'])->name('gedung.update');
        Route::get('{gedung}/edit', [KelolaGedungController::class, 'edit'])->name('gedung.edit');
    });
    
    Route::prefix('kelola-ruangan')->group(function() {
        Route::get('', [KelolaRuanganController::class, 'index'])->name('ruang');
        Route::get('create', [KelolaRuanganController::class, 'create'])->name('ruang.create');
        Route::post('store', [KelolaRuanganController::class, 'store'])->name('ruang.store');
        Route::delete('{ruang}/delete', [KelolaRuanganController::class, 'destroy'])->name('ruang.delete');
        Route::post('{ruang}/update', [KelolaRuanganController::class, 'update'])->name('ruang.update');
        Route::get('{ruang}/edit', [KelolaRuanganController::class, 'edit'])->name('ruang.edit');
    });
    
    Route::prefix('kelola-mata-kuliah')->group(function() {
        Route::get('', [KelolaMataKuliahController::class, 'index'])->name('mata-kuliah');
        Route::get('create', [KelolaMataKuliahController::class, 'create'])->name('mata-kuliah.create');
        Route::post('store', [KelolaMataKuliahController::class, 'store'])->name('mata-kuliah.store');
        Route::delete('{mataKuliah}/delete', [KelolaMataKuliahController::class, 'destroy'])->name('mata-kuliah.delete');
        Route::post('{mataKuliah}/update', [KelolaMataKuliahController::class, 'update'])->name('mata-kuliah.update');
        Route::get('{mataKuliah}/edit', [KelolaMataKuliahController::class, 'edit'])->name('mata-kuliah.edit');
    });
    
    Route::prefix('penjadwalan')->group(function() {
        Route::get('', [PenjadwalanController::class, 'index'])->name('penjadwalan');
    });
    
    Route::prefix('ruangan')->group(function() {
        Route::get('check', [RuangController::class, 'checkRuangan'])->name('ruang.check');
        Route::get('check/{kode}', [RuangController::class, 'checkKodeQR'])->name('ruang.check-kode');
        Route::get('tersedia', [RuangController::class, 'ruanganTersedia'])->name('ruang.tersedia');
        Route::get('terpakai', [RuangController::class, 'ruanganTerpakai'])->name('ruang.terpakai');
    });
});

Route::prefix('peminjaman')->group(function() {
    Route::get('', [PeminjamanController::class, 'index'])->name('peminjaman');
});