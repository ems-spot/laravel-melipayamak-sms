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
	'debug' => env('MAGFASMS_DEBUG', true),
	'debug_recipient_number' => env('MAGFASMS_DEBUG_RECIPIENT'),
];
