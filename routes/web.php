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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('login','AuthController@login')->name('login');
Route::post('/login','AuthController@postLogin')->name('postLogin');


Route::group(['middleware' => ['auth']],function(){
    Route::get('/','HomeController@index')->name('index');

    Route::group(['prefix' => 'jenis-barang'],function(){
        Route::get('/','JenisController@getJenis')->name('getJenis');
        Route::post('/','JenisController@storeJenis')->name('storeJenis');
        Route::patch('/','JenisController@updateJenis')->name('updateJenis');
        Route::get('/delete/{id}','JenisController@deleteJenis')->name('deleteJenis');
    });

    Route::group(['prefix' => 'barang'],function(){
        Route::get('/','BarangController@getBarang')->name('getBarang');
        Route::post('/','BarangController@storeBarang')->name('storeBarang');
        Route::patch('/','BarangController@updateBarang')->name('updateBarang');
        Route::get('/delete/{id}','BarangController@deleteBarang')->name('deleteBarang');
    });

    Route::group(['prefix' => 'supplier'],function(){
        Route::get('/','SupplierController@getSupplier')->name('getSupplier');
        Route::post('/','SupplierController@storeSupplier')->name('storeSupplier');
        Route::patch('/','SupplierController@updateSupplier')->name('updateSupplier');
        Route::get('/delete/{id}','SupplierController@deleteSupplier')->name('deleteSupplier');
    });

});
