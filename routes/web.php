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

use App\MCM;
use Carbon\Carbon;

Route::get('/', function () {

    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about-me', 'HomeController@aboutMe')->name('about-me');

Route::get('/search', 'SearchController@index')->middleware('auth');
Route::post('/searching', 'SearchController@search')->middleware('auth');

Route::get('/trade', 'TradeController@index')->middleware('auth');

Route::get('/request', 'PriceCheckController@request')->middleware('auth');