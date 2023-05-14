@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">



    <body>
        
        @if(!Auth::check())
        <div class="log-sign-in">
            <a href="{{ route('register') }}">会員登録</a>
            <span><a href="{{ route('login') }}">ログイン</a></span>
        </div>
        @endif
    </body>
</html>