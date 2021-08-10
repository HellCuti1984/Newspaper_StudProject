<?php

use App\NewsComments;

//Аутентификация
Auth::routes();
Route::get('logout','Auth\LoginController@logout')->name('logout');

//Поисковая строка
Route::post('/search', 'SearchController@search')->name('search');

//Главная страница
Route::get('/', 'MainPageController@template')->name('mainpage');

//Профильная страница
Route::get('/home', 'HomeController@index')->name('home');//Переход на профильную таблицу
Route::post('/home/changeavatar/{id}', 'HomeController@changeProfileData')->name('changeProfileData');//Изменить аватар

//Только авторизованные пользователи
Route::group(['middleware' => ['auth']], function () {
	//Управление новостями -> Все пользователи
	Route::get('/home/newscreate', 'NewsController@index')->name('news.newscreate');
	Route::post('/home/newscreate/save', 'NewsController@newsCreate')->name('news.newscreate.save');
	Route::get('/home/mynews', 'NewsController@myNews')->name('news.mynews');
	Route::get('/home/newsedit/{id}', 'NewsController@newsEdit')->name('news.newsedit');
	Route::post('/home/newsedit/{id}/save', 'NewsController@newsEditSave')->name('news.newsedit.save');
	Route::get('/home/newspublish/{id}', 'NewsController@newsPublish')->name('news.newspublish');
	Route::get('/home/newsnonpublish/{id}', 'NewsController@newsNonPublish')->name('news.newsnonpublish');
	Route::get('/home/newsdelete/{id}', 'NewsController@newsDelete')->name('news.newsdelete');
});

Route::group(['middleware' => ['auth', 'admin']], function() {
	//Управление новостями -> Администраторы
	Route::get('/home/admin/createadmin', 'AdminController@indexCreateAdmin')->name('admin.createadmin');
	Route::post('/home/admin/createadmin/save', 'AdminController@createAdmin')->name('admin.createadmin.save');
	Route::get('/home/admin/createevent', 'EventsController@indexCreateEvent')->name('admin.createevent');
	Route::post('/home/admin/createevent/save', 'EventsController@createEvent')->name('admin.createevent.save');
});

//Страница новости
Route::get('/news/all', 'NewsController@allNewsList')->name('news.all.newsList');
Route::get('/news/admin', 'NewsController@adminNewsList')->name('news.admin.newslist');
Route::get('/news/stud', 'NewsController@studNewsList')->name('news.stud.newsList');
Route::get('/news/{id}', 'NewsController@detailNews')->name('news.indetail');
Route::post('/news/comment/{id}', 'NewsController@makeComment')->middleware('auth')->name('news.makecomment');