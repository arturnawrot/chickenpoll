<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\Observers\UserObserver;
use App\Models\User;
use Arturek1\Screenshot\Screenshot;
use App\Jobs\GenerateThumbnail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Run Telescope only one the local environment
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->bind(Screenshot::Class, function() {
            return new Screenshot(config('google.api_key'));
        });

        $this->app->bindMethod(GenerateThumbnail::class.'@handle', function ($job, $app) {
            return $job->handle($app->make(Screenshot::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // https://laravel-news.com/laravel-5-4-key-too-long-error
        Schema::defaultStringLength(191);

        User::observe(UserObserver::class);

        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
    }
}
