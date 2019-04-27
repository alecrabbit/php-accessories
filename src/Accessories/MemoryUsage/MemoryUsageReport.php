<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\MemoryUsage;

use AlecRabbit\Accessories\MemoryUsage;
use AlecRabbit\Reports\Contracts\ReportableInterface;
use AlecRabbit\Reports\Contracts\ReportInterface;
use AlecRabbit\Reports\Core\AbstractReport;

class MemoryUsageReport extends AbstractReport implements MemoryUsageReportInterface
{
    /** @var int */
    protected $usage;

    /** @var int */
    protected $peakUsage;

    /** @var int */
    protected $usageReal;

    /** @var int */
    protected $peakUsageReal;

    /**
     * MemoryUsageReport constructor.
     * @param int $usage
     * @param int $peakUsage
     * @param int $usageReal
     * @param int $peakUsageReal
     */
    public function __construct(int $usage, int $peakUsage, int $usageReal, int $peakUsageReal)
    {
        $this->usage = $usage;
        $this->peakUsage = $peakUsage;
        $this->usageReal = $usageReal;
        $this->peakUsageReal = $peakUsageReal;
    }

    public function __toString(): string
    {
        return MemoryUsage::getFormatter()->format($this);
    }

    public function buildOn(ReportableInterface $reportable): ReportInterface
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsage(): int
    {
        return $this->usage;
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsage(): int
    {
        return $this->peakUsage;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageReal(): int
    {
        return $this->usageReal;
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageReal(): int
    {
        return $this->peakUsageReal;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageString(?string $unit = null, ?int $decimals = null): string
    {
        return
            MemoryUsage::getFormatter()->getUsageString($this, $unit, $decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageString(?string $unit = null, ?int $decimals = null): string
    {
        return
            MemoryUsage::getFormatter()->getPeakUsageString($this, $unit, $decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageRealString(?string $unit = null, ?int $decimals = null): string
    {
        return
            MemoryUsage::getFormatter()->getUsageRealString($this, $unit, $decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageRealString(?string $unit = null, ?int $decimals = null): string
    {
        return
            MemoryUsage::getFormatter()->getPeakUsageRealString($this, $unit, $decimals);
    }
}
