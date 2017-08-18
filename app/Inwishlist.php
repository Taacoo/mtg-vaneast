<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inwishlist extends Model
{
    public function wishlist(){
        return $this->belongsTo(Wishlist::class);
    }

    public function card(){
        return $this->belongsTo(Card::class);
    }
}
