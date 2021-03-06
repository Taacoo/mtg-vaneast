<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expansion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'abbreviation', 'release_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function cards(){
        return $this->hasMany(Card::class);
    }
}
