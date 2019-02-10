<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

class MemoryUsage
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
     * @param bool $real
     * @param null|string $unit
     * @param int|null $decimals
     * @return string
     */
    public static function get(bool $real = false, ?string $unit = null, ?int $decimals = null): string
    {
        return
            Pretty::bytes(memory_get_usage($real), $unit, $decimals);
    }

    /**
     * @param bool $real
     * @param null|string $unit
     * @param int|null $decimals
     * @return string
     */
    public static function getPeak(bool $real = false, ?string $unit = null, ?int $decimals = null): string
    {
        return
            Pretty::bytes(memory_get_peak_usage($real), $unit, $decimals);
    }

    public static function report(?string $unit = null, ?int $decimals = null): MemoryUsageReport
    {
        return new MemoryUsageReport(
            memory_get_usage(),
            memory_get_peak_usage(),
            memory_get_usage(true),
            memory_get_peak_usage(true),
            $unit,
            $decimals
        );
    }
}
