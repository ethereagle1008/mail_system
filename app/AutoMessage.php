<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoMessage extends Model
{
    //
    protected $fillable = [
        'type',
        'send_time',
        'content',
        'image',
        'character_id',
        'box',
        'unique_id',
        'gender',
        'user_name',
        'start_age',
        'end_age',
        'start_count',
        'end_count',
        'start_point',
        'end_point',
        'start_price',
        'end_price',
        'start_login',
        'end_login',
        'start_money',
        'end_money',
        'status'
    ];
}
