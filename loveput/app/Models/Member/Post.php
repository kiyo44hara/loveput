<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content'
    ];

// リレーションエリア
    public function user(){
    return $this->belongsTo('App\Models\User');
    }

    public function images(){
        return $this->hasMany('App\Models\Image');
    }

}
