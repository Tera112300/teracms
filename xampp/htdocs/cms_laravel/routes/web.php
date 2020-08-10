<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/cms-admin/post/index', 'PostController@index');


//ダッシュボード
Route::get('/cms-admin/','CmsAdminsController@index');


//記事ページ
Route::get('/cms-admin/post/','PostController@index');

Route::get('/cms-admin/post/show/{id}','PostController@show');

Route::get('/cms-admin/post/create','PostController@create');

Route::post('/cms-admin/post/upload_img','PostController@upload_img');

Route::post('/cms-admin/post/create','PostController@create_post');

Route::get('/cms-admin/post/edit/{id}','PostController@edit');

Route::post('/cms-admin/post/edit/{id}','PostController@update');

Route::delete('/cms-admin/post/delete/all','PostController@destroy_all');

Route::delete('/cms-admin/post/delete/{id}','PostController@destroy');




//ユーザーページ
Route::get('/cms-admin/user/','UserController@index');

Route::get('/cms-admin/user/edit/{id}','UserController@edit');

Route::post('/cms-admin/user/edit/{id}','UserController@update');

Route::get('/cms-admin/user/create/','UserController@create');

Route::post('/cms-admin/user/create/','UserController@create_user');

Route::delete('/cms-admin/user/delete/{id}','UserController@destroy');

//Route::post('/cms-admin/user/delete/{id}','UserController@destroy');


//設定画面
Route::get('/cms-admin/bloginfo/','BlogInfosController@index');

Route::post('/cms-admin/bloginfo/','BlogInfosController@update');



//メイン画像設定画面
Route::get('/cms-admin/bloginfo/mainimg/','MainImgsController@index');

Route::post('/cms-admin/bloginfo/mainimg/','MainImgsController@upload');


Route::post('/cms-admin/bloginfo/mainimg/tmp_file','MainImgsController@tmp_file');

//Route::delete('/cms-admin/mainimg/delete','MainImgsController@delete');

Route::post('/cms-admin/bloginfo/mainimg/delete{id}','MainImgsController@delete');


//テーマ設定画面
Route::get('/cms-admin/theme/','ThemesController@index');




//固定ページ
Route::get('/cms-admin/fixed/','FixedsController@index');

Route::get('/cms-admin/fixed/show/{id}','FixedsController@show');

Route::get('/cms-admin/fixed/create','FixedsController@create');

Route::post('/cms-admin/fixed/upload_img','FixedsController@upload_img');

Route::post('/cms-admin/fixed/create','FixedsController@create_post');

Route::get('/cms-admin/fixed/edit/{id}','FixedsController@edit');

Route::post('/cms-admin/fixed/edit/{id}','FixedsController@update');

Route::delete('/cms-admin/fixed/delete/all','FixedsController@destroy_all');

Route::delete('/cms-admin/fixed/delete/{id}','FixedsController@destroy');


//カテゴリーページ
Route::get('/cms-admin/post/category/','CategoriesController@index');

Route::post('/cms-admin/post/category','CategoriesController@create');

Route::delete('/cms-admin/post/category/delete/all','CategoriesController@destroy_all');

Route::delete('/cms-admin/post/category/delete/{id}','CategoriesController@destroy');


Route::get('/cms-admin/post/category/edit/{id}','CategoriesController@edit');

Route::post('/cms-admin/post/category/edit/{id}','CategoriesController@update');


//お問い合わせ
Route::get('/cms-admin/form/','HtmlformsController@index');

Route::get('/cms-admin/form/create','HtmlformsController@create');

Route::post('/cms-admin/form/create','HtmlformsController@create_post');

Route::get('/cms-admin/form/edit/{id}','HtmlformsController@edit');

Route::post('/cms-admin/form/edit/{id}','HtmlformsController@update');


Route::delete('/cms-admin/form/delete/all','HtmlformsController@destroy_all');

Route::delete('/cms-admin/form/delete/{id}','HtmlformsController@destroy');