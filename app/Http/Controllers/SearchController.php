<?php

namespace App\Http\Controllers;

use App\MCM;
use Illuminate\Http\Request;
use App\Card;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('content.search.index');
    }

    public function search(Request $request){
        $result = Card::where('name', 'LIKE', '%'. $request->card_search . '%')->get();

        if(count($result) == 0){
            return redirect()->action('SearchController@index')->with('message', 'No cards found using: "<i>' . $request->card_search . '"</i>');

        }elseif(count($result) == 1){
            $result = $result->first();

            return redirect()->action('SearchController@specific', $result->id);
        }

        return view('content.search.index', compact('result'));
    }

    public function specific($id){
        $card = Card::find($id);
        $trades = Auth::user()->trades;
        $wishlists = Auth::user()->wishlists;

        if($card->daily_avg != null){
            $prices = [
                'sell' => $card->daily_sell,
                'low' => $card->daily_low,
                'lowex' => $card->daily_lowex,
                'lowfoil' => $card->daily_lowfoil,
                'avg' => $card->daily_avg,
                'trend' => $card->daily_trend
            ];

            return view('content.search.details', compact('card', 'prices', 'trades', 'wishlists'));
        }

        $price = MCM::request('https://www.mkmapi.eu/ws/v2.0/output.json/products/'.$card->mcm_product_id);

        $prices = [
            'sell' => $price->product->priceGuide->SELL,
            'low' => $price->product->priceGuide->LOW,
            'lowex' => $price->product->priceGuide->LOWEX,
            'lowfoil' => $price->product->priceGuide->LOWFOIL,
            'avg' => $price->product->priceGuide->AVG,
            'trend' => $price->product->priceGuide->TREND
        ];

        $card->daily_sell = $price->product->priceGuide->SELL;
        $card->daily_low = $price->product->priceGuide->LOW;
        $card->daily_lowex = $price->product->priceGuide->LOWEX;
        $card->daily_lowfoil = $price->product->priceGuide->LOWFOIL;
        $card->daily_avg = $price->product->priceGuide->AVG;
        $card->daily_trend = $price->product->priceGuide->TREND;
        $card->save();

        return view('content.search.details', compact('card', 'prices', 'trades', 'wishlists'));
    }
}
