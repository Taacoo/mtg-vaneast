<?php

namespace App\Http\Controllers;

use App\Card;
use App\Inwishlist;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use File;

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
        $bytes = File::size($file);
        if($bytes > 3000000){
            //TODO: [Joshua] Add Error Handling
            return 'To Big';
        }

        $file = fopen($file, 'r');
        $failed = array();
        $x = 0;
        while(!feof($file)){
            $line = trim(preg_replace('/\s\s+/', ' ', fgets($file)));
            if($file == " "){
                continue;
            }

            preg_match_all('!\d+!', $line, $matches);

            $amount = implode('', $matches[0]);
            $strLen = strlen($amount);
            $line = trim(substr($line,$strLen));
            if($amount == 0){
                $amount = 1;
            }

            $card = Card::where('name', $line)->first();
            if($card != null){

                $inWishlist = new Inwishlist();
                $inWishlist->wishlist_id = $wishlist;
                $inWishlist->card_id = $card->id;
                $inWishlist->quantity = $amount;
                $inWishlist->save();

                continue;
            }

            $failed[$x] = $line;
            $x++;
        }

        fclose($file);

        if(count($failed) > 0){
            //TODO: [Joshua] Return file with failed cards
            $fileText = '';
            foreach($failed as $f){
                $fileText .= $f . '\n';
            }

            $myName = Wishlist::find($wishlist)->name . "_failed.txt";
            $headers = ['Content-type' => 'text/plain', 'Content-Disposition' => sprintf('attachment; filename="%s"', $myName), 'Content-Length' => sizeof($fileText)];

            return Response::create($fileText, 200, $headers);
        }
        return true;
    }
}
