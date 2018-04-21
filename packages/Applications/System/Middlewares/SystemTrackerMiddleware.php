<?php

namespace System\Middlewares;

use Closure;
use System\Models\SlugTrack;
use System\Models\Menu;
class SystemTrackerMiddleware
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
        SlugTrack::create([
                'slug' => $request->path(),
                'ipaddress'=>$request->ip(),
                'is_guest'=>\System::isGuestCreated()
            ]);
        $path =$request->path() !== '/' ? '/'.$request->path() : $request->path() ;
        //$path =trim($request->path());
        // dd($path);
        if($menu = Menu::where('slug',$path)->first())
            {
                \System::setActiveMenu($menu);
                \System::setCurrentMenuId($menu->id);
            }
        return $next($request);
    }
}
