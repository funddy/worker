<?php

namespace Funddy\Worker\Tests\WorkQueue;

use Funddy\Worker\WorkQueue\RedisWorkQueue;
use Mockery as m;

class RedisWorkQueueTest extends \PHPUnit_Framework_TestCase
{
    const IRRELEVANT_QUEUE_NAME = 'XXX';
    const IRRELEVANT_VALUE = 'XXXX';

    private $redisClientMock;
    private $redisWorkQueue;

    public function setUp()
    {
        $this->redisClientMock = m::mock('Funddy\Worker\WorkerRedisClient\WorkerRedisClient');
        $this->redisWorkQueue = new RedisWorkQueue(self::IRRELEVANT_QUEUE_NAME, $this->redisClientMock);
    }

    /**
     * @test
     */
    public function shouldInsertAValue()
    {
        $this->redisClientRPushShouldBeCalledWith(self::IRRELEVANT_VALUE);

        $this->assertEmpty($this->redisWorkQueue->insert(self::IRRELEVANT_VALUE));
    }

    private function redisClientRPushShouldBeCalledWith($with)
    {
        $this->redisClientMock->shouldReceive('rpush')->once()->with(self::IRRELEVANT_QUEUE_NAME, $with);
    }

    /**
     * @test
     */
    public function shouldConsumeAValue()
    {
        $this->redisClientBLPopShouldBeCalledAndReturn(self::IRRELEVANT_VALUE);

        $this->assertThat($this->redisWorkQueue->consume(), $this->identicalTo(self::IRRELEVANT_VALUE));
    }

    private function redisClientBLPopShouldBeCalledAndReturn($return)
    {
        $this->redisClientMock->shouldReceive('blpop')->once()->with(self::IRRELEVANT_QUEUE_NAME)->andReturn($return);
    }
}
