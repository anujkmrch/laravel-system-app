<?php

if(!function_exists('dsu_extract_course_id')):
	function dsu_extract_course_id()
	{

	}
endif;

if(!function_exists('dsu_extract_examination_center')):
	function dsu_extract_examination_center()
	{
		$centers = Dsu\Models\Center::where('enabled',1)->get()->pluck('title','id')->toArray();	
		return $centers;
	}
endif;


if(!function_exists('dsu_extract_course_title')):
	function dsu_extract_course_title()
	{

	}
endif;


if(!function_exists('dsu_extract_course_code')):
	function dsu_extract_course_code()
	{

	}
endif;


if(!function_exists('dsu_extract_course_session_list')):
	function dsu_extract_course_session_list()
	{
		return \Dsu\Models\CourseSession::get()->pluck('title','id')->toArray();
		return [1=>'2017-18'];
	}
endif;

if(!function_exists('dsu_extract_course_status')):
	function dsu_extract_course_status()
	{
		return [1=>'Enabled',0=>'Disabled'];
	}
endif;

if(!function_exists('dsu_extract_course_requirements')):
	function dsu_extract_course_requirements()
	{
		return \Dsu\Models\Document::get()->pluck('title','id')->toArray();
		// return ['tenth_marksheet'=>"Marksheet High school",'twevlth_marksheet'=>"Makrsheet Intermediate"];
	}
endif;

if(!function_exists('dsu_course_extractor')):
	function dsu_course_extractor($values){
		$result = [];
		foreach($values as $value)
			$result[] = $value['id'];
		return $result;
	}
endif;

?>