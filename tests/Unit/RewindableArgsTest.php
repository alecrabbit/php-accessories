<?php

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\Rewindable;
use PHPUnit\Framework\TestCase;

class RewindableArgsTest extends TestCase
{
    private static $generator;

    public static function setUpBeforeClass()
    {
        static::$generator = function (int $a = 1, int $b = 2, int $c = 3) {
            yield $a;
            yield $b;
            yield $c;
        };
    }

    /** @test */
    public function processesNotEmptyGenerator(): void
    {
        $iterator = new Rewindable(static::$generator, 1234, 12345, 123456);

        $this->assertEquals(
            [1234, 12345, 123456],
            iterator_to_array($iterator)
        );
    }

}
