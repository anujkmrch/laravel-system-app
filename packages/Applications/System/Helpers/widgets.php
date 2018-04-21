<?php

function widget_render($position,$wrapper_callback=null)
{

	if(is_null($position) or empty($position))
		return;

	$html = '';
	$callback = 'widget_rendering'.($wrapper_callback ? '_'.$wrapper_callback : '');
	$widgets = System::getCurrentMenuWidget($position);
	ob_start();
	foreach($widgets as $widget)
	{
		$path = WIDGET_PATH.DS.$widget->path.DS.$widget->slug.DS.$widget->slug.'.php';

		if(file_exists($path))
		{
			if($wrapper_callback and function_exists($callback))
				call_user_func_array($callback, [$path,$widget]);
			else 
				require($path);
		}
	}
	$html .= ob_get_contents();
	ob_end_clean();
	return $html;
}

function position_has_widget($position)
{
	return count(System::getCurrentMenuWidget($position)) > 0 ? true : false;
}

function widget_option_to_form($options)
{
	if(!is_array($options))
	{
		return;
	}
	// convert the widget option into form
	return;
}

function widget_form_to_configuration($form)
{
	if(!is_array($data))
	{
		return;
	}
	// convert the form data into the configration array
	return;
}

if(!function_exists('widget_true_false_options'))
{
	function widget_true_false_options()
	{
		return ['1' => "Yes",'0' => 'No'];
	}
}


?>
