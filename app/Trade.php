<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
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

    public function intrades(){
        return $this->hasMany(Intrade::class);
    }

    public static function getMyTradeValue($id){
        $inTrade = Intrade::where('trade_id', $id)->where('belongs_to', 1)->get();
        $value = 0;

        foreach($inTrade as $i){
            $value = $value + $i->price_avg;
        }

        return '&euro; ' . number_format($value, 2,',','.');
    }

    public static function getPartnerTradeValue($id){
        $inTrade = Intrade::where('trade_id', $id)->where('belongs_to', 0)->get();
        $value = 0;

        foreach($inTrade as $i){
            $value = $value + $i->price_avg;
        }

        return '&euro; ' . number_format($value, 2,',','.');
    }

    public static function getTradeValue($id){
        $inTrade = Intrade::where('trade_id', $id)->get();
        $value = 0;

        foreach($inTrade as $i){
            if($i->belongs_to == 1){
                $value = $value + $i->price_avg;
                continue;
            }
            $value = $value - $i->price_avg;
        }

        return $value;
    }

    public static function allTradeValue(){
        $inTrade = Intrade::all();
        $value = 0;

        foreach($inTrade as $T){
            $value = $value + $T->price_avg;
        }

        return $value;
    }
}
