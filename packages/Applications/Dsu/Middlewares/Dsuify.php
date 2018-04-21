<?php

namespace Dsu\Middlewares;

use Closure;
use Admin,System, Auth,Client;

class Dsuify
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
             $menu=["title"=>"Applications","slug"=>route('dsu.client.application.index'),"ordering"=> 0,];
            Client::add_menu($menu,'default');
            $menu=["title"=>"Documents","slug"=>route('dsu.client.user.document'),"ordering"=> 0,];

            Client::add_menu($menu,'default');

            $dashboard=["title"=>"Your application","slug"=>"visits","callback"=>'dsu_profile_applications','ordering'=>0,];
            Client::add_dashboard($dashboard);

            $dashboard=["title"=>"Your documents","slug"=>"visits","callback"=>'dsu_profile_documents','ordering'=>0,];
            Client::add_dashboard($dashboard);

            if(System::can('can_access_admin')):
                $this->build_admin_menu();
                $this->build_admin_quick_action_buttons();
                $this->build_admin_dashboard();
                if($path = $request->input('redirect_to'))
                    return redirect($path);
            endif;
        }
        
        return $next($request);;
    }

    function build_admin_menu()
    {
        
        $menu=["title"=> "Admissions","slug"=>"admissions",'href'=>route('dsu.admin.admission.index'),
            "ordering"=> 10,];
        Admin::add_admin_menu('admission',['__base__'=>$menu]);

        $menu=["title"=> "Examination center","slug"=>"users",'href'=>route('dsu.admin.exam-center'),
            "ordering"=> 1,];
        Admin::add_admin_menu('admission/exam-center',['__base__'=>$menu]);

        $menu=["title"=> "Users","slug"=>"users",'href'=>route('dsu.admin.user.index'),
            "ordering"=> 10,];
        Admin::add_admin_menu('admission/users',['__base__'=>$menu]);

        $menu=["title"=> "Courses","slug"=>"courses",'href'=>route('dsu.admin.course.index'),
            "ordering"=> 10,];
        Admin::add_admin_menu('admission/courses',['__base__'=>$menu]);

        $menu=["title"=> "Sessions","slug"=>"sessions",'href'=>route('dsu.admin.session.index'),
            "ordering"=> 10,];
        Admin::add_admin_menu('admission/sessions',['__base__'=>$menu]);

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
