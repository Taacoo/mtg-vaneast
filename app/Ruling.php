<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruling extends Model
{
    protected $fillable = [
        'text', 'date'
    ];
}
