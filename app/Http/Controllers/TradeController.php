<?php

namespace App\Http\Controllers;

use App\Intrade;
use App\Trade;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TradeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $trades = Auth::user()->trades;

        return view ('content.trade.index', compact('trades'));
    }

    /**
     *
     */
    public function createTrade(){
        $user = Auth::user();

        $trade = new Trade();
        $trade->name = Input::get('trade_name');
        $trade->user_id = $user->id;
        $trade->save();

        return redirect()->action('TradeController@tradeDetails', $trade->id);
    }

    /**
     *
     */
    public function addCardToTrade(Request $request){
        $card = $request->card_id;
        $trade = $request->trade_id;

        $inTrade = new Intrade();
        $inTrade->trade_id = $trade;
        $inTrade->card_id = $card;
        $inTrade->price_sell = '';
        $inTrade->price_low = '';
        $inTrade->price_lowfoil = '';
        $inTrade->price_avg = $request->avg;
        $inTrade->price_trend = '';
        $inTrade->belongs_to = ($request->choice == 'me') ? 1 : 0;
        $inTrade->save();

        return response()->json(array('html' => '<div class="alert alert-success">Successfully added to trade</div>'));
    }

    public function  removeFromTrade(Request $request){
        $inTrade = Intrade::find($request->id);

        if($inTrade->delete()){
            return redirect()->action('TradeController@tradeDetails', $inTrade->trade_id)->with('success', 'Successfully removed from trade');
        }

        return redirect()->action('TradeController@tradeDetails', $inTrade->trade_id)->with('error', 'Something went wrong, please try again');
    }

    /**
     *
     */
    public function tradeDetails($id){
        $trade = Trade::find($id);

        return view('content.trade.details', compact('trade'));
    }

    /**
     *
     */
    public function removeTrade(Request $request){
        $trade = Trade::find($request->trade_id);

        foreach($trade->intrades as $c){
            $c->delete();
        }

        if($trade->delete()){
            return response()->json(array('html' => '<div class="alert alert-success">Successfully removed trade</div>'));
        }

        return response()->json(array('html' => '<div class="alert alert-success">Something went wrong removing this trade. Please try again</div>'));
    }

}
