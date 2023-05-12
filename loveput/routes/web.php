<?php
// 非ログインページ

    // WELCOMEページ
    Route::get('/', function () {
        return view('welcome');
    });

// ログインページ
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function() {


    // 新規投稿画面
    Route::get('/', 'Member\PostsController@index');
    // 投稿処理
    Route::post('posts', 'Member\PostsController@store');
});