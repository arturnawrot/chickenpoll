<?php

Route::view('/', 'index');

Auth::routes();

Route::get('profile/{profile}', 'ProfileController@index')->name('profile.index');

Route::group(['middleware' => ['permission:admin-dashboard'], 'namespace' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin-dashboard');
    Route::resource('roles', 'RoleController');
});