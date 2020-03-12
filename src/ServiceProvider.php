<?php

namespace Arispati\SrcMacro;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // For both Laravel and Lumen
        Collection::make(glob(__DIR__ . '/Macros/Database/QueryBuilder/*.php'))->mapWithKeys(function ($path) {
            return [$path => pathinfo($path, PATHINFO_FILENAME)];
        })->each(function ($macro, $path) {
            require_once $path;
        });

        // For Lumen only
        if (app() instanceof \Laravel\Lumen\Application) {
            Collection::make(glob(__DIR__ . '/Macros/Response/Lumen/*.php'))->mapWithKeys(function ($path) {
                return [$path => pathinfo($path, PATHINFO_FILENAME)];
            })->each(function ($macro, $path) {
                require_once $path;
            });

        // For Laravel only
        } else {
            Collection::make(glob(__DIR__ . '/Macros/Response/*.php'))->mapWithKeys(function ($path) {
                return [$path => pathinfo($path, PATHINFO_FILENAME)];
            })->each(function ($macro, $path) {
                require_once $path;
            });
        }
    }
}
