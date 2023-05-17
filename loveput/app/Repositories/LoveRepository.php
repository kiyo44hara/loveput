<?php
namespace App\Repositories;

use App\Models\Member\Love;

class LoveRepository
{
    public function create($userId, $postId)
    {
        // いいね作成
        Love::create([
            'user_id' => $userId,
            'post_id' => $postId,
        ]);
    }

    public function delete($userId, $postId)
    {
        // いいね取り消し
        Love::where('user_id', $userId)
            ->where('post_id', $postId)
            ->delete();
    }

    public function exists($userId, $postId)
    {
        // いいねが存在するかチェック ビューページの表示に影響。1人につき一個のいいねを実現
        return Love::where('user_id', $userId)
                    ->where('post_id', $postId)
                    ->exists();
    }

    // いいねカウント取得
    public function getLoveCount($postId)
    {
        return Love::where('post_id', $postId)->count();
    }
}