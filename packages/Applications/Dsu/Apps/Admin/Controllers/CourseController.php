<?php

namespace Dsu\Apps\admin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Dsu\Models\Course;
use Dsu\Models\CourseSession as Session;

class CourseController extends Controller
{

	public function __construct()
	{
		\Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

        \Admin::add_to_toolbar(['name'=>'Create course','href'=>route('dsu.admin.course.new')]);
	}
    
    public function index(Request $request)
    {
    	$session = Session::with('courses')->where('active',true)->first();
    	return view("DsuView::admin.course.index",compact('session'));
    }

    public function course(Request $request,$slug)
    {
    	$course = Course::with('documents')->find($slug);
    	// $elements = config('dsu.course',[]);
    	$builder = new \System\Classes\Builder($course->renderingConfiguration());
    	return view("DsuView::admin.course.course",compact('course','builder'));
    }

    public function edit(Request $request,$slug)
    {
    	$course = Course::with('documents')->find($slug);
    	if(count($keys = array_keys(config('dsu.course',[])))){
	   		$data = Course::extractors(config('dsu.course',[]),$request->only($keys));
	   		$course->setCourseData($data['columns']);
            $course->save();

            $course->saveRelations($data['relations']);

    	}
    	return redirect()->route('dsu.admin.course.course',['slug'=>$course->id]);
    	
    }

    public function create(Request $request)
    {
    	$courses = Session::with('courses')->where('active',true)->first();
    	
    	$elements = config('dsu.course',[]);
    	
    	$builder = new \System\Classes\Builder($elements);

    	return view("DsuView::admin.course.new",compact('courses','builder'));
    }

    public function new(Request $request)
    {
	   	if(count($keys = array_keys(config('dsu.course',[])))){
	   		$data = Course::extractors(config('dsu.course',[]),$request->only($keys));
	   		$course = new Course();
	   		$course->setCourseData($data['columns']);
            $course->save();

            $course->saveRelations($data['relations']);
	   	}
	   		'';
    		// ($request->only($keys));
    	return redirect()->route('dsu.admin.course.course',['slug'=>$course->id]);
    	return view("DsuView::admin.course.new",compact('courses','builder'));
    }
}
