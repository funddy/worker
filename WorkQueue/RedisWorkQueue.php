<?php

namespace Funddy\Worker\WorkQueue;

use Funddy\Worker\WorkerRedisClient\WorkerRedisClient;

class RedisWorkQueue implements WorkQueue
{
    private $queueName;
    private $redisClient;

    public function __construct($queueName, WorkerRedisClient $redisClient)
    {
        $this->queueName = $queueName;
        $this->redisClient = $redisClient;
    }

    public function insert($value)
    {
        $this->redisClient->rpush($this->queueName, $value);
    }

    public function consume()
    {
        return $this->redisClient->blpop($this->queueName);
    }
}