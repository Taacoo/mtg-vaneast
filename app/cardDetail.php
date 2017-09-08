<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cardDetail extends Model
{
    protected $fillable = [
        'name', 'manaCost', 'cmc', 'type', 'text', 'power', 'toughness'
    ];

    public function legalities(){
        return $this->hasMany(Legality::class);
    }

    public function rulings(){
        return $this->hasOne(Ruling::class);
    }


}
