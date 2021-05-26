<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdRegisterTime extends Model
{
    //
    protected $fillable = [
        'ad_code',
        'user_id',
        'register_time',
    ];
}
