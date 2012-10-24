<?php

namespace Funddy\Component\Worker\Tests\WorkQueue;

use Funddy\Component\Worker\WorkChannel\WorkChannel;
use Mockery as m;

/**
 * @copyright (C) Funddy (2012)
 * @author Keyvan Akbary <keyvan@funddy.com>
 */
class ChannelTest extends \PHPUnit_Framework_TestCase
{
    const IRRELEVANT_QUEUE_NAME = 'XX';
    const IRRELEVANT_BODY = 'XXX';

    private $workQueueFactoryMock;
    private $workChannel;
    private $dummyWorkQueue;

    public function setUp()
    {
        $this->workQueueFactoryMock = m::mock('Funddy\Component\Worker\WorkQueue\WorkQueueFactory');
        $this->workChannel = new WorkChannel($this->workQueueFactoryMock);
        $this->dummyWorkQueue = m::mock('Funddy\Component\Worker\WorkQueue\WorkQueue');
    }

    /**
     * @test
     * @expectedException \Funddy\Component\Worker\WorkChannel\UndeclaredQueue
     */
    public function publishUndelcaredQueueShouldThrowException()
    {
        $this->workChannel->publish(self::IRRELEVANT_QUEUE_NAME, '');
    }

    /**
     * @test
     * @expectedException \Funddy\Component\Worker\WorkChannel\UndeclaredQueue
     */
    public function consumeUndelcaredQueueShouldThrowException()
    {
        $this->workChannel->consume(self::IRRELEVANT_QUEUE_NAME);
    }

    /**
     * @test
     */
    public function declareQueueShouldCreateANewQueue()
    {
        $this->workQueueFactoryCreateShoulbBeCalledWithAndReturn(self::IRRELEVANT_QUEUE_NAME, $this->dummyWorkQueue);

        $this->assertEmpty($this->workChannel->declareQueue(self::IRRELEVANT_QUEUE_NAME));
    }

    private function workQueueFactoryCreateShoulbBeCalledWithAndReturn($queueName, $workQueue)
    {
        $this->workQueueFactoryMock->shouldReceive('create')->once()->with($queueName)->andReturn($workQueue);
    }

    /**
     * @test
     */
    public function publishShouldInsertBodyIntoQueue()
    {
        $this->workQueueFactoryCreateShoulbBeCalledWithAndReturn(self::IRRELEVANT_QUEUE_NAME, $this->dummyWorkQueue);
        $this->workQueueInsertShouldBeCalledWith(self::IRRELEVANT_BODY);

        $this->workChannel->declareQueue(self::IRRELEVANT_QUEUE_NAME);
        $this->assertEmpty($this->workChannel->publish(self::IRRELEVANT_QUEUE_NAME, self::IRRELEVANT_BODY));
    }

    private function workQueueInsertShouldBeCalledWith($body)
    {
        $this->dummyWorkQueue->shouldReceive('insert')->once()->with($body);
    }

    /**
     * @test
     */
    public function consumeShouldExtractFirstQueueElement()
    {
        $this->workQueueFactoryCreateShoulbBeCalledWithAndReturn(self::IRRELEVANT_QUEUE_NAME, $this->dummyWorkQueue);
        $this->workQueueExtractFirstShouldBeCalledAndReturn(self::IRRELEVANT_BODY);

        $this->workChannel->declareQueue(self::IRRELEVANT_QUEUE_NAME);
        $this->assertThat($this->workChannel->consume(self::IRRELEVANT_QUEUE_NAME), $this->identicalTo(self::IRRELEVANT_BODY));
    }

    private function workQueueExtractFirstShouldBeCalledAndReturn($body)
    {
        $this->dummyWorkQueue->shouldReceive('extractFirst')->once()->withNoArgs()->andReturn($body);
    }
}
