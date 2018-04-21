<?php

namespace Dsu\Apps\admin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Dsu\Models\CourseSession;

class SessionController extends Controller
{
	public function __construct()
	{
		\Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

		\Admin::add_to_toolbar(['name'=>'All sessions','href'=>route('dsu.admin.session.index')]);

        \Admin::add_to_toolbar(['name'=>'DeActivate all sessions','href'=>route('dsu.admin.session.deactivate')]);

         \Admin::add_to_toolbar(['name'=>'Create new sessions','href'=>route('dsu.admin.session.create')]);

	}
    
    public function index(Request $request)
    {
    	$sessions = CourseSession::with('courses.applications')->orderBy('active','id')->get();
    	return view("DsuView::admin.session.index",compact('sessions'));
    }

    public function courses(Request $request,$session)
    {
    	$sessions = CourseSession::with('courses.applications')->where('id',$session)->get();
    	return view("DsuView::admin.session.courses",compact('sessions'));
    }

    public function activate(Request $request,$session)
    {
    	$actives = CourseSession::where('active',true)->get();
    	foreach($actives as $active)
    	{
    		$active->active = false;
    		$active->save();
    	}
    	if($session = CourseSession::find($session))
    		{
    			$session->active = true;
    			$session->save();
    		}
    	return redirect()->back();
    }

    public function deactivate(Request $request)
    {
    	$actives = CourseSession::where('active',true)->get();
    	foreach($actives as $active)
    	{
    		$active->active = false;
    		$active->save();
    	}
    	return redirect()->back();
    }

    public function create(Request $request)
    {
        $keys = config('dsu.session',[]);
        $builder = new \System\Classes\Builder($keys);
        return view("DsuView::admin.session.create",compact('builder'));
    }

    public function generate(Request $request)
    {
        if(count($keys = array_keys(config('dsu.session',[])))) {
            
            $data = \System\Classes\Builder::extractors(config('dsu.session',[]),$request->only($keys));
            // dd($data);
            $session = CourseSession::create($data['columns']);
            dd($session);
            // $course = new Course();
            // $course->setCourseData($data['columns']);
            $course->save();

            $course->saveRelations($data['relations']);
        }
    }

    public function session(Request $request,$id)
    {
        $session = CourseSession::find($id);
        $builder = new \System\Classes\Builder($session->renderingConfiguration());
        // dd($session->renderingConfiguration());
        return view("DsuView::admin.session.session",compact('session','builder'));
    }

    public function edit(Request $request,$id)
    {
        $session = CourseSession::find($id);
        if(count($keys = array_keys(config('dsu.session',[])))) {
            
            $data = \System\Classes\Builder::extractors(config('dsu.session',[]),$request->only($keys));
            // dd($data);
            $session->fill($data['columns']);
            $session->save();
            return redirect()->route('dsu.admin.session.edit',['id' => $session->id]);
        }
    }
}
