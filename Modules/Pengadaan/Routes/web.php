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
        Route::get('/dashboard', 'DirekturController@index')->name('direktur.index');
        Route::get('/daftarpengadaan', 'DirekturController@daftarpengadaan')->name('direktur.daftarpengadaan');
        Route::get('/show/{id}', 'DirekturController@show')->name('direktur.show');
    });

    Route::prefix('ppk')->group(function () {
        Route::get('/dashboard', 'PPKController@index')->name('ppk.index');
        Route::get('/daftarpengadaan', 'PPKController@daftarpengadaan')->name('ppk.daftarpengadaan');
        Route::get('/show/{id}', 'PPKController@show')->name('ppk.show');
        Route::get('/edit/{id}', 'PPKController@edit')->name('ppk.edit');
        Route::patch('/update/{id}', 'PPKController@update')->name('ppk.update');
        Route::patch('/updatestatus/{id}', 'PPKController@updatestatus')->name('ppk.updatestatus');
    });

    Route::prefix('unit')->group(function () {
        Route::get('/dashboard', 'UnitController@index')->name('unit.index');
        Route::get('/daftarpengadaan', 'UnitController@daftarpengadaan')->name('unit.daftarpengadaan');
        Route::get('/templatedokumen', 'UnitController@listTemplateDokumen')->name('unit.template');
        Route::get('/show/{id}', 'UnitController@show')->name('unit.show');
        Route::get('/edit/{id}', 'UnitController@edit')->name('unit.edit');
        Route::put('/update/{id}', 'UnitController@update')->name('unit.update');
        
    });

    Route::prefix('admin')->group(function () {
        Route::get('/keloladokumen', 'AdminController@index')->name('admin.index');
        Route::get('/dokumen/show/{id}', 'AdminController@show')->name('admin.show');
        Route::get('/dokumen/edit/{id}', 'AdminController@edit')->name('admin.edit');
        Route::patch('/dokumen/update/{id}', 'AdminController@update')->name('admin.update');
    });

    Route::prefix('pp')->group(function () {
        Route::get('/dashboard', 'PPController@index')->name('pp.index');
        Route::get('/daftarpengadaan', 'PPController@daftarpengadaan')->name('pp.daftarpengadaan');
        Route::get('/show/{id}', 'PPController@show')->name('pp.show');
        Route::get('/edit/{id}', 'PPController@edit')->name('pp.edit');
        Route::patch('/update/{id}', 'PPController@update')->name('pp.update');
    });

    Route::prefix('perencanaan')->group(function () {
        Route::get('/daftarperencanaan', 'PerencanaanController@daftarperencanaan')->name('perencanaan.perencanaan');
        Route::get('/create', 'PerencanaanController@create')->name('perencanaan.create');
        Route::post('/store', 'PerencanaanController@store')->name('perencanaan.store');
        Route::get('/edit/{id}', 'PerencanaanController@edit')->name('perencanaan.edit');
        Route::patch('/update/{id}', 'PerencanaanController@update')->name('perencanaan.update');
        Route::delete('/destroy/{id}', 'PerencanaanController@destroy')->name('perencanaan.destroy');
    });

    Route::prefix('subperencanaan')->group(function () {
        Route::get('/subperencanaan', 'SubPerencanaanController@index')->name('perencanaan.sub_index');
        Route::get('/create', 'SubPerencanaanController@create')->name('perencanaan.sub_create');
        Route::post('/store', 'SubPerencanaanController@store')->name('perencanaan.sub_store');
        Route::get('/show/{id}', 'SubPerencanaanController@show')->name('perencanaan.sub_show');
        Route::get('/edit/{id}', 'SubPerencanaanController@edit')->name('perencanaan.sub_edit');
        Route::patch('/update/{id}', 'SubPerencanaanController@update')->name('perencanaan.sub_update');
        Route::delete('/destroy/{id}', 'SubPerencanaanController@destroy')->name('perencanaan.sub_destroy');
    });
    
}); 