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

Route::group(['middleware' => ['auth', 'permission']], function () {
    
    Route::prefix('direktur')->group(function () {
        Route::get('/', 'PengadaanController@index');
        Route::get('/dashboard', 'DashboardUsersController@direktur')->name('direktur.dashboard');
        Route::get('/daftarpermohonan', 'DirekturController@daftarpermohonan')->name('direktur.daftarpermohonan');
        Route::get('/permohonandiproses', 'DirekturController@permohonandiproses')->name('direktur.permohonandiproses');
        Route::get('/permohonanselesai', 'DirekturController@permohonanselesai')->name('direktur.permohonanselesai');
    });

    Route::prefix('ppk')->group(function () {
        Route::get('/', 'PengadaanController@index');
        Route::get('/dashboard', 'DashboardUsersController@unit')->name('ppk.dashboard');
        Route::get('/daftarpermohonan', 'PPKController@daftarpermohonan')->name('ppk.permohonan');
        Route::get('/permohonandiproses', 'PPKController@permohonandiproses')->name('ppk.diproses');
        Route::get('/permohonanselesai', 'PPKController@permohonanselesai')->name('ppk.selesai');
        Route::get('/penetapan', 'PPKController@penetapan')->name('ppk.penetapan');
        Route::get('/kontrak', 'PPKController@diproses')->name('ppk.kontrak');
        Route::get('/serahterima', 'PPKController@selesai')->name('ppk.serahterima');
    });

    Route::prefix('unit')->group(function () {
        Route::get('/', 'PengadaanController@index');
        Route::get('/dashboard', 'DashboardUsersController@unit')->name('unit.dashboard');
        Route::get('/daftarpermohonan', 'UnitController@daftarpermohonan')->name('unit.permohonan');
        Route::get('/permohonandiproses', 'UnitController@permohonandiproses')->name('unit.diproses');
        Route::get('/permohonanselesai', 'UnitController@permohonanselesai')->name('unit.selesai');
        Route::get('/templatedokumen', 'UnitController@templatedokumen')->name('unit.template');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', 'PengadaanController@index');
        Route::get('/keloladokumen', 'AdminController@keloladokumen')->name('admin.keloladokumen');
    });
    
}); 
