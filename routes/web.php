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
Route::group(['middleware' => 'login'],function()
{
	Route::get('/', 'HomeController@index');
	Route::get('home', 'HomeController@index');
});

Route::group(['middleware' => 'logout'],function()
{
	Route::get('home/index', 'Home\HomeController@index');
	Route::post('ubicacion/new', 'Ubicacion\UbicacionController@saveUbicacion');
	Route::post('ubicacion/getUbicaciones', 'Ubicacion\UbicacionController@getUbicaciones');
});
Route::post('login', 'login\LoginController@login');
Route::get('logout','login\LoginController@logout');