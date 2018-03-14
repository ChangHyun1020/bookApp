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

/* 언어 선택 */
Route::get('locale', [
    'as' => 'locale',
    'uses' => 'WelcomeController@locale',
]);

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

Route::get('/mail', function () {
	$article = App\Article::with('user')->find(1);
	return Mail::send(
		'emails.articles.created',
		compact('article'),
		function($message) use ($article) {
			$message->to('ckdgus941020@naver.com'); //받는 사람의 주소
			$message->subject('Create New Article -'. $article->title);
		}
	);
});

Route::get('docs/{file?}', 'DocsController@show');
Route::get('docs/images/{image}', 'DocsController@image')->where('image', '[\pL-\pN\._-]+-img-[0-9]{2}.png');