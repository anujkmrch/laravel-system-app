<?php

namespace Order\Middlewares;

use Closure;
use Admin,System, Auth,Client;
use Order\Classes\OrderConfig;

class Orderify
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
        
        if (!Auth::guest() and !System::isGuestCreated()) {
            if (!\Auth::guest() and !System::isGuestCreated()) {
            $menu=["title"=>"Orders","slug"=>"orders","ordering"=> 0,];
            Client::add_menu($menu,'default');

            $dashboard=["title"=>"orders","slug"=>"orders_sales","callback"=>'order_dashcard_sales','ordering'=>0,];
            // \Client::add_dashboard($dashboard);
        }
            if(System::can('can_access_admin')):
                $this->build_admin_menu();
                $this->build_admin_quick_action_buttons();
                $this->build_admin_dashboard();
                if($path = $request->input('redirect_to'))
                    return redirect($path);
            endif;
        }
        OrderConfig::__initialize();
        return $next($request);;
    }

    function build_admin_menu()
    {
        $menu=["title"=> "Orders","slug"=>"orders",'href'=>route('order.admin.orders.index'),
            "ordering"=> 10,];
        Admin::add_admin_menu('orders',['__base__'=>$menu]);
    }

    function build_admin_quick_action_buttons()
    {
        // foreach(Frontpage::$cells as $cell):
        //     Admin::add_quick_action_button($cell);
        // endforeach;
    }

    function build_admin_dashboard()
    {
        // $dashboard = [
        //     "title"=> "Application Status",
        //     "slug"=>"application status",
        //     "callback"=> 'applications_status',
        //     'ordering' => -22,
        // ];
        // Admin::add_admin_dashboard($dashboard);
    }
}
