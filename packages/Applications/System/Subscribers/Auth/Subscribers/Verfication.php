<?php

namespace System\Subscribers\Auth\Subscribers;

use Mail;

class Verification{

	public function onFailed($user)
	{
		Mail::send('SystemView::emails.register.success', ['user' => $user], function ($m) use ($user) {
            $m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($user->email,$user->name)->subject('Succesful Registered');
        });
	}

	public function onSuccessfull($user)
	{
		Mail::send('SystemView::emails.verification.success', ['user' => $user], function ($m) use ($user) {
            $m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($user->email,$user->name)->subject('Succesful Registered');
        });
	}
}
?>