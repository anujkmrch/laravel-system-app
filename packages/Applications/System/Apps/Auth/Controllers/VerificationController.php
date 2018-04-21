<?php

namespace System\Apps\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
	public function verify(Request $request)
	{
		if($code = $request->input('code')):
			$query = "SELECT u.* from users as u join user_verifications as uv on u.id=uv.user_id where uv.code='{$code}'";
			if(count($user = \DB::select($query))==1):
				$user = \System\Models\User::hydrate($user)->first();
				$user->verified = true;
				$user->save();
				return redirect()->route('auth.login');
			else:
				dd("here");
			endif;
			// dd($code);
		endif;
		abort(404);
	}
}
