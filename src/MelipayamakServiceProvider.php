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
			__DIR__.'/../config/melipayamak.php' => config_path('melipayamak.php'),
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