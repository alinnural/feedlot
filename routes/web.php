<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function () {
  Route::resource('feeds', 'FeedController');
});

Route::get('/formula-ransum','FormulaRansumController@index');
Route::get('/welcome', 'HomeController@home');
Route::post('/input','HomeController@input');
Route::post('/calculate','HomeController@calculate_using_minimization_class');
Route::get('feedapp','FeedAppController@index');
Route::get('/home', 'HomeController@index');
