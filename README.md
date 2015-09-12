Funddy Worker
=============

[![Build Status](https://secure.travis-ci.org/funddy/worker.png?branch=master)](http://travis-ci.org/funddy/worker)

Simple asynchronous worker library based on Redis queues.

## Installation

    composer require funddy/worker

## Usage

### Publisher
```php
<?php

require 'vendor/autoload.php';

use Funddy\Worker\WorkerRedisClient\PredisWorkerRedisClient;
use Funddy\Worker\WorkQueue\RedisWorkQueue;
use Predis\Client;

$predisClient = new Client('tcp://localhost');
$redisClient = new PredisWorkerRedisClient($predisClient);
$queue = new RedisWorkQueue('myqueue', $redisClient);

$queue->publish('Hello world!');
```

### Consumer

```php
<?php

require 'vendor/autoload.php';

use Funddy\Worker\WorkerRedisClient\PredisWorkerRedisClient;
use Funddy\Worker\WorkQueue\RedisWorkQueue;
use Predis\Client;

$predisClient = new Client('tcp://localhost');
$redisClient = new PredisWorkerRedisClient($predisClient);
$queue = new RedisWorkQueue('myqueue', $redisClient);

while(true) {
    $message = $queue->consume();//Blocking
    echo $message;
}
```