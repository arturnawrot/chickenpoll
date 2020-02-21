<?php
Route::view('/', 'index')->name('index');

Auth::routes();

// Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
// Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/flowers', 'RedirectController@index')->name('redirect.index');

Route::get('/posts', 'BlogController@index')->name('blog.index');
Route::get('/blog/{slug}', 'BlogController@show')->name('blog.show');

//Route::view('/polls', 'list')->name('polls');


// {profile} is an username.
// "me" is an exception which returns username of the current authenticated user.
Route::get('profile/{profile}', 'ProfileController@show')->name('profile.show');

Route::group(['middleware' => ['permission:admin-dashboard'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin-dashboard');

    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')
    ->middleware('permission:logs');

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

    Route::group(['prefix' => 'poll'], function () {
        Route::get('/', 'PollController@index')->name('admin.polls.index');
        Route::get('/{id}', 'PollController@edit')->name('admin.polls.edit');
        Route::patch('/{id}', 'PollController@update')->name('admin.polls.update');
        Route::delete('/{id}', 'PollController@destroy')->name('admin.polls.destroy');
    });

    Route::group(['prefix' => 'report'], function () {
        Route::get('/', 'ReportController@index')->name('admin.reports.index');
        Route::get('/{id}', 'ReportController@show')->name('admin.reports.show');
        Route::delete('/', 'ReportController@destroy')->name('admin.reports.destroy');
    });

    Route::group(['prefix' => 'option'], function () {
        Route::post('/{pollId}', 'OptionController@store')->name('admin.options.store');
        Route::delete('/', 'OptionController@destroy')->name('admin.reports.destroy');
    });

    Route::group(['prefix' => 'Response'], function () {
        Route::post('/', 'ResponseController@store')->name('admin.Responses.store');
    });

    Route::group(['prefix' => 'visitor'], function () {
        Route::get('/', 'VisitorController@index')->name('admin.visitors.index');
    });
});

Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/sitemaps/posts.xml', 'SitemapController@showPosts')->name('sitemaps.posts');
Route::get('/sitemaps/{id}.xml', 'SitemapController@showPolls')->name('sitemaps.polls');

Route::view('/contact', 'contact')->name('contact');

Route::get('/report/{id}', 'ReportController@index')->name('report.index');
Route::post('/report/{id}', 'ReportController@store')->name('report.store');

Route::post('/add', 'PollController@store')->name('polls.store');
Route::get('/{id}', 'PollController@show')->name('polls.show');

Route::post('/vote', 'ResponseController@store')->name('Responses.store');
Route::get('/{slug}/r', 'PollController@showResults')->name('results.show');

