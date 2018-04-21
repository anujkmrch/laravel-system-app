<?php
Route::group(['namespace'=>"\System\Apps\Client\Controllers"],function(){
	
	Route::get('/account', [
		'uses' => 'UserController@account',
		'as'	=> 'client.user.account',
	]);
	
	Route::get('/profile', [
		'uses' => 'UserController@profile',
		'as'	=> 'client.user.profile',
	]);
	
	Route::post('/profile', [
		'uses' => 'UserController@updateAccount',
		'as'	=> 'client.user.profile',
	]);

});
?>