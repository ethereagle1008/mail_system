<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'character_id',
        'user_id',
        'content',
        'type',
        'reply',
        'status',
        'receive_date',
        'image_url'
    ];
}
