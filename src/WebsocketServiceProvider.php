<?php

namespace JscorpTech\Websocket;

use Illuminate\Support\ServiceProvider;
use JscorpTech\Websocket\Commands\Redis;
use JscorpTech\Websocket\Commands\Websocket;

class WebsocketServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->publishes([
            __DIR__ . '/../config/websocket.php' => config_path('websocket.php'),
        ], "config");
    }

    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/websocket.php', 'websocket');
        if ($this->app->runningInConsole()) {
            $this->commands([
                Websocket::class,
                Redis::class,
            ]);
        }
    }
}
