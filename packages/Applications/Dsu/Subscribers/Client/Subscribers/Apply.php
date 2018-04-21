<?php

namespace Dsu\Subscribers\Client\Subscribers;

use Mail;
class Apply {
	
	public function onAppliedsuccessfully($application)
	{
		$user = \Dsu\Models\User::find(\Auth::id());
		Mail::send('DsuView::emails.success', ['user' => $user,'application'=>$application], function ($m) use ($user) {
            $m->from(config('mail.from.address'), config('mail.from.name'));

            $m->to($user->email, $user->name)->subject('You Applied successfully!');
        });
		return true;
	}

	public function onAppliedFailure($course)
	{
		$user = \Dsu\Models\User::find(\Auth::id());
		 Mail::send('DsuView::emails.failure', ['user' => $user,'course'=>$course], function ($m) use ($user) {
           $m->from(config('mail.from.address'), config('mail.from.name'));

            $m->to($user->email, $user->name)->subject('Your Application failed');
        });
		return true;
	}

	public function onlimitOver($course)
	{
		$user = \Dsu\Models\User::find(\Auth::id());
		Mail::send('DsuView::emails.over', ['user' => $user,'course'=>$course], function ($m) use ($user) {
            $m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($user->email, $user->name)->subject('Your Application limit over');
        });
		return true;
	}
}
?>