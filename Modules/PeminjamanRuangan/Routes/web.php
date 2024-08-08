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
use Modules\PeminjamanRuangan\Http\Controllers\Dashboard\DashboardController;
use Modules\PeminjamanRuangan\Http\Controllers\KelolaGedung\KelolaGedungController;
use Modules\PeminjamanRuangan\Http\Controllers\KelolaMataKuliah\KelolaMataKuliahController;
use Modules\PeminjamanRuangan\Http\Controllers\KelolaPeminjaman\KelolaPeminjamanController;
use Modules\PeminjamanRuangan\Http\Controllers\KelolaRuangan\KelolaRuanganController;
use Modules\PeminjamanRuangan\Http\Controllers\Peminjaman\PeminjamanController;
use Modules\PeminjamanRuangan\Http\Controllers\Penjadwalan\PenjadwalanController;
use Modules\PeminjamanRuangan\Http\Controllers\Ruang\RuangController;

Route::middleware(['auth'])->group(function() {
    Route::prefix('home')->group(function() {
        Route::get('', [DashboardController::class, 'index'])->name('home.index');
    });

    Route::prefix('kelola-peminjaman')->group(function() {
        Route::get('', [KelolaPeminjamanController::class, 'index'])->name('kelola-peminjaman');
        Route::get('{peminjaman}/edit', [KelolaPeminjamanController::class, 'edit'])->name('kelola-peminjaman.edit');
        Route::post('{peminjaman}/update', [KelolaPeminjamanController::class, 'update'])->name('kelola-peminjaman.update');
        Route::get('{peminjaman}/accept', [KelolaPeminjamanController::class, 'accept'])->name('kelola-peminjaman.accept');
        Route::get('{peminjaman}/reject', [KelolaPeminjamanController::class, 'reject'])->name('kelola-peminjaman.reject');
    });
    
    Route::prefix('kelola-gedung')->group(function() {
        Route::get('', [KelolaGedungController::class, 'index'])->name('gedung');
        Route::get('create', [KelolaGedungController::class, 'create'])->name('gedung.create');
        Route::post('store', [KelolaGedungController::class, 'store'])->name('gedung.store');
        Route::delete('{gedung}/delete', [KelolaGedungController::class, 'destroy'])->name('gedung.delete');
        Route::post('{gedung}/update', [KelolaGedungController::class, 'update'])->name('gedung.update');
        Route::get('{gedung}/edit', [KelolaGedungController::class, 'edit'])->name('gedung.edit');
        Route::get('sync', [KelolaGedungController::class, 'sync'])->name('gedung.sync');
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
        Route::get('create', [PenjadwalanController::class, 'create'])->name('penjadwalan.create');
        Route::post('store', [PenjadwalanController::class, 'store'])->name('penjadwalan.store');
        Route::delete('{jadwalKuliah}/delete', [PenjadwalanController::class, 'destroy'])->name('penjadwalan.delete');
        Route::post('{jadwalKuliah}/update', [PenjadwalanController::class, 'update'])->name('penjadwalan.update');
        Route::get('{jadwalKuliah}/edit', [PenjadwalanController::class, 'edit'])->name('penjadwalan.edit');
    });
    
    Route::prefix('ruangan')->group(function() {
        Route::get('check', [RuangController::class, 'checkRuangan'])->name('ruang.check');
        Route::get('check/{kode}', [RuangController::class, 'checkKodeQR'])->name('ruang.check-kode');
        Route::get('tersedia', [RuangController::class, 'ruanganTersedia'])->name('ruang.tersedia');
        Route::get('terpakai', [RuangController::class, 'ruanganTerpakai'])->name('ruang.terpakai');
        Route::get('detail/{ruang}', [RuangController::class, 'detailRuangan'])->name('ruang.detail');
        Route::get('pinjam/{ruang?}', [RuangController::class, 'createPeminjaman'])->name('ruang.create-peminjaman');
        Route::post('simpan-peminjaman', [RuangController::class, 'storePeminjaman'])->name('ruang.store-peminjaman');
    });
});

Route::prefix('peminjaman')->group(function() {
    Route::get('', [PeminjamanController::class, 'index'])->name('peminjaman');
    Route::delete('{peminjaman}/delete', [PeminjamanController::class, 'destroy'])->name('peminjaman.delete');
    Route::post('{peminjaman}/update', [PeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::get('{peminjaman}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
});