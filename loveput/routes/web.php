<?php
// 非ログインページ

    // WELCOMEページ
    Route::get('/', function () {
        return view('welcome');
    });

    // // トップページ
    // Route::get('/home', function() {
    //     return view('home');
    // });

//     // 新規登録画面
//     Route::get('/register',  [App\Http\Controllers\Member\RegisterController::class, 'create'])
//         ->middleware('guest')
//         ->name('register');
//     Route::post('/register', [App\Http\Controllers\Member\RegisterController::class, 'store'])
//         ->middleware('guest');

//     // ログイン画面
//     Route::get('/login', [App\Http\Controllers\Member\LoginController::class, 'index'])
//         ->middleware('guest')
//         ->name('login');
//     Route::post('/login', [App\Http\Controllers\Member\LoginController::class, 'authenticate'])
//         ->middleware('guest');

// // ログインページ

//     // ログアウト機能
//     Route::get('/logout', [App\Http\Controllers\Member\LoginController::class, 'logout'])
//         ->middleware('auth')
//         ->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
