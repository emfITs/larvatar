<?php

namespace Renfordt\Larvatar;

use Illuminate\Support\ServiceProvider;

class LarvatarServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/larvatar.php', 'larvatar');
    }

    public function register()
    {
        $this->app->make('Renfordt\Larvatar\Larvatar');
        $this->publishes([
            __DIR__ . '/../config/larvatar.php' => config_path('larvatar.php'), //@phpstan-ignore-line
        ]);
    }
}
