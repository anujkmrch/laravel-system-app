<?php

namespace Dsu\Apps\admin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Dsu\Models\CourseSession;
use Dsu\Models\Course;

class AdmissionController extends Controller
{
    public function index(Request $request)
    {
    	$sessions = CourseSession::with('courses.applications')->where('active',true)->orderBy('active','id')->get();
        return view("DsuView::admin.admission.index",compact('sessions'));
    }

    public function course(Request $request,$course)
    {
    	$course = Course::with('session','applications')->find($course);
        return view("DsuView::admin.admission.course",compact('course'));
    }

    public function applications(Request $request)
    {
    	$sessions = CourseSession::with('courses.applications')->where('active',true)->orderBy('active','id')->get();
        return view("DsuView::admin.admission.index",compact('sessions'));
    }

   
}
