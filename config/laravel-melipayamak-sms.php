<?php
return [

	/*
	|--------------------------------------------------------------------------
	| Melipayamak SMS Configuration
	|--------------------------------------------------------------------------
	|
	*/
	
	'from' => env('MELIPAYAMAK_FROM'),
	'url' => env('MELIPAYAMAK_BASE_HTTP_URL', 'http://api.payamak-panel.com/post/Send.asmx?wsdl'),
	'debug_recipient_number' => env('MELIPAYAMAK_DEBUG_RECIPIENT'),
	'error_max_value' => env('MELIPAYAMAK_ERROR_MAX_VALUE', '1000'),
	'debug' => env('MELIPAYAMAK_DEBUG', true),
];