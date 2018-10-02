<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	// Makes reading things below nicer,
	// and simpler to change out script that's used.
	public $aliases = [
		'csrf' 	  => \App\Filters\CSRF::class,
		'toolbar' => \App\Filters\DebugToolbar::class,
		'honeypot' => \App\Filters\Honeypot::class,
		'GuestRequest' => \App\Filters\API\GuestRequest::class,
		'GuestWithBearerRequest' => \App\Filters\API\GuestWithBearerRequest::class,
		'UserLoginRequest' => \App\Filters\API\UserLoginRequest::class,
	];

	// Always applied before every request
	public $globals = [
		'before' => [
			//'honeypot'
			// 'csrf',
		],
		'after'  => [
			'toolbar',
			//'honeypot'
		]
	];

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
	public $filters = [
		'GuestRequest' => [
			'before' => [
				'api/guest/postIdentity',
			],
		],
		'GuestWithBearerRequest' => [
			'before' => [
				'api/guest/postPassword',
				'api/guest/requestToken',
			]
		],
		'UserLoginRequest' => [
			'before' => [
				'api/teacher/*',
				'api/admin/*',
				'api/student/*'
			]
		]
	];
}
