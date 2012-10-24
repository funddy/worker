<?php

namespace Funddy\Component\Worker\WorkQueue;

use Funddy\Component\Worker\RedisClient\RedisClient;

/**
 * @copyright (C) Funddy (2012)
 * @author Keyvan Akbary <keyvan@funddy.com>
 */
class RedisWorkQueue implements WorkQueue
{
    private $queueName;
    private $redisClient;

    public function __construct($queueName, RedisClient $redisClient)
    {
        $this->queueName = $queueName;
        $this->redisClient = $redisClient;
    }

    public function insert($value)
    {
        $this->redisClient->rpush($this->queueName, $value);
    }

    public function extractFirst()
    {
        return $this->redisClient->blpop($this->queueName);
    }
}