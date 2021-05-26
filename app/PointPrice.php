<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointPrice extends Model
{
    //
    protected $fillable = [
        'point',
        'price',
    ];
}
