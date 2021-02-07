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

Route::get('areas', 'AreaController@get');
Route::post('area/save', 'AreaController@store');
Route::post('street/save', 'StreetController@store');
Route::post('street/search', 'StreetController@search');
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
