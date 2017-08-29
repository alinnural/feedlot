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

Route::get('/', [
    'uses'=> 'HomeController@beranda'
]);

Auth::routes();

Route::get('/welcome', 'HomeController@home');
Route::get('/about','HomeController@about');
Route::get('/contact','HomeController@contact');
Route::get('/changelog','HomeController@changelog');

Route::group(['prefix'=>'sample'],function(){
    Route::get('/','HomeController@SampleIndex');
    Route::post('/input','HomeController@sampleInput');
    Route::post('/calculate','HomeController@sampleCalculate');
    Route::get('/simplex','HomeController@sampleSimplexMethod');
});

Route::group(['prefix'=>'formula'],function(){
    Route::get('/input','HomeController@input');
    Route::get('/price','HomeController@price');
    Route::post('/calculate','HomeController@calculate_using_minimization_class');
    Route::get('/', 'HomeController@index');
});

Route::group(['prefix'=>'ajax'],function(){
    Route::get('requirements/search', 'RequirementsController@AjaxSearch');
    Route::get('requirements/find','RequirementsController@AjaxFind');
    Route::get('feeds/search','FeedsController@AjaxSearch');
});

Route::group(['middleware'=>'web'],function(){
    Route::group(['middleware'=>['auth','role:admin']],function(){
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