<?php

namespace Funddy\Worker\WorkQueue;

interface WorkQueue
{
    public function insert($value);

    public function consume();
}