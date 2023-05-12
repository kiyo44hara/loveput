<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
// リレーションエリア
    public function user(){
    return $this->hasmany('App\Models\Post');
    }
}
