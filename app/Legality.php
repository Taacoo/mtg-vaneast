<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legality extends Model
{
    protected $fillable = [
        'format', 'legality'
    ];
}
