<?php

namespace App\Http\Controllers\Admin;

use App\Trade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TradeController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $trades = Trade::all();

        return view('admin.trades.index', $trades);
    }

    public function specific($id){

    }
}
