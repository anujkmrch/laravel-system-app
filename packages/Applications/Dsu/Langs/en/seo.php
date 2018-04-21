<?php
	return [
			'dsu'=>[
				'index' => [
					'title' => 'Dsu main page controller title',
					'description' => 'It is a wonderful idea to describe it here for my thought',
				],
			],
			'application'=>[
				'index' => [
					'title' => 'Your applications - :NAME',
					'description' => 'These are your applications you have applied so far',
				],
				'single' => [
					'title' => 'Dsu main page controller title',
					'description' => 'It is a wonderful idea to describe it here for my thought',
				],
			],

			'course'=>[
				'index' => [
					'active'=>[
						'title' => 'Course list for active session descr - :SESSION',
						'description' => 'Looking to update the session',
					],
					'inactive'=>[
						'title' => 'Your applications - :NAME',
						'description' => 'These are your applications you have applied so far',
					],
				],

				'course' => [
					'title' => ':COURSE - :SESSION',
					'description' => ':COURSE for session :SESSION',
				],
			],
	];
?>