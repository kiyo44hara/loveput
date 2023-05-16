<?php
// 非ログインページ

    // WELCOMEページ
    Route::get('/', function () {
        return view('welcome');
    });

// ログインページ
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function() {

    // マイページ
    Route::get('/user/{id}', 'Member\UserController@show')->name('user.show')->middleware('auth');


    // 新規投稿画面
    Route::get('post/new', 'Member\PostController@create')->name('post');
    // 投稿処理
    Route::post('posts', 'Member\PostController@store')->name('posts.store');
    // 投稿一覧画面
    Route::get('/posts', 'Member\PostController@index')->name('posts.index');
    // 投稿詳細画面
    Route::get('/post/{id}', 'Member\PostController@show')->name('posts.show');
    // 投稿編集画面
    Route::get('post/{id}/edit', 'Member\PostController@edit')->name('posts.edit');
    // 投稿更新処理
    Route::put('post/{id}', 'Member\PostController@update')->name('posts.update');
    // 投稿削除処理
    Route::delete('/post/{id}', 'Member\PostController@destroy')->name('posts.destroy');
});