<?php declare(strict_types=1);

namespace AlecRabbit\Accessories;

use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReport;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReportFormatter;
use AlecRabbit\Reports\Contracts\ReportInterface;
use AlecRabbit\Reports\Core\Reportable;

class MemoryUsage extends Reportable
{
    /** @var null|MemoryUsageReportFormatter */
    protected static $formatter;

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
    public static function reportStatic(): MemoryUsageReport
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
     * @return MemoryUsageReportFormatter
     */
    public static function getFormatter(): MemoryUsageReportFormatter
    {
        if (null === static::$formatter) {
            static::$formatter = new MemoryUsageReportFormatter();
        }
        return static::$formatter;
    }

    /**
     * @param null|MemoryUsageReportFormatter $formatter
     */
    public static function setFormatter(?MemoryUsageReportFormatter $formatter): void
    {
        self::$formatter = $formatter;
    }

    protected function createEmptyReport(): ReportInterface
    {
        return
            $this->report =
                new MemoryUsageReport(
                    memory_get_usage(),
                    memory_get_peak_usage(),
                    memory_get_usage(true),
                    memory_get_peak_usage(true)
                );
    }
}
