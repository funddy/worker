<?php

namespace Funddy\Component\Worker\WorkChannel;

/**
 * @copyright (C) Funddy (2012)
 * @author Keyvan Akbary <keyvan@funddy.com>
 */
class UndeclaredQueue extends \RuntimeException
{
    public function __construct($queueName)
    {
       parent::__construct(sprintf('Queue "%s" does not exist', $queueName));
    }
}
