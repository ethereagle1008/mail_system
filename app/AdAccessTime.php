<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdAccessTime extends Model
{
    //
    protected $fillable = [
        'ad_code',
        'user_id',
        'access_time',
        'type'
    ];
}
