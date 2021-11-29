<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdCode extends Model
{
    //
    protected $fillable = [
        'id',
        'code',
        'media_type'
    ];
}
