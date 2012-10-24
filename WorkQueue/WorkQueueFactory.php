<?php

namespace Funddy\Component\Worker\WorkQueue;

/**
 * @copyright (C) Funddy (2012)
 * @author Keyvan Akbary <keyvan@funddy.com>
 */
interface WorkQueueFactory
{
    public function create($queueName);
}
