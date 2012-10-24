<?php

namespace Funddy\Component\Worker\RedisClient;

use Predis\Client;

/**
 * @copyright (C) Funddy (2012)
 * @author Keyvan Akbary <keyvan@funddy.com>
 */
class PredisRedisClient implements RedisClient
{
    private $predisClient;

    public function __construct(Client $predisClient)
    {
        $this->predisClient = $predisClient;
    }

    public function rpush($listName, $value)
    {
        return $this->predisClient->rpush($listName, $value);
    }

    public function blpop($listName)
    {
        $element = $this->predisClient->blpop($listName, 0);
        return $element[1];
    }
}
