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

/*        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.deckbrew.com/mtg/cards?name=". str_replace(' ', '+', $card->name));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $card_details = json_decode($output);
        dd($card_details);
        $card_details = $card_details[0];*/

        $price = MCM::request('https://www.mkmapi.eu/ws/v2.0/output.json/products/'.$card->mcm_product_id);

        $prices = [
            'sell' => $price->product->priceGuide->SELL,
            'low' => $price->product->priceGuide->LOW,
            'lowex' => $price->product->priceGuide->LOWEX,
            'lowfoil' => $price->product->priceGuide->LOWFOIL,
            'avg' => $price->product->priceGuide->AVG,
            'trend' => $price->product->priceGuide->TREND,
        ];

        return view('content.search.details', compact('card', 'prices', 'trades'));
    }
}
