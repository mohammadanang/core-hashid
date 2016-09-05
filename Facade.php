<?php

namespace Apollo16\Core\HashId;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * HashId Facade.
 *
 * @author      mohammad.anang  <m.anangnur@gmail.com>
 */

class Facade extends LaravelFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'apollo16.hashid';
    }
}