<?php

namespace System\Middlewares;

use Closure;
use System;
use Client;
use SEO;
class SystemGuestUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        SEO::setTitle("Welcome to our website");
        if(!System::checkUserObject()){
            System::loginGuestUser();
        }

        System::_initialize();
        Client::_initialize();
        if (!\Auth::guest() and !System::isGuestCreated()) {
            $menu=["title"=>"Dashboard","slug"=>"profile","ordering"=> 0,];
            Client::add_menu($menu,'default');

            $menu=["title"=>"Account details","slug"=>"account","ordering"=> 19,];
            Client::add_menu($menu,'default');

            $menu=["title"=> "Logout","slug"=>route('auth.logout'),"ordering"=> 20,];
            Client::add_menu($menu,'default');

        }
        // System::current_slug($request->path());
        return $next($request);
    }
}
