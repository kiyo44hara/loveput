<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- レイアウト -->
        <style>
            body {
                background-image: url("/images/loveput背景.jpg");
                background-size: contain;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
            }

            .log-sign-in {
                background-color: rgba(255,0,103,0.20);
                color: white;
                padding: 20px;
                border-radius: 15px;
                position: absolute;
                transform: translate(-50%, -50%);
                bottom: 1vh;
                right: -10vh;
                font-size: 20px;
            }

            .log-sign-in span {
                margin-left: 10px;
            }

            
        </style>
    </head>
    <body>
        @if(!Auth::check())
        <div class="log-sign-in">
            <a href="{{ route('register') }}">会員登録</a>
            <span><a href="{{ route('login') }}">ログイン</a></span>
        </div>
        @endif

    </body>
</html>
