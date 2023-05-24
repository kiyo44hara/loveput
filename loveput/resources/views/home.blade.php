<!-- トップ画面 -->
@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">


    <body>
    @if(session()->has('success'))
            <div class="alert-alert-success">
                {{ session('success') }}
            </div>
    @endif
        <div class="top-coll">いらっしゃいませ、{{ Auth::user()->name }}さん!貴方のLoveを聞かせてください!</div>
        <div class="select"><a href="{{ route('post') }}">はい!</a> <!-- 新規投稿画面 -->
            <span><a href="{{ route('posts.index') }}">いいえ!</a></span><!-- 投稿一覧画面 -->
        </div>
    </body>