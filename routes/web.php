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

Route::group(['middleware' => ['web','menu']],function(){
    Route::get('/', [
        'uses'=> 'HomeController@beranda'
    ]);
    Route::get('/welcome', 'HomeController@home');
    Route::get('/about','HomeController@about');
    Route::get('/contact','HomeController@contact');
    Route::get('/changelog','HomeController@changelog');

    Route::group(['prefix'=>'formula'],function(){
        Route::post('/input','HomeController@input');
        Route::get('/price','HomeController@price');
        Route::post('/calculate','HomeController@calculate');
        Route::get('/', 'HomeController@index');
    });

    Route::get('post', 'PostController@index');
    Route::get('post/{slug}', 'PostController@showPost');
    Route::get('page/{slug}','PageController@showPage');
    Route::group(['prefix'=>'gallery'],function(){
        Route::get('/','GalleryController@showAlbum');
        Route::get('detail/{id}','GalleryController@showImage');
    });
});

Auth::routes();

Route::group(['prefix'=>'sample'],function(){
    Route::get('/','HomeController@SampleIndex');
    Route::post('/input','HomeController@sampleInput');
    Route::post('/calculate','HomeController@sampleCalculate');
    Route::get('/simplex','HomeController@sampleSimplexMethod');
});

Route::group(['prefix'=>'ajax'],function(){
    Route::get('requirements/search', 'RequirementsController@AjaxSearch');
    Route::get('requirements/find', [
            'as'   => 'ajax.find',
            'uses' => 'RequirementsController@AjaxFind'
        ]);
    Route::get('feeds/find', [
            'as'   => 'ajax.feed_find',
            'uses' => 'FeedsController@AjaxFind'
        ]);
    Route::get('feeds/search','FeedsController@AjaxSearch');
});

Route::group(['middleware'=>'web'],function(){
    Route::get('/settings/profile','Admin\MemberController@Profile');
    Route::group(['middleware'=>['auth','role:admin']],function(){
        Route::group(['prefix'=>'admin'],function(){
            Route::get('/','Admin\HomeController@index');
            Route::get('changelog','Admin\HomeController@changelog');
            Route::resource('post', 'Admin\PostController');
            Route::resource('tag', 'Admin\TagController');
            Route::resource('page','Admin\PageController');
            Route::resource('menu','Admin\MenuController');
            Route::resource('social','Admin\SocialController');
            Route::resource('member','Admin\MemberController');
            Route::resource('slider','Admin\SliderController');
            Route::resource('setting','Admin\SettingController');
            Route::resource('album','Admin\AlbumController');
            Route::get('upload', 'Admin\UploadController@index');
    
            Route::resource('image','Admin\ImageController');
            Route::put('/image/{image}/move', array('as' => 'image.move', 'uses' => 'Admin\ImageController@move'));
    
            Route::group(['prefix'=>'ajax'],function(){
                // Route::get('getVisitorAndViews','Admin\HomeController@AjaxGetVisitorAndViews');
            });
        });

        Route::resource('groupfeeds','GroupFeedsController');
        Route::resource('feeds','FeedsController');
        Route::resource('requirements','RequirementsController');
        Route::resource('units','UnitsController');
        Route::resource('nutrients','NutrientsController');
        Route::resource('feednutrients','FeedNutrientsController');

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