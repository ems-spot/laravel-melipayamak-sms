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
    'from' => env('MELIPAYAMAK_FROM'),
	'debug' => env('MELIPAYAMAK_DEBUG', true),
	'debug_recipient_number' => env('MELIPAYAMAK_DEBUG_RECIPIENT'),
];
