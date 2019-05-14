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

Route::get('/','HomeController@index');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/movimientos', 'MovimientoController@index')->name('movimientos');
Route::post('/movimientos', 'MovimientoController@create')->name('movimientos');
Route::get('/caja', 'DashboardCajaController@index')->name('caja.dashboard');
Route::get('/balance-mensual', 'BalanceMensualController@index')->name('balance');
Route::post('/balance-mensual', 'BalanceMensualController@balance')->name('balance.consultar');
Route::post('/cierre-mensual', 'BalanceMensualController@cierre')->name('balance.cierre');
Route::get('/deudas', 'DeudasController@index')->name('deudas.index');
Route::post('/deudas', 'DeudasController@create')->name('deudas.save');
Route::get('/deudas-dashboard', 'DeudasController@dashboard')->name('deudas.dashboard');
Route::get('/tabla/{name}', 'DeudasController@gettabla');






Route::get('/template', function(){
    return view('layouts.admin-bckp');
});
