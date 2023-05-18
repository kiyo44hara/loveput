<?php
namespace App\Repositories;

use App\Models\Member\User;

class UserRepository {

    // 特定のユーザーのIDを取り出してくる。
    // 例外処理つき
    public function getById($id) {
        return User::findOrFail($id);
    }

    // ユーザーのレコードを全て取得
    public function getAll() {
        return User::all();
    }
}
