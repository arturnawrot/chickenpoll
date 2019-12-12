<?php

Route::view('/', 'index');

Auth::routes();

// {profile} is an username
// "me" is an exception which returns username of the current authenticated user.
Route::get('profile/{profile}', 'ProfileController@show')->name('profile.show');

Route::group(['middleware' => ['permission:admin-dashboard'], 'namespace' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin-dashboard');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('admin.users.index');
        Route::get('/{id}', 'UserController@edit')->name('admin.users.edit');
        Route::post('/{id}', 'UserController@update')->name('admin.users.update');
    });
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index')->name('admin.roles.index');
        Route::get('/{id}', 'RoleController@edit')->name('admin.roles.edit');
        Route::post('/', 'RoleController@store')->name('admin.roles.store');
        Route::patch('/{id}', 'RoleController@update')->name('admin.roles.update');
        Route::delete('/{id}', 'RoleController@destroy')->name('admin.roles.destroy');
    });
});

Route::post('/add', 'PollController@store')->name('polls.store');
Route::get('/{id}', 'PollController@show')->name('polls.show');

Route::get('/test', function () {
    // broadcast(new App\Events\test);
});