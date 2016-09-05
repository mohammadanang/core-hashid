<?php

namespace Apollo16\Core\HashId;

use Apollo16\Core\Contracts\HashId\Repository as RepositoryContract;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Hash id service provider.
 *
 * @author      mohammad.anang  <m.anangnur@gmail.com>
 */

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('apollo16.hashid', function () {
            $repository = new Repository();

            return $repository;
        }, true);

        $this->app->alias('apollo16.hashid', Repository::class);
        $this->app->alias('apollo16.hashid', RepositoryContract::class);

        $this->app['apollo16.hashid']->make('root', env('APP_KEY'));
    }
}