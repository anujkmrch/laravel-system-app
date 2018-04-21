<?php

if(!function_exists('order_dashcard_sales')):
	function order_dashcard_sales($dashcard)
	{
		$html = '<div class="col-lg-6 dashcard">';
			$html .= "<h1>".trans("OrderLang::dashcard.".$dashcard['title'])."</h1>";
			$html .= "<h3>".\Order\Models\Order::count()."</h3>";
		$html .="</div>";
		return $html;
	}
endif;
?>