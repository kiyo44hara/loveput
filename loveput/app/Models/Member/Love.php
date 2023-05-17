<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;
use App\Models\Member\User;
use App\Models\Member\Post;

class Love extends Model
{

    protected $table = 'loves';

    protected $fillable = [
        'user_id', 'post_id'
    ];

    
    public function getLoveCountAttribute()
    {
        return $this->loves()->count();
    }


    // リレーションエリア
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
