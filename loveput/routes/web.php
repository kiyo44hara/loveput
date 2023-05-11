<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function() {
    return view('home');
});
// namespace user;