<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'User\HomeController@index')->name('home');
Route::get('logout', 'Auth\LoginController@logout');
Route::resource('article', 'User\ArticleController');
Route::get('article/{id}/comments', 'User\CommentController@index')->name('comments.index');
Route::post('article/{id}/comments', 'User\CommentController@store')->name('comments.store');
