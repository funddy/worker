<?php

namespace Funddy\Worker\WorkerRedisClient;

interface WorkerRedisClient
{
    public function rpush($listName, $value);

    public function blpop($listName);
}