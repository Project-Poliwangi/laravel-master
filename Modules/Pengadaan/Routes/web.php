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
    // Route::prefix('keuangan')->group(function () {
    //     Route::get('/', function () {
    //         return redirect()->route('dashboard');
    //     });
    // });
    //     Route::get('unit/dashboard', 'UnitController@index')->name('dashboard');
    
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
        Route::get('/index', 'DashboardUsersController@index')->name('unit.index');
        Route::get('/daftarpermohonan', 'UnitController@daftarpermohonan')->name('unit.permohonan');
        Route::get('/permohonandiproses', 'UnitController@permohonandiproses')->name('unit.diproses');
        Route::get('/permohonanselesai', 'UnitController@permohonanselesai')->name('unit.selesai');
        Route::get('/templatedokumen', 'UnitController@templatedokumen')->name('unit.template');
        Route::get('/create', 'UnitController@create')->name('unit.create');
        Route::post('/store', 'UnitController@store')->name('unit.store');
        Route::get('/show/{id}', 'UnitController@show')->name('unit.show');
        Route::get('/edit/{id}', 'UnitController@edit')->name('unit.edit');
        Route::patch('/update/{id}', 'UnitController@update')->name('unit.update');
        Route::delete('/destroy/{id}', 'UnitController@destroy')->name('unit.destroy');
        
    });

    Route::prefix('admin')->group(function () {
        Route::get('/keloladokumen', 'AdminController@index')->name('admin.index');
        Route::post('/store', 'AdminController@store')->name('admin.store');
        Route::get('dokumen/show/{id}', 'AdminController@show')->name('admin.show');
        Route::get('dokumen/edit/{id}', 'AdminController@edit')->name('admin.edit');
        Route::patch('dokumen/update/{id}', 'AdminController@update')->name('admin.update');
    });
    
}); 