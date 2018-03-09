<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index');

Route::resource('articles', 'ArticlesController');
// DB::listen(function ($query){
// 	var_dump($query->sql);
// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Event::listen('article.created', function ($article) {
// 	var_dump('이벤트를 던졌습니다. 받은 데이터(상태)입니다.');
// 	var_dump($article->toArray());
// });
