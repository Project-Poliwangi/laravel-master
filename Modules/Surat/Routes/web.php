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

Route::prefix('surat')->group(function() {
    Route::get('/surat-masuk', 'SuratController@index');
    Route::resource('surat-masuk', 'SuratController');
    Route::get('/arsip', 'ArsipController@index');
    Route::get('/disposisi-surat', 'DisposisiSuratController@index');
    Route::resource('disposisi-surat', 'DisposisiSuratController');
});
