<?php 
declare(strict_types=1); 
namespace App\Http\Controllers;
?>

<?php


// 使用者（モデル）指定
use App\Models\User;
// POSTやGET等、パラメータを取得する為に必要
use Illuminate\Http\Request;
// パスワード等のハッシュ化や検証
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

// Controllerを継承している
class RegisterController extends Controller
{
// ユーザー登録フォームを表示する
    public function create()
    {
    // 指定したビューを表示するように指示
        return view('regist.register');
    }
            
    // 新規会員登録の情報を受け取って実行する
        public function store(Request $request)
    {
    // バリデーション。requiredで空を禁止
    // name,emailは重複禁止
    $request->validate([
        'name' => 'required|string|max:16|unique:users',
        'email' => 'required|string|email|max:101|unique:users',
        'password' => 'required|string|confirmed|min:6|max:16|',
    ]);
    // ユーザーの各情報を取得してUserモデルに保存
    // パスワードはハッシュ化され、安全面サポート
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    // 登録完了後に表示するビュー
        return view('regist.complete', compact('user'));
    }
}