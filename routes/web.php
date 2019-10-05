<?php

Route::view('/', 'index');

Auth::routes();

// {profile} is a username
// "me" is an exception which returns username of an authenticated user.
Route::get('profile/{profile}', 'ProfileController@show')->name('profile.show');

Route::group(['middleware' => ['permission:admin-dashboard'], 'namespace' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin-dashboard');
    Route::get('users', 'UserController@index')->name('admin.users.index');
});
