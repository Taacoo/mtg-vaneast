<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function expansion(){
        return $this->belongsTo(Expansion::class);
    }

    public function dailyPrice(){
        return $this->hasOne(dailyPrice::class);
    }
}
