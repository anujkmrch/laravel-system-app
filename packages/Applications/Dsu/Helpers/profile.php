<?php

if(!function_exists('dsu_profile_applications')):
	function dsu_profile_applications($dashcard)
	{
		$user = Dsu\Models\User::with('applications')->find(\Auth::id());
		$html = "<div class=\"dashcard\">
            <h4>{$dashcard['title']} <span class=\"badge\">".$user->applications->count()."</span></h4>
            <a href=\"".route('dsu.client.application.index')."\" class=\"btn btn-primary btn-sm\">View all</a>
            </div>";

		return $html;
	}
endif;

if(!function_exists('dsu_profile_documents')):
	function dsu_profile_documents($dashcard)
	{
		$user = Dsu\Models\User::with('documents')->find(\Auth::id());
		$html = "<div class=\"dashcard\">
            <h4>{$dashcard['title']} <span class=\"badge\">".$user->documents->count()."</span></h4>";
            if($user->documents->count()):
            $html .="<ul class=\"list-group\">";
	            foreach($user->documents as $document):
					$html .="<li class=\"list-group-item\">{$document->title}</li>";
	            endforeach;
            $html .="</ul>";
        	endif;

            $html .="<a href=\"".route('dsu.client.user.document')."\" class=\"btn btn-primary btn-sm\">Manage your documents</a>
            </div>";

		return $html;
	}
endif;
?>