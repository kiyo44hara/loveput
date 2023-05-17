<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;

    // ユーザーの情報をuserReoisutiryに格納する。
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }



    // マイページ
    public function show($id)
    {
        // userRepositoryを介してuser_idを取得
        $user = $this->userRepository->getById($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(12);
        return view('Member/user_show', compact('user', 'posts'));
    }
}
