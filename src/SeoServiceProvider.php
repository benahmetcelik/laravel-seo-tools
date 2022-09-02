<?php

namespace Seo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * The policies
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     *
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'routes');
        $this->publishes([
            __DIR__ . '/../config/routes.php' => config_path('routes.php'),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/routes'),
        ]);


    }

    /**
     *
     */
    public function register()
    {
        //
    }

    /**
     * Register the Permitlication's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        //
    }


    public function provides()
    {
        //
    }

}
