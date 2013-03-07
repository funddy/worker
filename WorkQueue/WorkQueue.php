<?php

namespace Funddy\Worker\WorkQueue;

interface WorkQueue
{
    public function publish($value);

    public function consume();
}