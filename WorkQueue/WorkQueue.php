<?php

namespace Funddy\Component\Worker\WorkQueue;

/**
 * @copyright (C) Funddy (2012)
 * @author Keyvan Akbary <keyvan@funddy.com>
 */
interface WorkQueue
{
    public function insert($value);

    public function extractFirst();
}