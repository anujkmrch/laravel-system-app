<?php
namespace Order\Providers;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;

use Order\Middlewares\Orderify;
use Order\Facades\Facade\Ordering;

class OrderServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    
    public function boot(Router $router, Dispatcher $event)
    {
        $this->loadViewsFrom(dirname(__DIR__).'/Views', 'OrderView');
        
        $this->loadTranslationsFrom(dirname(__DIR__).'/Langs', 'OrderLang');
        
        $this->publishes([
           dirname(__DIR__).DS.'Views' => resource_path('views/vendor/OrderView'),
        ]);

        $this->publishes([
            dirname(__DIR__).DS.'Config' => config_path()
        ], 'OrderConfig');

        $router->pushMiddlewareToGroup("web", Orderify::class);

        //register application routes
        \App::register(RouteServiceProvider::class);

        //register event subscriber for application with it's namespaces
     
        \Event::subscribe(\Order\Subscribers\Client\Client::class);
        // \Event::subscribe(\Order\Subscribers\Admin\Admin::class);
       
    }

    public function register()
    {
        $this->loadHelpers();
        $this->loadWidgetCallback();

    	\App::bind('Ordering', function()
        {
            return new Ordering;
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
