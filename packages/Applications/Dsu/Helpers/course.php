<?php

	function course_cart_list_builder($cart){
		$html = "";
		if(count($cart->items)):
			$html = "<tr>
						<th>Title</th>
						<th>Applicant Information</th>
						<th>View</th>
					</tr>";

			foreach($cart->items as $items):
				
				$html .= "<td>{$items["item"]->Course->title}</td>";
				$html .= "<td><table class=\"table table-striped table-condensed table-bordered\">";
				foreach($items["item"]->options as $key => $value){

					if(!is_array($value)):
						$html .= "<tr><th>".@trans("DsuLang::application.".$key)."</th>";
						$html.= "<td> ".@trans_fb("DsuLang::application.".$value,$value)."</td></tr>";
					endif;

				}
				$html.= "</table></td>";
				$html .= "<td><a href=\"".route('dsu.admin.course.course',['slug'=>$items["item"]->course_id])."\">See edit</a></td>";
			
			endforeach;

		endif;

		return $html;
	}
?>