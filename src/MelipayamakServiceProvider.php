<?php

declare(strict_types=1);

namespace EmsSpot\Melipayamak;

use Illuminate\Support\ServiceProvider;

final class MelipayamakServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/melipayamak.php' => config_path('melipayamak.php'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
    }
}