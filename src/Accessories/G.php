<?php

namespace AlecRabbit\Accessories;

class G
{
    /**
     * Static class. Private Constructor.
     */
    // @codeCoverageIgnoreStart
    protected function __construct()
    {
    }
    // @codeCoverageIgnoreEnd

    /**
     * @param int $start
     * @param int $stop
     * @param int|float $step
     * @return \Generator
     */
    public static function range(int $start, int $stop, $step = 1): \Generator
    {
        static::assertStep($step);
        $i = $start;
        $direction = $stop <=> $start;
        $step = $direction * $step;
        $halt = false;
        while (!$halt) {
            yield $i;
            $i += $step;
            if ((($i - $stop) <=> 0) === $direction) {
                $halt = true;
            }
        }
    }

    /**
     * @param int|float $step
     */
    protected static function assertStep($step): void
    {
        if ($step <= 0) {
            throw new \LogicException('Step has to be greater than zero');
        }
    }
}
