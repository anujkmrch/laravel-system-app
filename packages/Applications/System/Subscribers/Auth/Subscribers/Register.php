<?php
namespace System\Subscribers\Auth\Subscribers;
use Mail;
class Register{
	public function onRegister($user)
	{
		$user = \System\Models\User::find($user->id);
		Mail::send('SystemView::emails.register.success', ['user' => $user], function ($m) use ($user) {
            $m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($user->email,$user->name)->subject('Registered Succesfully');
        });
	}
}
?>