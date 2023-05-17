<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Repositories\LoveRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LoveController extends Controller
{
    protected $loveRepository;

    // いいねの情報をloveReoisutiryに格納する。
    public function __construct(LoveRepository $loveRepository)
    {
        $this->loveRepository = $loveRepository;
    }

    public function store(Request $request, $postId)
    {
        $userId = auth()->user()->id;

        // いいね済みの場合は削除処理
        if ($this->loveRepository->exists($userId, $postId)) {
            $this->loveRepository->delete($userId, $postId);
            $response = [
                'status' => 'unloved',
            ];
            // いいね処理
        } else {
            $this->loveRepository->create($userId, $postId);
            $response = [
                'status' => 'loved',
            ];
        }
        // 非同期通信を可能にするために、json形式でレスポンスを返す
        return response()->json($response);
    }
    // 投稿に紐づいたいいね数を呼び出す
    public function getLoveCount($postId)
    {
    $loveCount = $this->loveRepository->getLoveCount($postId);
    }
}