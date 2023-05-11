<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>登録完了画面</title>
    </head>
    <body>
        <p>
            ようこそ、{{ $user->name }}さん！
        </p>

        <p>loveputで貴方の好きを沢山伝えて下さい！</p>
    </body>
</html>