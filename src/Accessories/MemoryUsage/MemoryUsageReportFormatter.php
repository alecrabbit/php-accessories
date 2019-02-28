<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\MemoryUsage;

use AlecRabbit\Accessories\Contracts\AbstractFormatter;
use AlecRabbit\Accessories\MemoryUsage\Contracts\MemoryUsageReportFormatterInterface;
use AlecRabbit\Accessories\MemoryUsageReport;
use AlecRabbit\Accessories\Pretty;

class MemoryUsageReportFormatter extends AbstractFormatter implements MemoryUsageReportFormatterInterface
{
    public const STRING_FORMAT = 'Memory: %s(%s) Real: %s(%s)';

    /**
     * {@inheritdoc}
     */
    public function process(MemoryUsageReport $report): string
    {
        return
            sprintf(
                self::STRING_FORMAT,
                Pretty::bytes($this->usage, $this->unit, $this->decimals),
                Pretty::bytes($this->peakUsage, $this->unit, $this->decimals),
                Pretty::bytes($this->usageReal, $this->unit, $this->decimals),
                Pretty::bytes($this->peakUsageReal, $this->unit, $this->decimals)
            );
    }
}
