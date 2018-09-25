<?php
return [

	/*
	|--------------------------------------------------------------------------
	| Melipayamak SMS Configuration
	|--------------------------------------------------------------------------
	|
	*/
	
	'username' => env('MELIPAYAMAK_USERNAME'),
    'password' => env('MELIPAYAMAK_PASSWORD'),
    'debug_recipient' => env('MELIPAYAMAK_DEBUG_RECIPIENT'),
    'from' => env('MELIPAYAMAK_FROM'),
];