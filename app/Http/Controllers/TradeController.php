<?php

namespace App\Http\Controllers;

use App\Trade;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TradeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $trades = Auth::user()->trade;

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
    public function addCardToTrade(){

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
    public function deleteTrade(){

    }


}
