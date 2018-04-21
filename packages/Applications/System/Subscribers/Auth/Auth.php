<?php

namespace System\Subscribers\Auth;

use Subscribers\Login;

class Auth{
	public function subscribe($events)
	{
		$events->listen('auth.onLogin',"\System\Subscribers\Auth\Subscribers\Login@onLogin");


		$events->listen('auth.onLogout',"\System\Subscribers\Auth\Subscribers\Logout@onLogout");

		$events->listen('auth.onLoginFailure',"\System\Subscribers\Auth\Subscribers\Login@onLoginFailure");

		$events->listen('auth.onRegister',"\System\Subscribers\Auth\Subscribers\Register@onRegister");

		$events->listen('auth.onRegisterFailure',"\System\Subscribers\Auth\Subscribers\Register@onRegisterFailure");

		$events->listen('auth.onVerificationFailed',
			"\System\Subscribers\Auth\Subscribers\Verification@onFailed");

		$events->listen('auth.onVerificationSuccessful',
			"\System\Subscribers\Auth\Subscribers\Verification@onSuccessful");


		// $events->listen('auth.onPasswordRequest',
		// 	"\System\Subscribers\Auth\Subscribers\Verification@onFailed");

		// $events->listen('auth.onPasswordResetSuccessful',
		// 	"\System\Subscribers\Auth\Subscribers\Verification@onSuccessful");

		// $events->listen('auth.onPasswordResetFailed',
		// 	"\System\Subscribers\Auth\Subscribers\Verification@onSuccessful");
	}
}
?>