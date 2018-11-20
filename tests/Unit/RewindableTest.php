<?php
/**
 * User: alec
 * Date: 08.11.18
 * Time: 15:58
 */

namespace Unit;

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
}
