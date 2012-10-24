Funddy Worker
=============

[![Build Status](https://secure.travis-ci.org/funddy/worker.png?branch=master)](http://travis-ci.org/funddy/worker)

Simple asynchronous worker library based on Redis queues.

Setup and Configuration
-----------------------
Add the following to your composer.json file:
```json
{
    "require": {
        "funddy/worker": "1.0.*"
    }
}
```

Update the vendor libraries:

    curl -s http://getcomposer.org/installer | php
    php composer.phar install

Usage
-----

### Client
```php
<?php

require 'vendor/autoload.php';

use Funddy\Component\Worker\RedisClient\PredisRedisClient;
use Funddy\Component\Worker\WorkChannel\WorkChannel;
use Funddy\Component\Worker\WorkQueue\RedisWorkQueueFactory;
use Predis\Client;

$predisClient = new Client('tcp://localhost');
$redisClient = new PredisRedisClient($predisClient);
$workQueueFactory = new RedisWorkQueueFactory($redisClient);
$workChannel = new WorkChannel($workQueueFactory);

$workChannel->declareQueue('myqueue');
$workChannel->publish('myqueue', 'Hello world!');
```

### Server
```php
<?php

require 'vendor/autoload.php';

use Funddy\Component\Worker\RedisClient\PredisRedisClient;
use Funddy\Component\Worker\WorkChannel\WorkChannel;
use Funddy\Component\Worker\WorkQueue\RedisWorkQueueFactory;
use Predis\Client;

$predisClient = new Client('tcp://localhost');
$redisClient = new PredisRedisClient($predisClient);
$workQueueFactory = new RedisWorkQueueFactory($redisClient);
$workChannel = new WorkChannel($workQueueFactory);

$workChannel->declareQueue('myqueue');
while(true) {
    $message = $workChannel->consume('myqueue');//Blocking
    echo $message;
}
```
