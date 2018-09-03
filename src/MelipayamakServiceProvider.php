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
		// $this->mergeConfigFrom(__DIR__.'/config/config.php', 'melipayamak');    
  //       $this->app->singleton('melipayamak', function ($app) {
  //           $username = $app['config']->get('melipayamak.username');
  //           $password = $app['config']->get('melipayamak.password');
  //           return new Api($username, $password);
  //       });
	}
}