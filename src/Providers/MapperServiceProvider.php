<?php

namespace EhsanMoradi\DataMapper\Providers;

use Illuminate\Support\ServiceProvider;

class MapperServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/data-mapper.php', 'data-mapper');

    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../Config/data-mapper.php' => config_path('data-mapper.php'),
        ], 'config');
    }
}
