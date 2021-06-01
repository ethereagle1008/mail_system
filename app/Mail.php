<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    //
    protected $fillable = [
        'user_id',
        'question_id',
        'content',
        'send_time',
        'status',
    ];
}
