<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>新規登録画面</title>
    </head>
    <body>
        <!-- 登録画面フォーム -->
        <form name="registform" action="/register" method="post" id="registform">
            {{ csrf_field() }}
        <!-- ニックネーム -->
            <dl>
                <dt>ニックネーム(必須)15字以下:</dt>
                <dd>
                    <input type="text" name="name" size="30">
                    <span>{{ $errors->first('name') }}</span>
                </dd>
                    
            </dl>
        <!-- メールアドレス -->
            <dl>
                <dt>メールアドレス(必須):</dt>
                <dd>
                    <input type="text" name="email" size="50">
                    <span>{{ $errors->first('email') }}</span>
                </dd>
            </dl>
        <!-- パスワード -->
            <dl>
                <dt>パスワード(必須)6～15文字</dt>
                <dd>
                    <input type="password" name="password" size="30">
                    <span>{{ $errors->first('password') }}</span>
                </dd>    
            </dl>
        <!-- パスワード(確認) -->
            <dl>
                <dt>パスワード(確認)</dt>
                <dd>
                    <input type="password" name="password_confirmation" size="30">
                    <span>{{ $errors->first('password_confirmation') }}</span>
                </dd>
            </dl>
        <!-- 送信ボタン -->
            <button type='submit' name='action' value='send'>会員登録</button>
        </form>
    </body> 
</html>
