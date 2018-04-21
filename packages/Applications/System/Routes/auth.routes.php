<?php
Route::group(['namespace'=> 'System\Apps\Auth\Controllers'],function() {
	// Login Routes
	Route::get('login','LoginController@showLoginForm')->name('auth.login');
	Route::post('login','LoginController@login')->name('auth.login');

	// Logout Routes
	Route::get('logout','LoginController@logout')->name('auth.logout');
	Route::post('logout','LoginController@logout')->name('auth.logout');		

	// Registration Routes...
	Route::get('register','RegisterController@showRegistrationForm')->name('register')->name('auth.register');
	Route::post('register','RegisterController@register')->name('auth.register');

	// // Password Reset Routes...
	Route::get('password/reset','ForgotPasswordController@showLinkRequestForm')->name('auth.password.request');

	Route::get('password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
	
	Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

	 Route::post('password/reset', 'ResetPasswordController@reset');

	 Route::get('auth/verify','VerificationController@verify')->name('auth.verify.email');
});

?>