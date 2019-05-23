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
Route::get('/movimientos-actividad', 'MovimientoController@indexa')->name('movimientos.actividad');
Route::post('/movimientos', 'MovimientoController@create')->name('movimientos');
Route::get('/caja', 'DashboardCajaController@index')->name('caja.dashboard');
Route::get('/balance-mensual', 'BalanceMensualController@index')->name('balance');
Route::post('/balance-mensual', 'BalanceMensualController@balance')->name('balance.consultar');
Route::post('/cierre-mensual', 'BalanceMensualController@cierre')->name('balance.cierre');
Route::get('/balance-mensual-reporte/{year}/{mes}', 'BalanceMensualController@reporte')->name('balance.mensual.reporte');
Route::get('/pdf/{year}/{mes}', 'BalanceMensualController@pdf')->name('balance.mensual.pdf');

Route::get('/deudas', 'DeudasController@index')->name('deudas.index');
Route::get('/deudas-actividad', 'DeudasController@indexa')->name('deudas.actividad');
Route::post('/deudas', 'DeudasController@create')->name('deudas.save');
Route::get('/deudas-dashboard', 'DeudasController@dashboard')->name('deudas.dashboard');
Route::post('/deudas-contabilizar', 'DeudasController@contabilizar')->name('deudas.contabilizar');
Route::get('/deudas-extornar/{iddeuda}', 'DeudasController@extornar')->name('deudas.extornar');

Route::get('/actividad-lista', 'ActividadController@lista')->name('actividad.lista');
Route::get('/actividad-balance/{idactividad}', 'ActividadController@balance')->name('actividad.balance');
Route::get('/actividad-balance-reporte/{idactividad}', 'ActividadController@reporte')->name('actividad.balance.reporte');
Route::get('/actividad-balance-pdf/{idactividad}', 'ActividadController@pdf')->name('actividad.balance.pdf');

Route::post('/cierre-actividad', 'ActividadController@cierre')->name('actividad.cierre');



Route::get('/tabla/{name}', 'DeudasController@gettabla');






Route::get('/template', function(){
    return view('layouts.admin-bckp');
});
