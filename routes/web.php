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

use App\Card;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/testarea', function () {

    DB::enableQueryLog();

    $card = Card::find(14894);

    dd($card->expansion);

    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://api.deckbrew.com/mtg/cards?name=magmaw");

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);
    dd(json_decode($output));

    // close curl resource to free up system resources
    curl_close($ch);


    return view('auth.login');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about-me', 'HomeController@aboutMe')->name('about-me');

Route::get('/search', 'SearchController@index');
Route::post('/searching', 'SearchController@search');

Route::get('/card/{id}', 'SearchController@specific');

Route::get('/trade', 'TradeController@index');
Route::post('/trade/create', 'TradeController@createTrade');
Route::post('trade/addCard', 'TradeController@addCardToTrade');
Route::get('trade/removeCard', 'TradeController@removeFromTrade');
Route::get('/trade/{id}', 'TradeController@tradeDetails');

Route::get('/request', 'PriceCheckController@request');