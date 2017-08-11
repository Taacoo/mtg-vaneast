<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intrade extends Model
{
    public function trade(){
        return $this->belongsTo(Trade::class);
    }

    public function card(){
        return $this->belongsTo(Card::class);
    }
}
