<?php

namespace Apollo16\Core\HashId;

use Hashids\Hashids;
use Illuminate\Config\Repository as ConfigRepository;

/**
 * HashId repository.
 *
 * @author      mohammad.anang  <m.anangnur@gmail.com>
 */

class Repository extends ConfigRepository
{
    /**
     * Create new HashId instance.
     *
     * @param string $key
     * @param string $salt
     * @return \Hashids\Hashids
     */
    public function make($key, $salt)
    {
        $hashids = new Hashids($salt, 8, 'abcdefghijklmnopqrstuvwxyz0123456789');

        $this->set($key, $hashids);

        return $hashids;
    }
}