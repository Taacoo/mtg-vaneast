<?php

namespace App\Http\Controllers;

use App\Inwishlist;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class WishlistController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $wishlists = Auth::user()->wishlists;

        return view('content.wishlist.index', compact('wishlists'));
    }

    public function createWishlist(){
        $user = Auth::user();

        $wishlist = new Wishlist();
        $wishlist->name = Input::get('wishlist_name');
        $wishlist->user_id = $user->id;
        $wishlist->save();

        return redirect()->action('WishlistController@index');
    }

    public function removeWishlist(Request $request){
        $wishlist = Wishlist::find($request->wishlist_id);

        foreach($wishlist->inwishlists as $c){
            $c->delete();
        }

        if($wishlist->delete()){
            return response()->json(array('html' => '<div class="alert alert-success">Successfully removed wishlist</div>'));
        }

        return response()->json(array('html' => '<div class="alert alert-success">Something went wrong removing this Wishlist. Please try again</div>'));
    }

    public function wishlistDetails($id){
        $wishlist = Wishlist::find($id);

        return view('content.wishlist.details', compact('wishlist'));
    }

    /**
     *
     */
    public function addCardToWishlist(Request $request){
        $card = $request->card_id;
        $wishlist = $request->wishlist_id;
        $quantity = $request->quantity;

        $Inwishlist = new Inwishlist();
        $Inwishlist->wishlist_id = $wishlist;
        $Inwishlist->card_id = $card;
        $Inwishlist->quantity = $quantity;
        $Inwishlist->save();

        return response()->json(array('html' => '<div class="alert alert-success">Successfully added to wishlist</div>'));
    }

    public function removeFromWishlist(Request $request){
        $inWishlist = Inwishlist::find($request->id);

        if($inWishlist->delete()){
            return redirect()->action('WishlistController@wishlistDetails', $inWishlist->trade_id)->with('error', 'Successfully removed from trade');
        }

        return redirect()->action('WishlistController@wishlistDetails', $inWishlist->trade_id)->with('error', 'Something went wrong, please try again');
    }
}
