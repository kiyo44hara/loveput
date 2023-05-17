<?php

namespace App\Models\Member;


use Illuminate\Database\Eloquent\Model;
use App\Models\Member\User;
use App\Models\Member\Love;

class Post extends Model
{
    protected $fillable = [
        'title', 'content'
    ];

    public function isLovedByUser($userId)
    {
        return $this->loves()->where('user_id', $userId)->exists();
    }

// リレーションエリア
    public function user(){
    return $this->belongsTo('App\Models\Member\User');
    }

    public function loves()
    {
        return $this->hasMany(Love::class);
    }

}
