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
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::get('home/index', 'Home\HomeController@index');
Route::post('user/faceboock', 'User\NewController@index');
Route::post('user/newSave', 'User\NewController@saveUser');
Route::post('ubicacion/new', 'Ubicacion\UbicacionController@saveUbicacion');
Route::post('ubicacion/getUbicaciones', 'Ubicacion\UbicacionController@getUbicaciones');
Route::post('ubicacion/daleteUbicaciones', 'Ubicacion\UbicacionController@deleteUbicacion');
Route::post('ubicacion/ubicacionesCercanas', 'Ubicacion\UbicacionController@getUbicacionesCercanas');

Route::post('login', 'login\LoginController@login');
Route::get('logout','login\LoginController@logout');

Route::get('/user_login', function()
{
    return Session::get('user.id');
});