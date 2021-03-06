<?php

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\Rewindable;
use PHPUnit\Framework\TestCase;

class RewindableTest extends TestCase
{
    private static $generator;

    public static function setUpBeforeClass(): void
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
        $iterator->rewind();
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
        $iterator->rewind();
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
    public function constructorThrowsExceptionWhenGivenNonGeneratorFunction(): void
    {
        $this->expectException('InvalidArgumentException');
        new Rewindable(function () {
        });
    }

    /** @test */
    public function setOnRewindThrowsExceptionWhenCallingItTwice(): void
    {
        $iterator = new Rewindable(static::$generator);
        $iterator->setOnRewind(function () {
        });
        $this->expectException('InvalidArgumentException');
        $iterator->setOnRewind(function () {
        });
    }

    /** @test */
    public function onRewindCallbackGetsCalledWhenCallingRewind(): void
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
    public function onRewindCallbackGetsCalledWhenIteratingMultipleTimes(): void
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
