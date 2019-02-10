<?php

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Rewindable;
use PHPUnit\Framework\TestCase;

class RewindableTest extends TestCase
{
    private static $generator;

    public static function setUpBeforeClass()
    {
        static::$generator = function () {
            yield '1234';
            yield '12345';
            yield '123456';
        };
    }

    /** @test */
    public function processesEmptyGenerator(): void
    {
        $iterator = new Rewindable(
            function ($a = []) {
                yield from $a;
            }
        );

        $this->assertEquals([], iterator_to_array($iterator));
    }

    /** @test */
    public function processesNotEmptyGenerator(): void
    {
        $iterator = new Rewindable(static::$generator);

        $this->assertEquals(
            ['1234', '12345', '123456'],
            iterator_to_array($iterator)
        );
    }

    /** @test */
    public function canRewind(): void
    {
        $iterator = new Rewindable(static::$generator);

        $iterator->next();
        $this->assertEquals('12345', $iterator->current());
        $iterator->rewind();
        $this->assertEquals('1234', $iterator->current());
    }

    /** @test */
    public function canIterateTwice(): void
    {
        $iterator = new Rewindable(static::$generator);

        $this->assertEquals(
            ['1234', '12345', '123456'],
            iterator_to_array($iterator)
        );

        $this->assertEquals(
            ['1234', '12345', '123456'],
            iterator_to_array($iterator)
        );
    }

    /** @test */
    public function GivenNonGeneratorFunction_constructorThrowsException(): void
    {
        $this->expectException('InvalidArgumentException');
        new Rewindable(function () {
        });
    }

    /** @test */
    public function WhenCallingItTwice_onRewindThrowsException(): void
    {
        $iterator = new Rewindable(static::$generator);
        $iterator->setOnRewind(function () {
        });
        $this->expectException('InvalidArgumentException');
        $iterator->setOnRewind(function () {
        });
    }

    /** @test */
    public function WhenCallingRewind_onRewindCallbackGetsCalled(): void
    {
        $a = [];
        $callback = function () use (&$a) {
            $a[] = 'executed';
        };
        $iterator = new Rewindable(static::$generator);
        $iterator->setOnRewind($callback);

        $a[] = 'start';
        $iterator->rewind();
        $a[] = 'done';

        $this->assertSame(
            ['start', 'executed', 'done'],
            $a
        );
    }

    /** @test */
    public function IteratingMultipleTimes_onRewindCallbackGetsCalled(): void
    {
        $a = [];
        $callback = function () use (&$a) {
            $a[] = 'callback';
        };

        $iterator = new Rewindable(static::$generator);
        $iterator->setOnRewind($callback);

        $a[] = 'start';
        iterator_to_array($iterator);
        $a[] = 'first';
        iterator_to_array($iterator);
        $a[] = 'second';

        $this->assertSame(
            ['start', 'callback', 'first', 'callback', 'second'],
            $a
        );
    }

    /**
     * @test
     * @dataProvider rangeDataProvider
     * @param $expected
     * @param $start
     * @param $stop
     * @param $step
     */
    public function rangeRewindable($expected, $start, $stop, $step): void
    {
        $range = Rewindable::range($start, $stop, $step);
        $this->assertEquals($expected, iterator_to_array($range));
        $this->assertEquals($expected, iterator_to_array($range));
    }

    /**
     * @test
     * @dataProvider rangeDataProviderWithException
     * @param $start
     * @param $stop
     * @param $step
     */
    public function rangeRewindableWithException($start, $stop, $step): void
    {
        $this->expectException(\LogicException::class);
        iterator_to_array(Rewindable::range($start, $stop, $step));
    }


    public function rangeDataProvider(): array
    {
        return [
            // [$expected, $start, $stop, $step],
            [[1, 1.4, 1.8], 1, 2, 0.4],
            [[2, 1.6, 1.2], 2, 1, 0.4],
            [[1, 2, 3, 4, 5], 1, 5, 1],
            [[5, 4, 3, 2, 1], 5, 1, 1],
            [[-2, -1, 0, 1, 2], -2, 2, 1],
            [[-3, -1, 1,], -3, 2, 2],
            [[1,], 1, 1, 2],
            [[1,], 1, 1, 1],
            [[-1,], -1, -1, 1],
            [[-1,], -1, -1, 2],
        ];
    }

    public function rangeDataProviderWithException(): array
    {
        return [
            // [$expected, $start, $stop, $step],
            [1, 5, 0],
            [1, 5, -1],
        ];
    }

}
