<?php namespace Codingo\Dropzoner;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class DropzonerServiceProvider extends ServiceProvider
{

    protected $defer = false;

    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__.'/../views'), 'dropzoner');
        $this->setupRoutes($this->app->router);

        $this->publishes([__DIR__.'/config/dropzoner.php' => config_path('dropzoner.php')]);
        $this->publishes([__DIR__.'/../assets' => public_path('vendor/dropzoner')], 'public');
    }

    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Codingo\Dropzoner\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }

    public function register()
    {
        $this->registerDropzoner();
        config(['config/dropzoner.php']);
    }

    public function registerDropzoner()
    {
        $this->app->bind('dropzoner', function($app){
            return new Dropzoner($app);
        });
    }
}