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
    Route::prefix('monitoring')->group(function () {
        Route::get('/', 'MonitoringController@index');
        
        // perencanaan
        Route::get('/perencanaan', 'PerencanaanController@index')->name('perencanaan.index');
        Route::get('/perencanaan/create', 'PerencanaanController@create')->name('perencanaan.create');
        Route::post('/perencanaan/store', 'PerencanaanController@store')->name('perencanaan.store');
        Route::get('/perencanaan/{perencanaan}/edit', 'PerencanaanController@edit')->name('perencanaan.edit');
        Route::patch('/perencanaan/{perencanaan}/update', 'PerencanaanController@update')->name('perencanaan.update');
        Route::delete('/perencanaan/destroy/{perencanaan}', 'PerencanaanController@destroy')->name('perencanaan.destroy');

        // subPerencanaan
        Route::get('/perencanaan/{perencanaan}/sub_perencanaan', 'SubPerencanaanController@index')->name('perencanaan.sub_index');
        Route::get('/perencanaan/{perencanaan}/show', 'PerencanaanController@show')->name('perencanaan.show');
        Route::post('/perencanaan/{perencanaan}/subPerencanaan/store', 'SubPerencanaanController@store')->name('subPerencanaan.store');

        // realisasi
        Route::get('/realisasi', 'RealisasiController@index')->name('realisasi.index');

        // laporan
        Route::get('/laporan', 'LaporanController@index')->name('laporan.index');
    });
});
