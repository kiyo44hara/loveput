<?php 
declare(strict_types=1); 
namespace App\Http\Controllers\Member;
?>

<?php

use App\Providers\RouteServiceProvider;
use  Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;

// ログイン認証の動作
class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // emailとpasswordが認証されたら、ホーム画面に飛ぶ
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }
        // 認証に失敗したら、エラーメッセージ表示(renderのようなもの)
        return back()->withErrors([
            'message' => "メールアドレスもしくはパスワードに誤りがあります。",
        ]);
    }
}