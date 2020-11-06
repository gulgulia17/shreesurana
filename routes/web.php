<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'IfAllowed']], function () {
    Route::post('permission/give', 'Admin\PermissionController@give')->name('permission.give');
    Route::resource('permission', 'Admin\PermissionController');
    Route::resource('role', 'Admin\RoleController');
    Route::post('user/new', 'Admin\UserController@new')->name('user.new');
    Route::resource('user', 'Admin\UserController');
    Route::GET('profile/user', 'Admin\UserController@profile')->name('profile.index');
    Route::POST('profile/user', 'Admin\UserController@profileStore')->name('profile.store');
});
