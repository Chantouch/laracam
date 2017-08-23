<?php

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

Auth::routes();

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', 'HomeController@index')->name('dashboard');
    Route::prefix('manage')->name('manage.')->group(function () {
        Route::resource('user', 'Manage\UserController');
        Route::resource('role', 'Manage\RoleController');
        Route::resource('permission', 'Manage\PermissionController');
    });
    Route::prefix('ref')->name('ref.')->group(function () {
        Route::resource('category', 'Ref\CategoryController');
        Route::patch('category/status/{id}', 'Ref\CategoryController@updateStatus');
        Route::resource('tag', 'Ref\TagController');
        Route::resource('page', 'Ref\PageController');
    });
    Route::resource('article', 'ArticleController');
    Route::resource('advertise', 'AdvertiseController');
    Route::resource('advertise-type', 'AdvertiseTypeController');
    Route::get('draft/article', 'ArticleController@draft')->name('article.draft');
});

//-------------Blog Front Route-------------//

Route::get('/', 'Blog\HomeController@index')->name('blog.index');

Route::prefix('admin')->name('admin.')->group(function () {

});