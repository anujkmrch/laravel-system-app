<?php
Route::group(['namespace'=>"\System\Apps\Client\Controllers"],function(){

		Route::get('/', [
			'uses' => 'HomeController@index',
			'as'	=> 'client.index',
		]);

		Route::get('/account', [
			'uses' => 'UserController@account',
			'as'	=> 'client.user.account',
		]);
				
});
?>