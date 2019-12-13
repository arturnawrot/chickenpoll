<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $models = array(
            'User',
            'Profile',
            'Role',
            'Permission',
            'Poll',
            'Option',
            'Answer'
        );

        foreach ($models as $model) {
            $this->app->bind("App\Repositories\Contracts\\{$model}RepositoryInterface", "App\Repositories\Eloquent\\{$model}Repository");
        }
    }
}
