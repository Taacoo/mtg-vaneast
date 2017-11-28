<?php

namespace App\Http\Controllers;

use App\Card;
use App\Inwishlist;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $wishlists = Auth::user()->wishlists;

        return view('content.import.index', compact('wishlists'));
    }

    public function process(Request $request){

        if($request->filled('newWishlist')){
            $wishlist = new Wishlist;
            $wishlist->name = $request->newWishlist;
            $wishlist->user_id = Auth::id();
            $wishlist->save();
        }else{
            $wishlist = Wishlist::find($request->wishlistPicker);
            if($wishlist->user_id != Auth::id()){
                abort(501);
            }
        }

        if($request->hasFile('uploadFile')){
            $file = $request->file('uploadFile');

            if($file->isValid()){
                if($file->extension() == 'csv'){
                    $this->csvProcess($file, $wishlist->id);
                }elseif($file->extension() == 'txt'){
                   if($this->txtProcess($file, $wishlist->id)){
                       return redirect()->action('WishlistController@wishlistDetails', ['id' => $wishlist->id]);
                   }
                }
            }
        }

        dd('nope');
    }

    private function csvProcess($file, $wishlist){
        //TODO: [Joshua] 
    }

    private function txtProcess($file, $wishlist){
        $file = fopen($file, 'r');
        $failed = array();
        while(!feof($file)){

            $line = trim(preg_replace('/\s\s+/', ' ', fgets(substr($file,$strLen))));
            preg_match_all('!\d+!', $line, $matches);

            $amount = implode('', $matches[0]);
            $strLen = strlen($amount);
            $line = trim(substr($file,$strLen));

            $card = Card::where('name', $line)->first();
            if($card != null){

                $inWishlist = new Inwishlist();
                $inWishlist->wishlist_id = $wishlist;
                $inWishlist->card_id = $card->id;
                $inWishlist->quantity = $amount;
                $inWishlist->save();

                continue;
            }

            $failed = $line;
        }
        fclose($file);

        return true;
    }
}
