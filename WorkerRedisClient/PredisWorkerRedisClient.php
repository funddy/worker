<?php

namespace Funddy\Worker\WorkerRedisClient;

use Predis\Client;

class PredisWorkerRedisClient implements WorkerRedisClient
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