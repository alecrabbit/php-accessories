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
}
