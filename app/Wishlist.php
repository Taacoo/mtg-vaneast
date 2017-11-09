<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inwishlists(){
        return $this->hasMany(Inwishlist::class);
    }

    public static function getCardValue($card_id){
        $card = Card::find($card_id);


        if($card->dailyPrice === null){
            $mcm = MCM::request('https://www.mkmapi.eu/ws/v2.0/output.json/products/'.$card->mcm_product_id);

            $dailyPrice = new dailyPrice();
            $dailyPrice->card_id = $card->id;
            $dailyPrice->daily_sell = $mcm->product->priceGuide->SELL;
            $dailyPrice->daily_low = $mcm->product->priceGuide->LOW;
            $dailyPrice->daily_lowex = $mcm->product->priceGuide->LOWEX;
            $dailyPrice->daily_lowfoil = $mcm->product->priceGuide->LOWFOIL;
            $dailyPrice->daily_avg = $mcm->product->priceGuide->AVG;
            $dailyPrice->daily_trend = $mcm->product->priceGuide->TREND;
            $dailyPrice->save();

            return $mcm->product->priceGuide->AVG;
        }

        return $card->dailyPrice->daily_avg;
    }

    public static function getTotalCardValue($card_id, $inwishlist_id){
        $card = Card::find($card_id);
        $wishlist_card = Inwishlist::find($inwishlist_id);

        if($card->dailyPrice === null){
            $mcm = MCM::request('https://www.mkmapi.eu/ws/v2.0/output.json/products/'.$card->mcm_product_id);

            $dailyPrice = new dailyPrice();
            $dailyPrice->card_id = $card->id;
            $dailyPrice->daily_sell = $mcm->product->priceGuide->SELL;
            $dailyPrice->daily_low = $mcm->product->priceGuide->LOW;
            $dailyPrice->daily_lowex = $mcm->product->priceGuide->LOWEX;
            $dailyPrice->daily_lowfoil = $mcm->product->priceGuide->LOWFOIL;
            $dailyPrice->daily_avg = $mcm->product->priceGuide->AVG;
            $dailyPrice->daily_trend = $mcm->product->priceGuide->TREND;
            $dailyPrice->save();

            return $mcm->product->priceGuide->AVG * $wishlist_card->quantity;
        }

        return $card->dailyPrice->daily_trend * $wishlist_card->quantity;
    }

    public static function getWishlistValue($id){
        $wishlist_cards = Wishlist::find($id)->inwishlists;
        $value = 0;

        foreach($wishlist_cards as $c){

            if($c->card->dailyPrice === null){
                $mcm = MCM::request('https://www.mkmapi.eu/ws/v2.0/output.json/products/'.$c->card->mcm_product_id);
                $avg = $mcm->product->priceGuide->AVG * $c->quantity;
                $value = $value + $avg;

                $card = Card::find($c->card->id);

                $dailyPrice = new dailyPrice();
                $dailyPrice->card_id = $card->id;
                $dailyPrice->daily_sell = $mcm->product->priceGuide->SELL;
                $dailyPrice->daily_low = $mcm->product->priceGuide->LOW;
                $dailyPrice->daily_lowex = $mcm->product->priceGuide->LOWEX;
                $dailyPrice->daily_lowfoil = $mcm->product->priceGuide->LOWFOIL;
                $dailyPrice->daily_avg = $mcm->product->priceGuide->AVG;
                $dailyPrice->daily_trend = $mcm->product->priceGuide->TREND;
                $dailyPrice->save();

                continue;
            }

            $value = $value + ($c->card->dailyPrice->daily_trend * $c->quantity);
            continue;
        }

        return $value;
    }

    public static function allWishlistValue(){
        $inWishlist = Wishlist::all();
        $value = 0;

        foreach($inWishlist as $W){
            //Do Something
        }

        return 'TO DO';
    }
}
