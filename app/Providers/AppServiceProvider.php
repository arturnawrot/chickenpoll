<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rules\ContentFilter;
use App\Services\SpamDetector;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
