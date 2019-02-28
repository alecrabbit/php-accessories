<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\MemoryUsage\Contracts;

use AlecRabbit\Accessories\MemoryUsageReport;

interface MemoryUsageReportFormatterInterface
{
    /**
     * @param MemoryUsageReport $report
     * @return string
     */
    public function process(MemoryUsageReport $report): string;

    /**
     * @param MemoryUsageReport $param
     * @param null|string $unit
     * @param null|int $decimals
     * @return mixed
     */
    public function getUsageString(MemoryUsageReport $param, ?string $unit, ?int $decimals);

    /**
     * @param MemoryUsageReport $param
     * @param null|string $unit
     * @param null|int $decimals
     * @return mixed
     */
    public function getPeakUsageString(MemoryUsageReport $param, ?string $unit, ?int $decimals);

    /**
     * @param MemoryUsageReport $param
     * @param null|string $unit
     * @param null|int $decimals
     * @return mixed
     */
    public function getUsageRealString(MemoryUsageReport $param, ?string $unit, ?int $decimals);

    /**
     * @param MemoryUsageReport $param
     * @param null|string $unit
     * @param null|int $decimals
     * @return mixed
     */
    public function getPeakUsageRealString(MemoryUsageReport $param, ?string $unit, ?int $decimals);
}
