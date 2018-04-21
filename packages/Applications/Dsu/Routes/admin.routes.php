<?php
Route::group(['prefix'=>'admin','namespace'=>"Dsu\Apps\Admin\Controllers"],function(){
	
	Route::get('/admissions',[
		'uses' => 'AdmissionController@index',
		'as'   => 'dsu.admin.admission.index',
	]);


	Route::get('/admissions/application/{application}',[
		'uses' => 'AdmissionController@application',
		'as'   => 'dsu.admin.admission.application',
	]);

	Route::get('/admissions/applications/{course}',[
		'uses' => 'AdmissionController@course',
		'as'   => 'dsu.admin.admission.applications',
	]);


	Route::get('/admissions/courses',[
		'uses' => 'CourseController@index',
		'as'   => 'dsu.admin.course.index',
	]);

	Route::get('/admissions/course/new',[
		'uses' => 'CourseController@create',
		'as'   => 'dsu.admin.course.new',
	]);

	Route::post('/admissions/course/new',[
		'uses' => 'CourseController@new',
		'as'   => 'dsu.admin.course.new',
	]);

	Route::get('/admissions/course/{slug}',[
		'uses' => 'CourseController@course',
		'as'   => 'dsu.admin.course.course',
	]);

	Route::post('/admissions/course/{slug}',[
		'uses' => 'CourseController@edit',
		'as'   => 'dsu.admin.course.edit',
	]);

	Route::get('/admissions/sessions',[
		'uses' => 'SessionController@index',
		'as'   => 'dsu.admin.session.index',
	]);

	Route::get('/admissions/session-courses/{session}',[
		'uses' => 'SessionController@courses',
		'as'   => 'dsu.admin.session.courses',
	]);

	Route::get('/admissions/session/activate/{session}',[
		'uses' => 'SessionController@activate',
		'as'   => 'dsu.admin.session.activate',
	]);

	Route::get('/admissions/session/deactivate',[
		'uses' => 'SessionController@deactivate',
		'as'   => 'dsu.admin.session.deactivate',
	]);

	Route::get('/admissions/session/create',[
		'uses' => 'SessionController@create',
		'as'   => 'dsu.admin.session.create',
	]);

	Route::post('/admissions/session/create',[
		'uses' => 'SessionController@generate',
		'as'   => 'dsu.admin.session.create',
	]);

	Route::get('/admissions/session/{id}',[
		'uses' => 'SessionController@session',
		'as'   => 'dsu.admin.session.edit',
	]);

	Route::post('/admissions/session/{id}',[
		'uses' => 'SessionController@edit',
		'as'   => 'dsu.admin.session.edit',
	]);

	Route::get('/admissions/users',[
		'uses' => 'UserController@index',
		'as'   => 'dsu.admin.user.index',
	]);

	/**
	 * Examination center controller
	 */
	Route::get('/exam-centers',[
		'uses' => 'ExamcenterController@index',
		'as'   => 'dsu.admin.exam-center',
	]);

	
	Route::get('/exam-centers-create',[
		'uses' => 'ExamcenterController@create',
		'as'   => 'dsu.admin.exam-center.create',
	]);

	Route::post('/exam-centers-create',[
		'uses' => 'ExamcenterController@doCreate',
		'as'   => 'dsu.admin.exam-center.create',
	]);

	
	Route::get('/exam-centers-edit-{id}',[
		'uses' => 'ExamcenterController@edit',
		'as'   => 'dsu.admin.exam-center.edit',
	]);

	Route::post('/exam-centers-edit-{id}',[
		'uses' => 'ExamcenterController@doEdit',
		'as'   => 'dsu.admin.exam-center.edit',
	]);

	/**
	 * Dbsync Controller Routes
	 */
	Route::get('/oracle-mysql-db-sync',[
		'uses' => 'DbsyncController@index',
		'as'   => 'dsu.admin.dbsync.index',
	]);
});
?>
