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
    Route::resource('media-library', 'Admin\MediaLibraryController');
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