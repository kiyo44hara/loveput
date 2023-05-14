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


    // 新規投稿画面
    Route::get('post/new', 'Member\PostsController@create')->name('post');
    // 投稿処理
    Route::post('posts', 'Member\PostsController@store')->name('posts.store');
    // 投稿一覧画面
    Route::get('/posts', 'Member\PostsController@index')->name('posts.index');
    // 投稿詳細画面
    Route::get('/post/{id}', 'Member\PostsController@show')->name('posts.show');
    // 投稿編集画面
    Route::get('post/{id}/edit', 'Member\PostsController@edit')->name('posts.edit');
    // 投稿更新処理
    Route::put('post/{id}', 'Member\PostsController@update')->name('posts.update');
    // 投稿削除処理
    Route::delete('/post/{id}', 'Member\PostsController@destroy')->name('posts.destroy');
});