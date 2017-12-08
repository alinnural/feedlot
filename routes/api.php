<?php

use Illuminate\Http\Request;
Use App\Forsum;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Route::resource('api/feed','FeedController');

Route::get('ransums', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Forsum::all();
});
 
Route::get('ransums/{id}', function($id) {
    return Forsum::find($id);
});

Route::delete('ransums/{id}', function($id) {
    Forsum::find($id)->delete();

    return 204;
});