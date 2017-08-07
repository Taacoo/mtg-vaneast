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

    $cards = MCM::request('https://www.mkmapi.eu/ws/v2.0/output.json/expansions/1469/singles');

    foreach ($cards->single as $c){
        dd($c);




    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about-me', 'HomeController@aboutMe')->name('about-me');

Route::get('/search', 'SearchController@index')->middleware('auth');

Route::get('/trade', 'TradeController@index')->middleware('auth');

Route::get('/request', 'PriceCheckController@request')->middleware('auth');