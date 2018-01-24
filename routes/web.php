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

Route::group(['middleware' => ['web']],function(){
    Route::get('/', [
        'uses'=> 'HomeController@beranda'
    ]);
    Route::get('/welcome', 'HomeController@home');
    Route::get('/about','HomeController@about');
    Route::get('/contact','HomeController@contact');
    Route::get('/changelog','HomeController@changelog');

    Route::get('post', 'PostController@index');
    Route::get('post/{slug}', 'PostController@showPost');
    Route::get('page/{slug}','PageController@showPage');

    Route::get('/tanya-jawab',[
        'as'=>'tanya.jawab.index',
        'uses'=>'QuestionController@index'
    ]);
    Route::get('/tanya-jawab/{id}','QuestionController@showQuestion');
    Route::get('/tanyakan','QuestionController@create');
    Route::post('/tanyakan','QuestionController@store');

    
    Route::group(['middleware'=>['auth']],function(){
        Route::resource('ransums','RansumsController');
        Route::post('ransums/print','RansumsController@print_forsum');
        Route::group(['prefix'=>'formula'],function(){
            Route::post('/input','FormulaController@input');
            Route::post('/calculate','FormulaController@calculate');
            Route::post('/store','FormulaController@store');
            Route::get('/', 'FormulaController@index');
        });

        Route::group(['prefix'=>'laktasi'],function(){
            Route::get('/', 'FormulaController@laktasi');
            Route::post('/calculate','FormulaController@calc_laktasi');
        });

        Route::group(['prefix'=>'simulasi'],function(){
            Route::get('/','SimulasiController@simulasiIndex');
            Route::post('/input','SimulasiController@simulasiInput');
            Route::post('/calculate','SimulasiController@simulasiCalculate');
            Route::get('/simplex','SimulasiController@simulasiSimplexMethod');
        });
    });
    
    Route::get('/feeds/group/{id}',[
        'as' =>'feeds.group_by_id',
        'uses' =>'HomeController@groupFeeds'
    ]);
    Route::get('/feeds/explore/all',[
        'as' => 'feeds.explore',
        'uses' => 'HomeController@explore'
    ]);
    Route::get('feeds/detail/{id}',[
        'as' => 'feeds.details',
        'uses' => 'HomeController@showFeed'
    ]);

    Route::get('/settings/profile','Admin\MemberController@Profile');
    
    Route::group(['middleware'=>['auth','role:admin']],function(){
        Route::group(['prefix'=>'admin'],function(){
            Route::get('/','Admin\HomeController@index');
            Route::get('changelog','Admin\HomeController@changelog');
            Route::resource('post', 'Admin\PostController');
            Route::resource('page','Admin\PageController');
            Route::resource('menu','Admin\MenuController');
            Route::resource('social','Admin\SocialController');
            Route::resource('member','Admin\MemberController');
            Route::resource('slider','Admin\SliderController');
            Route::resource('setting','Admin\SettingController');
            Route::resource('album','Admin\AlbumController');
            Route::resource('file','Admin\FileController');
    
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
        Route::get('/feednutriets/{id}/create',[
            'as' => 'feednutrients.create_id',
            'uses' => 'FeedNutrientsController@create'
        ]);
        Route::resource('requirementnutrients','RequirementNutrientsController');
        Route::get('/requirementnutriets/{id}/create',[
            'as' => 'requirementnutrients.create_id',
            'uses' => 'RequirementNutrientsController@create'
        ]);

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

Auth::routes();

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
    Route::get('formula/calcquantity', [
        'as'   => 'ajax.calcquantity',
        'uses' => 'FormulaController@AjaxCalcQ'
    ]);
    Route::get('formula/calclaktasi', [
        'as'   => 'ajax.calclaktasi',
        'uses' => 'FormulaController@AjaxCalcLaktasi'
    ]);
    Route::get('ransum/calcquantity', [
        'as'   => 'ajax.ransumcalcquantity',
        'uses' => 'RansumsController@AjaxCalcQ'
    ]);
});