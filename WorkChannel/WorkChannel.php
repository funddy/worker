<?php

namespace Funddy\Component\Worker\WorkChannel;

use Funddy\Component\Worker\WorkQueue\WorkQueueFactory;

/**
 * @copyright (C) Funddy (2012)
 * @author Keyvan Akbary <keyvan@funddy.com>
 */
class WorkChannel
{
    private $workQueueFactory;
    private $queues = array();

    public function __construct(WorkQueueFactory $workQueueFactory)
    {
        $this->workQueueFactory = $workQueueFactory;
    }

    public function declareQueue($queueName)
    {
        $this->queues[$queueName] = $this->workQueueFactory->create($queueName);
    }

    public function publish($queueName, $body)
    {
        $queue = $this->getQueue($queueName);

        $queue->insert($body);
    }

    public function consume($queueName)
    {
        $queue = $this->getQueue($queueName);

        return $queue->extractFirst();
    }

    private function getQueue($queueName)
    {
        if (!isset($this->queues[$queueName])) {
            throw new UndeclaredQueue($queueName);
        }

        return $this->queues[$queueName];
    }
}
