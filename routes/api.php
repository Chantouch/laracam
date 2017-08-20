<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::get('tag', 'API\MasterController@tag')->name('tag');
    Route::get('categories', 'API\MasterController@categories')->name('categories');
    Route::get('cat-most-used', 'API\MasterController@catMostUsed')->name('cat-most-used');
    Route::post('category', 'Ref\CategoryController@ajaxNew')->name('ajax-new');
});