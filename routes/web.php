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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', 'HomeController@index')->name('dashboard');
    Route::prefix('manage')->name('manage.')->group(function () {
        Route::resource('user', 'Manage\UserController');
        Route::resource('role', 'Manage\RoleController');
        Route::resource('permission', 'Manage\PermissionController');
    });
});