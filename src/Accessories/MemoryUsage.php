<?php declare(strict_types=1);

namespace AlecRabbit\Accessories;

class MemoryUsage
{
    /**
     * Static class. Private Constructor.
     */
    private function __construct() // @codeCoverageIgnoreStart
    {
    } // @codeCoverageIgnoreEnd

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

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return MemoryUsageReport
     */
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
