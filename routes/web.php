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

Route::group(['middleware'=>'web'],function(){
    Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']],function(){
        Route::resource('groupfeeds','GroupFeedsController');
        Route::resource('feeds','FeedsController');
        Route::resource('requirements','RequirementsController');

        Route::get('template/feeds', [
            'as'   => 'template.feeds',
            'uses' => 'FeedsController@generateExcelTemplate'
        ]);
        Route::post('import/feeds', [
            'as'   => 'import.feeds',
            'uses' => 'FeedsController@importExcel'
        ]);

        Route::get('template/requirements',[
            'as' => 'template.requirements',
            'uses' => 'RequirementsController@generateExcelTemplate'
        ]);
        Route::post('import/requirements',[
            'as' => 'import.requirements',
            'uses' =>'RequirementsController@importExcel'
        ]);
    });
});

Route::get('/welcome', 'HomeController@home');
Route::post('/input','HomeController@input');
Route::post('/calculate','HomeController@calculate_using_minimization_class');
Route::get('/home', 'HomeController@index');
