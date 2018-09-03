<?php
namespace EmsSpot\Melipayamak;
class MelipayamakServiceProvider extends \Illuminate\Support\ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../config/laravel-melipayamak-sms.php' => config_path('laravel-melipayamak-sms.php'),
		]);
	}
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
	}
}