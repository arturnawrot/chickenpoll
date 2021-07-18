<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\DevEnvironmentController;

Route::view('/', 'welcome');

Route::post('/poll', [PollController::class, 'store'])->name('poll.store');

Route::get('/dev/phpinfo', [DevEnvironmentController::class, 'showPhpInfo']);
