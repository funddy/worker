<?php

namespace Funddy\Component\Worker\WorkQueue;

use Funddy\Component\Worker\RedisClient\RedisClient;

/**
 * @copyright (C) Funddy (2012)
 * @author Keyvan Akbary <keyvan@funddy.com>
 */
class RedisWorkQueueFactory implements WorkQueueFactory
{
    private $redisClient;

    public function __construct(RedisClient $redisClient)
    {
        $this->redisClient = $redisClient;
    }

    public function create($queueName)
    {
        return new RedisWorkQueue($queueName, $this->redisClient);
    }
}
