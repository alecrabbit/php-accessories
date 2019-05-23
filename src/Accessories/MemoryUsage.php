<?php declare(strict_types=1);

namespace AlecRabbit\Accessories;

use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReport;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReportFormatter;
use AlecRabbit\Reports\Core\AbstractReportable;

class MemoryUsage extends AbstractReportable
{
    public function __construct()
    {
        parent::__construct();
        $this->setBindings(
            MemoryUsageReport::class,
            MemoryUsageReportFormatter::class
        );
    }

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
        /** @var MemoryUsageReport $report */
        $report = (new static)->report();
        return $report;
    }
}
