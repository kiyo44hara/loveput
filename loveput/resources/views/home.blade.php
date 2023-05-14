<!-- トップ画面 -->
@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">


    <body>
        @if(session()->has('success'))
            <div class="alert-alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="test">いらっしゃいませ、{{ Auth::user()->name }}さん!貴方のLoveを聞かせてください!</div>
        <div class="select"><a href="{{ route('post') }}">はい!</a>
            <span><a href="{{ route('posts.index') }}">いいえ!</a></span>
        </div>
        @if(!Auth::check())
        <div class="log-sign-in">
            <a href="{{ route('register') }}">会員登録</a>
            <span><a href="{{ route('login') }}">ログイン</a></span>
        </div>
        @endif
    </body>
</html>