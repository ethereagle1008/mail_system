<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'unique_id',
        'box_id',
        'name',
        'gender',
        'birth',
        'image',
        'description',
        'ranking',
        'decreasing_point'
    ];

    public function user(){
        $this->belongsTo(User::class,'user_id')->select('id','name','email');
    }
}
