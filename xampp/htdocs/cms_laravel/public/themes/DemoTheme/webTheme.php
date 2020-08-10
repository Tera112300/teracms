<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);
//Route::get('/cms-admin/theme/DemoTheme/','Themes\DemoTheme\ThemeController@index');

Route::get('/','Themes\DemoTheme\ThemeController@index');

Route::get('/blog/','Themes\DemoTheme\ThemeController@blog');


Route::get('/{url}','Themes\DemoTheme\ThemeController@fixed');




