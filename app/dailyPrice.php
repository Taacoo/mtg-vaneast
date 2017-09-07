<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dailyPrice extends Model
{
    public function card(){
        return $this->belongsTo(Card::class);
    }
}
