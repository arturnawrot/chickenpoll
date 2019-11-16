<?php

Route::view('/', 'index');

Auth::routes();

// {profile} is an username
// "me" is an exception which returns username of the current authenticated user.
Route::get('profile/{profile}', 'ProfileController@show')->name('profile.show');

Route::group(['middleware' => ['permission:admin-dashboard'], 'namespace' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin-dashboard');

    Route::get('users', 'UserController@index')->name('admin.users.index');
    Route::get('user/{id}', 'UserController@edit')->name('admin.users.edit');

    Route::get('roles', 'RoleController@index')->name('admin.roles.index');
    Route::get('role/{id}', 'RoleController@edit')->name('admin.roles.edit');
    Route::post('role/', 'RoleController@store')->name('admin.roles.store');
});
