<?php

namespace Funddy\Component\Worker\Tests\RedisClient;

use Funddy\Component\Worker\RedisClient\PredisRedisClient;
use Mockery as m;

/**
 * @copyright (C) Funddy (2012)
 * @author Keyvan Akbary <keyvan@funddy.com>
 */
class PredisRedisClientTest extends \PHPUnit_Framework_TestCase
{
    const IRRELEVANT_LIST_NAME = 'XX';
    const IRRELEVANT_VALUE = 'XXX';

    private $predisClientMock;
    private $predisRedisClient;

    public function setUp()
    {
        $this->predisClientMock = m::mock('Predis\Client');
        $this->predisRedisClient = new PredisRedisClient($this->predisClientMock);
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
