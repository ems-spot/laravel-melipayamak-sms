# laravel-melipayamak-sms
an unofficial integration of the melipayamak sms library for laravel 5.

put these lines in env

MELIPAYAMAK_USERNAME=
MELIPAYAMAK_PASSWORD=
MELIPAYAMAK_FROM=
MELIPAYAMAK_DEBUG_RECIPIENT=

php artisan vendor:publish EmsSpot\Melipayamak\MelipayamakServiceProvider
php artisan vendor:publish Melipayamak