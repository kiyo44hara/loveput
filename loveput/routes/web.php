<?php
    // ログインページ
    Auth::routes();

    Route::get('/', 'HomeController@index')->name('home');

    Route::middleware(['auth'])->group(function() {

    // マイページ
    Route::get('/user/{id}', 'Member\UserController@show')->name('user.show')->middleware('auth');

    Route::prefix('posts')->group(function() {

        // 新規投稿画面
        Route::get('new', 'Member\PostController@create')->name('post');
        // 投稿処理
        Route::post('/', 'Member\PostController@store')->name('posts.store');
        // 投稿一覧画面
        Route::get('/', 'Member\PostController@index')->name('posts.index');
        // 投稿詳細画面
        Route::get('{id}', 'Member\PostController@show')->name('posts.show');
        // 投稿編集画面
        Route::get('{id}/edit', 'Member\PostController@edit')->name('posts.edit');
        // 投稿更新処理
        Route::put('{id}', 'Member\PostController@update')->name('posts.update');
        // 投稿削除処理
        Route::delete('{id}', 'Member\PostController@destroy')->name('posts.destroy');

        // いいね機能
        Route::post('{post}/love', 'Member\LoveController@store')->name('posts.love');
        Route::delete('{post}/love', 'Member\LoveController@destroy')->name('posts.unlove');

    });
});


// テスト