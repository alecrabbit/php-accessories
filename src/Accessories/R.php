<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

/**
 * Class R
 */
class R
{
    /**
     * Static class. Private Constructor.
     */
    // @codeCoverageIgnoreStart
    private function __construct()
    {
    }
    // @codeCoverageIgnoreEnd

    /**
     * @param int $start
     * @param int $stop
     * @param int|float $step
     * @return Rewindable
     */
    public static function range(int $start, int $stop, $step = 1): Rewindable
    {
        return
            new Rewindable([G::class, 'range'], $start, $stop, $step);
    }
}
