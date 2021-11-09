<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ville/{q?}', 'VilleController@index');
Route::post('/ville', 'VilleController@store');
Route::get('/ville/edit/{id}', 'VilleController@edit');
Route::patch('/ville/edit/{id}', 'VilleController@update');
Route::delete('/ville/{id}', 'VilleController@destroy');

Route::get('/point/{v}/{q?}', 'PointController@index');
Route::get('/points', 'PointController@chargeville');
Route::post('/point', 'PointController@store');
Route::get('/point/edit/{id}', 'PointController@edit');
Route::patch('/point/edit/{id}', 'PointController@update');
Route::delete('/point/{id}', 'PointController@destroy');

Route::get('/Home', 'PointController@total');



