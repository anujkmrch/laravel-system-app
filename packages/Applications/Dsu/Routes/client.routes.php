<?php
/**
 * 
 * dsu.client.application.index represent
 * packageName.AppSpace.Controller.Method
 * 
 */

Route::group(['namespace'=>"\Dsu\Apps\Client\Controllers"],function(){
	
	Route::get('/', [
		'uses' => 'DsuController@index',
		'as'	=> 'dsu.client.dsu.index',
	]);

	Route::get('/courses', [
		'uses' => 'CourseController@index',
		'as'	=> 'dsu.client.course.index',
	]);

	Route::get('/course/{course}', [
		'uses' => 'CourseController@course',
		'as'	=> 'dsu.client.course.course',
	]);

	Route::get('/course/{course}/apply', [
		'uses' => 'CourseController@apply',
		'as'	=> 'dsu.client.course.apply',
	]);

	Route::get('/applications', [
		'uses' => 'ApplicationController@index',
		'as'	=> 'dsu.client.application.index',
	]);

	Route::post('/application-fee', [
		'uses' => 'ApplicationController@pay_fees',
		'as'	=> 'dsu.client.application.pay',
	]);

	Route::post('/application', [
		'uses' => 'ApplicationController@single',
		'as'	=> 'dsu.client.application.single',
	]);

	// Route::get('/profile', [
	// 		'uses' => 'UserController@profile',
	// 		'as'	=> 'dsu.client.user.profile',
	// 	]);
	
	// Route::post('/profile', [
	// 	'uses' => 'UserController@updateProfile',
	// 	'as'	=> 'dsu.client.user.profile',
	// ]);

	Route::post('/course-fetch', [
		'uses' => 'CourseController@fetch',
		'as'	=> 'dsu.client.course.fetch',
	]);

	Route::get('/documents', [
		'uses' => 'UserController@documents',
		'as'	=> 'dsu.client.user.document',
	]);

	Route::post('/documents', [
		'uses' => 'UserController@uploadDocuments',
		'as'	=> 'dsu.client.user.document',
	]);

});
?>