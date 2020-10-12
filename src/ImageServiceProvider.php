<?php

namespace Dzorogh\OptimizedImage;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'optimizedimage');
    }

    public function boot()
    {
        $this->registerRoutes();
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'optimizedimage');
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('optimizedimage.route_prefix'),
            'middleware' => ['web']
        ];
    }
}