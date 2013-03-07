<?php

namespace Funddy\Worker\Tests\WorkerRedisClient;

use Funddy\Worker\WorkerRedisClient\PredisWorkerRedisClient;
use Mockery as m;

class PredisWorkQueueRedisClientTest extends \PHPUnit_Framework_TestCase
{
    const IRRELEVANT_LIST_NAME = 'XX';
    const IRRELEVANT_VALUE = 'XXX';

    private $predisClientMock;
    private $predisRedisClient;

    public function setUp()
    {
        $this->predisClientMock = m::mock('Predis\Client');
        $this->predisRedisClient = new PredisWorkerRedisClient($this->predisClientMock);
    }

    /**
     * @test
     */
    public function rpush()
    {
        $this->redisClientRPushShouldBeCalledWith(self::IRRELEVANT_LIST_NAME, self::IRRELEVANT_VALUE);

        $this->assertEmpty($this->predisRedisClient->rpush(self::IRRELEVANT_LIST_NAME, self::IRRELEVANT_VALUE));
    }

    private function redisClientRPushShouldBeCalledWith($listName, $value)
    {
        $this->predisClientMock->shouldReceive('rpush')->once()->with($listName, $value);
    }

    /**
     * @test
     */
    public function blpop()
    {
        $this->redisClientBLPopShouldBeCalledWith(self::IRRELEVANT_VALUE);

        $this->assertThat($this->predisRedisClient->blpop(self::IRRELEVANT_LIST_NAME), $this->identicalTo(self::IRRELEVANT_VALUE));
    }

    private function redisClientBLPopShouldBeCalledWith($return)
    {
        $this->predisClientMock
            ->shouldReceive('blpop')->once()
            ->with(self::IRRELEVANT_LIST_NAME, 0)
            ->andReturn(array(self::IRRELEVANT_LIST_NAME, $return));
    }
}
