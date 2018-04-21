<?php

namespace Dsu\Apps\Admin\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dsu\Models\Center;

class ExamcenterController extends Controller
{
    public function index(Request $request)
    {

        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

        \Admin::add_to_toolbar(['name'=>'Create exam center','href'=>route('dsu.admin.exam-center.create')]);

    	$centers = Center::get();
    	return view('DsuView::admin.centers.index',compact('centers'));
    }

    public function edit(Request $request,$id)
    {

        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

        \Admin::add_to_toolbar(['name'=>'List all centers','href'=>route('dsu.admin.exam-center')]);

    	$center = Center::find($id);

    	// dd($center-> buildCenterFormElement());
    	return view('DsuView::admin.centers.edit',compact('center'));
    }

    public function doEdit(Request $request,$id)
    {

       $keys = array_keys(config('dsu.center'));
       $course = Center::find($id);
       $course->setCenterData($request->only($keys));
       $course->save();
       return redirect()->route('dsu.admin.exam-center');
    }

    public function create(Request $request)
    {

        \Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);

    	$center = new Center;
    	return view('DsuView::admin.centers.create',compact('center'));
    }

    public function doCreate(Request $request)
    {

        $keys = array_keys(config('dsu.center'));
        $course = new Center();
        $course->setCenterData($request->only($keys));
        $course->save();
        return redirect()->route('dsu.admin.exam-center');
    }

}