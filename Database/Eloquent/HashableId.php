<?php

namespace Apollo16\Core\HashId\Database\Eloquent;

use Apollo16\Core\HashId\Repository as HashRepository;

/**
 * Eloquent model hashable id.
 *
 * @author      mohammad.anang  <m.anangnur@gmail.com>
 */

trait HashableId
{
    /**
     * Get model by hashed key.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $hash
     * @return mixed
     */
    public function scopeByHash($query, $hash)
    {
        return $query->where($this->getKeyName(), $this->hashIds()->decode($hash))
            ->first();
    }

    /**
     * Get hash attribute.
     *
     * @return string
     */
    public function getHashAttribute()
    {
        return $this->hashIds()
            ->encode($this->getOriginal($this->getKeyName()));
    }

    /**
     * Get HashIds Implementation.
     *
     * @return \Hashids\Hashids
     */
    protected function hashIds()
    {
        /*
         * HashId repository class
         *
         * @var \Apollo16\Core\HashId\Repository
         */
        $repository = app(HashRepository::class);

        // if it already exists on repository
        // Let's throw them
        if ($repository->has($this->getTable())) {
            return $repository->get($this->getTable());
        }

        $salted = substr(strrev(self::class), 0, 4) . substr(env('APP_KEY'), 0, 4);

        // ... create a new hashid instance if it not existed.
        $hash = $repository->make($this->getTable(), $salted);

        return $hash;
    }
}