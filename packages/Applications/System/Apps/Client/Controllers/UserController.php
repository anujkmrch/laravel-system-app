<?php
namespace System\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \System\Models\User;
use Auth;
use Validator;
class UserController extends Controller
{

    public function profile(Request $request)
    {

        if(\System::isGuestCreated())
            {
                $request->session()->flash('alert-warning', 'Please login');
                return redirect()->route('auth.login');
            }
        if($user = User::findorFail(Auth::id())){
            \SEO::setTitle("Dashboard ".$user->first_name.'\'s');
            return view("SystemView::client.user.profile",compact('user'));
        }
    }

	public function account(Request $request)
	{
		if(\System::isGuestCreated())
			{
				$request->session()->flash('alert-warning', 'Please login');
				return redirect()->route('auth.login');
			}
		if($user = User::findorFail(Auth::id())){
			return view("SystemView::client.user.account",compact('user'));
		}
	}

	public function updateAccount(Request $request)
	{
		if($user = User::findorFail(Auth::id())){
			//check permission
			if($user->id !== Auth::id() and !Webodeci::can('can_manage_self'))
			{
				abort(403);
			}

		   	$errors = [];
    		$info = $request->only([
                            'username',
                            'old_password',
                            'new_password',
                            'new_password_confirmation',
                            'email',
                            'avatar',
                            'first_name',
                            'last_name',
                        ]);

    		// dd($info);
        	//if($user = User::find($id)) {
        	// $rules = [	'first_name' =>'required',
         //                'last_name' =>'required',
         //                'roles' =>'required'];
    		$rules = [];

            //check email and done
			if(isset($info['email']) and $user->email !== strtolower($info['email'])){
				$rules['email'] = 'required|unique:users';
				$user->email = $info['email'];
			}

        	//must do the file operation
        	if($request->has('avatar')){
          		$rules['avatar'] ='mimes:jpeg,bmp,png';
        		if(substr($request->avatar->getMimeType(), 0, 5) == 'image') {
        			$path = $request->avatar->store('images','hosting');
	    			$user->avatar = '/'.$path;
 				}			
			}

        	if(!empty($info['first_name']) or !empty($info['last_name'])):

            	// initially set the first name and last name to save 
            	// from the array glitch
            	$first_name = $user->name;
            	$last_name = null;
            
            	//check if name has first and last name
            	//if yes then assign the new values to the first and lastname
            	if($name = explode(' ',$user->name) and count($name) > 1){
                	list($first_name,$last_name) = $name;
            	}

            	//check if first name is changed
            	if(!empty($info['first_name']) and strcmp($info['first_name'], $first_name) !== 0){
                	$first_name = $info['first_name'];
            	}

            	//check if last name is changed
            	if(!empty($info['last_name']) and strcmp($info['last_name'], $last_name) !== 0){
                	$last_name = $info['last_name'];
            	}

            	//create name from first_name and last_name
            	$name = implode(' ', [$first_name,$last_name]);

            	// checking if saved name and created name
            	// if different then update the name in the database
            	if(strcmp($name, $user->name) !== 0)
                    $user->name = $name;

            	endif;


            	// manage the company
            	if(!empty($info['company']) and strcmp($info['company'], $user->company) !== 0)
                	$user->company = $info['company'];

            	//update the password
                if(!empty($info['new_password']) ):
                    $rules['new_password'] = 'required|min:6|confirmed';
                    $user->password = \Hash::make($info['new_password']);
                endif; //password update finish
                $validator = Validator::make($request->all(),$rules);
					if($validator->fails()){
						// dd($validator->errors());
						return redirect()->back()->withErrors($validator)->withInput();
					}
            	if($user->isDirty()){
            		
                	$user->save();
                	$request->session()->flash('alert-success', 'Successfully updated');
            	}


        	return redirect()->back();
		}
		return redirect()->back()->with('error','There is no such user found!');
	}
}
?>