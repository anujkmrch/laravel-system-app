<?php

namespace Order\Subscribers\Client\Subscribers;

use PaytmWallet;
use Mail;

class Order {
	
	public function onOrderSuccess($order)
	{
		$user = \Order\Models\User::find(\Auth::id());
		$payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => $order->id,
          'user' => $user->id,
          'mobile_number' => "1234567890",
          'email' => $user->email,
          'amount' => 500,
          'callback_url' => 'http://dev.codebloop.com/payment/status'
        ]);
        return $payment->receive();

		$user = \Order\Models\User::find(\Auth::id());
		Mail::send('OrderView::emails.success', ['user' => $user], function ($m) use ($user) {
            $m->from(config('mail.from.address'), config('mail.from.name'));

            $m->to($user->email, $user->name)->subject('Your Order Created');
        });
		return true;
	}

	public function onOrderFailure($order)
	{
		$user = \Order\Models\User::find(\Auth::id());
		 Mail::send('OrderView::emails.failure', ['user' => $user], function ($m) use ($user) {
           $m->from(config('mail.from.address'), config('mail.from.name'));

            $m->to($user->email, $user->name)->subject('Your Order Failed');
        });
		return true;
	}

	public function onOrderStatusChange($order)
	{
		$user = \Order\Models\User::find(\Auth::id());
		Mail::send('OrderView::emails.over', ['user' => $user], function ($m) use ($user) {
            $m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($user->email, $user->name)->subject('Your Order status changed');
        });
		return true;
	}

	/**
	 * It's the time to redirect to payment services
	 * @param  [type] $order [description]
	 * @return [type]        [description]
	 */
	public function onOrderMappedSuccessfully($order)
	{
		$user = \Order\Models\User::find(\Auth::id());
		Mail::send('OrderView::emails.over', ['user' => $user], function ($m) use ($user) {
            $m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($user->email, $user->name)->subject('Your Order mapping');
        });

		$user = \Order\Models\User::find(\Auth::id());
		$payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => $order->id,
          'user' => $user->id,
          'mobile_number' => "1234567890",
          'email' => $user->email,
          'amount' => 500,
          'callback_url' => 'http://dev.codebloop.com/payment/status'
        ]);
        return $payment->receive();


		$user = \Order\Models\User::find(\Auth::id());
		Mail::send('OrderView::emails.over', ['user' => $user], function ($m) use ($user) {
            $m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($user->email, $user->name)->subject('Your Order mapping');
        });
		return true;
	}
}
?>