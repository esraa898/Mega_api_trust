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
      $this->app->bind(

        'App\Http\Interfaces\JWTInterface',
        'App\Http\Repositories\JWTRepository'
      );
      $this->app->bind(

        'App\Http\Interfaces\TasksInterface',
        'App\Http\Repositories\TasksRepository'
      );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
