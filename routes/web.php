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

    $path = storage_path() . "/json/XLN.json";
    if (!File::exists($path)) {
        throw new Exception("Invalid File");
    }

    $file = json_decode(File::get($path));

    foreach($file->cards as $c){

        $card = cardDetail::updateOrCreate(array('name' => $c->name));

        $card->name = $c->name;
        if(array_key_exists('manaCost', $c)) {
            $card->manaCost = $c->manaCost;
        }
        if(array_key_exists('cmc', $c)) {
            $card->cmc = $c->cmc;
        }
        if(array_key_exists('power', $c)) {
            $card->power = $c->power;
        }
        if(array_key_exists('toughness', $c)) {
            $card->toughness = $c->toughness;
        }
        if(array_key_exists('text', $c)) {
            $card->text = $c->text;
        }

        if(array_key_exists('type', $c)) {
            $card->type = $c->type;
        }
        $card->save();

        if(array_key_exists('legalities', $c)) {
            foreach($c->legalities as $l){
                if($l->format == 'Modern' || $l->format == 'Modern' || $l->format == 'Commander' || $l->format == 'Legacy' || $l->format == 'Standard' ||  $l->format == 'Vintage'){
                    $format = Legality::updateOrCreate(array('card_detail_id' => $card->id, 'format' => $l->format));

                    $format->card_detail_id = $card->id;
                    $format->format = $l->format;
                    $format->legality = $l->legality;
                    $format->save();
                }
            }
        }

        if(array_key_exists('rulings', $c)) {
            foreach($c->rulings as $r){
                $ruling = Ruling::firstorNew(array('card_detail_id' => $card->id, 'date' => $r->date));

                $ruling->card_detail_id = $card->id;
                $ruling->text = base64_encode($r->text);
                $ruling->date = $r->date;
                $ruling->save();
            }
        }
    }



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
Route::get('/admin/users/{id}', 'Admin\UserController@specific');

Route::get('/admin/cards', 'Admin\CardController@index');
Route::get('/admin/cards/{id}', 'Admin\CardController@specific');

Route::get('/admin/expansions', 'Admin\ExpansionController@index');
Route::get('/admin/expansions/{id}', 'Admin\ExpansionController@specific');

Route::get('/admin/trades', 'Admin\TradeController@index');
Route::get('/admin/trades/{id}', 'Admin\TradeController@specific');

Route::get('/admin/wishlists', 'Admin\WishlistController@index');
Route::get('/admin/wishlists/{id}', 'Admin\WishlistController@specific');