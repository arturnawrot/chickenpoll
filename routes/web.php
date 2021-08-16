<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\DevEnvironmentController;
use App\Http\Middleware\DevMiddleware;

Route::view('/', 'welcome');

Route::post('/poll', [PollController::class, 'store'])->name('poll.store');

Route::middleware([DevMiddleware::class])->group(function () {
    Route::get('/dev/phpinfo', [DevEnvironmentController::class, 'showPhpInfo'])->name('dev.phpinfo');
});