<?php
namespace Dsu\Providers;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;

use Dsu\Middlewares\Dsuify;
use Dsu\Facades\Facade\Dsu;

class DsuServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    
    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(dirname(__DIR__).'/Views', 'DsuView');
        
        $this->loadTranslationsFrom(dirname(__DIR__).'/Langs', 'DsuLang');
        
        $this->publishes([
           dirname(__DIR__).DS.'Views' => resource_path('views/vendor/DsuView'),
        ]);

        $this->publishes([
            dirname(__DIR__).DS.'Config' => config_path()
        ], 'DsuConfig');

        $router->pushMiddlewareToGroup("web", Dsuify::class);

        //register application routes
        \App::register(RouteServiceProvider::class);
        

        //register event subscriber for application with it's namespaces
     
        \Event::subscribe(\Dsu\Subscribers\Client\Client::class);
        // \Event::subscribe(\Dsu\Subscribers\Admin\Admin::class);
       
    }

    public function register()
    {
        $this->loadHelpers();
        $this->loadWidgetCallback();

    	\App::bind('Dsu', function()
        {
            return new Dsu;
        });       
    }

    protected function loadHelpers()
    {
        foreach (glob(dirname(__DIR__).'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    protected function loadWidgetCallback()
    {
        foreach (glob(dirname(__DIR__).'/Widget_Callbacks/*.php') as $filename) {
            require_once $filename;
        }
    }
}
