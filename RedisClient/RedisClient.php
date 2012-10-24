<?php

namespace Funddy\Component\Worker\RedisClient;

/**
 * @copyright (C) Funddy (2012)
 * @author Keyvan Akbary <keyvan@funddy.com>
 */
interface RedisClient
{
    public function rpush($listName, $value);

    public function blpop($listName);
}
