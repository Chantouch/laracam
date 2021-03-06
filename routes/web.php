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

Route::get('media/news/{id}/{filename}', function ($id, $filename) {
    $path = storage_path('app/public/uploads/posts/' . $id . '/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('media.posts.path');

Auth::routes();

Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('auth')->group(function () {
    Route::get('dashboard', 'HomeController@index')->name('dashboard');
    Route::prefix('manage')->name('manage.')->namespace('Manage')->group(function () {
        Route::resource('user', 'UserController');
        Route::resource('role', 'RoleController');
        Route::resource('permission', 'PermissionController');
    });
    Route::prefix('ref')->name('ref.')->namespace('Ref')->group(function () {
        Route::resource('category', 'CategoryController');
        Route::patch('category/status/{id}', 'CategoryController@updateStatus');
        Route::resource('tag', 'TagController');
        Route::resource('page', 'PageController');
    });
    Route::resource('article', 'ArticleController');
    Route::resource('advertise', 'AdvertiseController');
    Route::resource('advertise-type', 'AdvertiseTypeController');
    Route::resource('media-library', 'MediaLibraryController');
    Route::get('draft/article', 'ArticleController@draft')->name('article.draft');
});

//-------------Blog Front Route-------------//
Route::name('blog.')->namespace('Blog')->group(function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/files/{filename}', 'MediaController@getFile')->name('files');
    Route::get('/media/{filename}', 'MediaController@getFiles')->name('media');
    Route::resource('article', 'PostsController', ['only' => 'show']);
    Route::resource('topics', 'CategoryController', ['only' => 'show']);
});
Route::get('/insert-db', 'HomeController@insertPostCategory');