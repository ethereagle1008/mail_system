<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointList extends Model
{
    //
    protected $fillable = [
        'user_id',
        'point',
        'price',
        'date',
        'month',
        'day',
        'hour',
        'pay_type',
    ];
}
