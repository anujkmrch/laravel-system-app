<?php
	if(!function_exists('widget_rendering')):
		function widget_rendering($path,$widget)
		{
			require $path;
		}
	endif;
	if(!function_exists('widget_rendering_half')):
		function widget_rendering_half($path,$widget)
		{
			echo "<div class=\"col-lg-6\"><div class=\"half\">";require $path;echo "</div></div>";
		}
	endif;
?>