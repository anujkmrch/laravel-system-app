<?php
namespace System\Subscribers\Auth\Subscribers;
use Mail;
class Login{
	public function onLogin($user)
	{
		$user = \System\Models\User::find($user->id);
		Mail::send('SystemView::emails.login.success', ['user' => $user], function ($m) use ($user) {
            $m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($user->email,$user->name)->subject('Succesful Logged in');
        });
		return true;
	}
}
?>