<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{

	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(

            'App\Contracts\CategoryInterface',
            'App\Repositories\CategoryRepository'

            );

        $this->app->bind(

            'App\Contracts\ImageInterface',
            'App\Repositories\ImageRepository'

            );

        $this->app->bind(

            'App\Contracts\ProjectInterface',
            'App\Repositories\ProjectRepository'

            );
    }

}