<?php

namespace System\Apps\admin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use System\Models\Menu;
use System\Models\Widget;
use System\Models\Widgetize;

class WidgetController extends Controller
{
    public function widgets()
    {
    	// $widgets = Widgetize::with('widget')->get();
    	$widgets = Widget::get();
    	\Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);
    	return view('SystemView::admin.widget.list',compact('widgets'));
    }

    public function index()
    {
    	$widgets = Widgetize::with('widget')->get();
    	// $widgets = Widget::get();
    	
    	\Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);
    	\Admin::add_to_toolbar(['name'=>'All widgets','href'=>route('admin.widget.list')]);
    	return view('SystemView::admin.widget.index',compact('widgets'));
    }



    public function edit(Request $request,$id)
    {
    	\DB::connection()->enableQueryLog();
    	$widgets = Widgetize::with('widget')->get();
    	
    	\Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);
        
        \Admin::add_to_toolbar(['name'=>'Go back','href'=>route('admin.widget.index')]);

    	$widget = Widgetize::with('widget','menus')->find($id);
    	$m = ['mayday' => [
	            'title' => 'Select menu',
	            'type' => 'select',
	            'validations' => array('not_empty'),
	            'callback' => 'menu_list_build',
	            'scope' => 'configuration',
	            'multiple' => false,
	            'required'  => true,
	          ]
	      ];

	    // dd($widget->menus);
	    // dd(\DB::getQueryLog());
        // dd(json_encode(array_merge($widget->widget->configuration,$m)));
    	$keys = array_keys(array_merge($widget->widget->configuration,config('system.widgetize_extracter',[])));
		
		$c= $widget->renderingConfiguration();
		
		return view("SystemView::admin.widget.edit",compact('widget','formConfiguration'));
    }

    public function doEdit(Request $request,$id)
    {
    	
    	$widget = Widgetize::with('widget')->find($id);

    	$keys = array_keys(array_merge($widget->widget->configuration,config('system.widgetize_extracter',[])));
			
		$configuration = $widget->widget->buildWidgetizeConfiguration($request->only($keys),$keys);

		$data = Widgetize::Widgetized($configuration,$request->only($keys));

		$widget->setColumns($data['columns']);
			
		// if($widget->isDirty()){
		// dd($widget->isDirty());
			$widget->save();
		// }

		//solve the relations
		$widget->saveRelations($data['relations']);
		
		return redirect()->route('admin.widget.edit',['slug'=>$widget->id]);
    }

	public function assign(Request $request, $id)
	{
		return $id;
	}

	public function create(Request $request, $slug)
	{
		\Admin::add_to_toolbar(['name'=>'Frontpage','href'=>route('admin.frontpage.index')]);
    	\Admin::add_to_toolbar(['name'=>'All widgets','href'=>route('admin.widget.list')]);

		$widget = Widget::with('widgetized')->where('slug',$slug)->first();
		return view("SystemView::admin.widget.create",compact('widget'));
	}

	public function doCreate(Request $request, $slug)
	{
		if($widget = Widget::with('widgetized')->where('slug',$slug)->first()):

			// dd(json_encode(['menu' => [
			// 	    'title' => 'Select menu',
			// 	    'type' => 'select',
			// 	    'validations' => array('not_empty'),
			// 	    'callback' => 'menu_list_build',
			// 	    'scope' => 'configuration',
			// 	    'multiple' => false,
			// 	    'required'  => true,
			// 	],]));
			// $keys = config('system.widgetize_extracter',[]);

			$keys = array_keys(array_merge($widget->configuration,config('system.widgetize_extracter',[])));
			
			$configuration = $widget->buildWidgetizeConfiguration($request->only($keys),$keys);

			$data = Widgetize::Widgetized($configuration,$request->only($keys));

			$data['columns']['widget_id'] = $widget->id;
			
			// Widgetize::create($data['columns']);

			$widgetized = new Widgetize;
			
			$widgetized->setColumns($data['columns']);
			
			if($widgetized->isDirty())
				$widgetized->save();

			$widgetized->saveRelations($data['relations']);
			return redirect()->route('admin.widget.edit',['slug'=>$widgetized->id]);
		endif;
		return redirect()->back();
	}


}
