<?php declare(strict_types=1);

namespace AlecRabbit\Accessories;

use AlecRabbit\Accessories\MemoryUsage\Contracts\MemoryUsageReportFormatterInterface;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReport;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReportFormatter;

class MemoryUsage
{
    /** @var null|MemoryUsageReportFormatterInterface */
    protected static $formatter;

    /**
     * Static class. Private Constructor.
     */
    protected function __construct() // @codeCoverageIgnoreStart
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
     * @return MemoryUsageReport
     */
    public static function report(): MemoryUsageReport
    {
        return
            new MemoryUsageReport(
                memory_get_usage(),
                memory_get_peak_usage(),
                memory_get_usage(true),
                memory_get_peak_usage(true)
            );
    }

    /**
     * @return MemoryUsageReportFormatterInterface
     */
    public static function getFormatter(): MemoryUsageReportFormatterInterface
    {
        if (null === static::$formatter) {
            static::$formatter = new MemoryUsageReportFormatter();
        }
        return static::$formatter;
    }

    /**
     * @param null|MemoryUsageReportFormatterInterface $formatter
     */
    public static function setFormatter(?MemoryUsageReportFormatterInterface $formatter): void
    {
        self::$formatter = $formatter;
    }
}
