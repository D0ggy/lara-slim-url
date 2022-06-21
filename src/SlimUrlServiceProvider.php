<?php

namespace D0ggy\LaraSlimUrl;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class SlimUrlServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('slim_url.php'),
            ], 'config');

            if (! class_exists('CreateSlimUrlsTable')) {
                $this->publishes([
                    __DIR__.'/../database/migrations/create_slim_urls_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_slim_urls_table.php'),
                    // you can add any number of migrations here
                ], 'migrations');
            }
        }
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        app('router')->group([
            'prefix'     => config('slim_url.route.prefix'),
            'middleware' => config('slim_url.route.middleware'),
        ], function (Router $router) {
            $router->get('/{short_url}', function ($short_url) {
                $redirect = \D0ggy\LaraSlimUrl\Facades\SlimUrl::getOriginalUrl($short_url);

                return app('redirect')->to($redirect);
            });
        });
    }
}
