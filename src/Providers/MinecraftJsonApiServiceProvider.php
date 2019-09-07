<?php

namespace Kangoo13\Minecraft\JsonApi\Providers;

use Illuminate\Support\ServiceProvider;
use Kangoo13\Minecraft\JsonApi\Services\MinecraftJsonApiService;

/**
 * Class MinecraftJsonApiServiceProvider
 *
 * @package   Kangoo13\Minecraft\JsonApi\Providers
 * @author    Aurélien SCHILTZ <aurelienschiltz@gmail.com>
 * @copyright 2016-2019 Aurélien SCHILTZ
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class MinecraftJsonApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/minecraft-jsonapi.php' => config_path('minecraft-jsonapi.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton(MinecraftJsonApiService::class, function () {
            return new MinecraftJsonApiService(
                config('minecraft-jsonapi.ip'),
                config('minecraft-jsonapi.port'),
                config('minecraft-jsonapi.username'),
                config('minecraft-jsonapi.password')
            );
        });
    }
}
