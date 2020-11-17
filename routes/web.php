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
    Route::POST('profile/user', 'Admin\UserController@profileUpdate')->name('profile.store');
    Route::patch('user/password/update', 'Admin\UserController@passwordUpdate')->name('user.password.update');
    Route::get('leads', 'LeadsController@index')->name('leads.index');
    Route::post('leads/{lead}', 'LeadsController@action')->name('lead.action');
    
    Route::match(
        ['get', 'post'],
        'files/{files}/attach',
        'Admin\FilesController@attach'
    )->name('files.attach');
    Route::get('files/import/{files}', 'Admin\FilesController@import')->name('files.import');
    Route::resource('files', 'Admin\FilesController');
    
    Route::get('data/{data}/edit', 'Admin\DataController@edit')->name('data.edit');
    Route::get('data/{data}', 'Admin\DataController@show')->name('data.show');
    Route::delete('data/{data}', 'Admin\DataController@destroy')->name('data.destroy');
});
