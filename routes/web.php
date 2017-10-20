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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/testarea', function () {

})->middleware('auth');
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/about-us', 'HomeController@aboutUs');

Route::get('/search', 'SearchController@index');
Route::post('/searching', 'SearchController@search');

Route::get('/card/{id}', 'SearchController@specific');

Route::get('/trade', 'TradeController@index');
Route::post('/trade/create', 'TradeController@createTrade');
Route::post('/trade/removeTrade', 'TradeController@removeTrade');
Route::post('/trade/addCard', 'TradeController@addCardToTrade');
Route::get('/trade/removeCard', 'TradeController@removeFromTrade');
Route::get('/trade/{id}', 'TradeController@tradeDetails');

Route::get('/request', 'PriceCheckController@request');

Route::get('/wishlist', 'WishlistController@index');
Route::post('/wishlist/create', 'WishlistController@createWishlist');
Route::post('/wishlist/addCard', 'WishlistController@addCardToWishlist');
Route::get('/wishlist/removeCard', 'WishlistController@removeFromWishlist');
Route::post('/wishlist/removeWishlist', 'WishlistController@removeWishlist');
Route::get('/wishlist/{id}', 'WishlistController@wishlistDetails');

Route::get('/cards', 'CardController@index');

/**
 * Admin Routes
 */

Route::get('/admin', 'Admin\HomeController@index');
Route::get('/{fourOfour}', 'HomeController@errorFourOFour');

Route::get('/admin/users', 'Admin\UserController@index');
Route::get('/admin/users/{id}', 'Admin\UserController@details');

Route::get('/admin/cards', 'Admin\CardController@index');
Route::get('/admin/cards/{id}', 'Admin\CardController@details');

Route::get('/admin/expansions', 'Admin\ExpansionController@index');
Route::get('/admin/expansions/{id}', 'Admin\ExpansionController@details');

Route::get('/admin/trades', 'Admin\TradeController@index');
Route::get('/admin/trades/{id}', 'Admin\TradeController@details');

Route::get('/admin/wishlists', 'Admin\WishlistController@index');
Route::get('/admin/wishlists/{id}', 'Admin\WishlistController@details');