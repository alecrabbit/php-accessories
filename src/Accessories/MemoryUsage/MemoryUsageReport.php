<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\MemoryUsage;

use AlecRabbit\Formatters\Contracts\FormatterInterface;
use AlecRabbit\Reports\Core\AbstractReport;
use AlecRabbit\Reports\Core\AbstractReportable;

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

    /** @var int */
    protected $usageDiff;

    /** @var int */
    protected $peakUsageDiff;

    /** @var int */
    protected $usageRealDiff;

    /** @var int */
    protected $peakUsageRealDiff;

    /** @var null|MemoryUsageReportFormatter */
    protected $formatter;

    /**
     * MemoryUsageReport constructor.
     * @param int $usage
     * @param int $peakUsage
     * @param int $usageReal
     * @param int $peakUsageReal
     * @param FormatterInterface|null $formatter
     * @param AbstractReportable|null $reportable
     */
    public function __construct(
        int $usage = null,
        int $peakUsage = null,
        int $usageReal = null,
        int $peakUsageReal = null,
        FormatterInterface $formatter = null,
        AbstractReportable $reportable = null
    ) {
        parent::__construct($formatter, $reportable);
        $this->usage = $usage ?? memory_get_usage();
        $this->peakUsage = $peakUsage ?? memory_get_peak_usage();
        $this->usageReal = $usageReal ?? memory_get_usage(true);
        $this->peakUsageReal = $peakUsageReal ?? memory_get_peak_usage(true);
        $this->usageDiff = $this->usage;
        $this->peakUsageDiff = $this->peakUsage;
        $this->usageRealDiff = $this->usageReal;
        $this->peakUsageRealDiff = $this->peakUsageReal;
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
    public function getUsageDiff(): int
    {
        return $this->usageDiff;
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageDiff(): int
    {
        return $this->peakUsageDiff;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageRealDiff(): int
    {
        return $this->usageRealDiff;
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageRealDiff(): int
    {
        return $this->peakUsageRealDiff;
    }


    /**
     * {@inheritdoc}
     */
    public function getUsageString(?string $unit = null, ?int $decimals = null): string
    {
        return $this->prepareString($this->usage, $unit, $decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageString(?string $unit = null, ?int $decimals = null): string
    {
        return $this->prepareString($this->peakUsage, $unit, $decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageRealString(?string $unit = null, ?int $decimals = null): string
    {
        return $this->prepareString($this->usageReal, $unit, $decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageRealString(?string $unit = null, ?int $decimals = null): string
    {
        return $this->prepareString($this->peakUsageReal, $unit, $decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageDiffString(?string $unit = null, ?int $decimals = null): string
    {
        return $this->prepareString($this->usageDiff, $unit, $decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageDiffString(?string $unit = null, ?int $decimals = null): string
    {
        return $this->prepareString($this->peakUsageDiff, $unit, $decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageRealDiffString(?string $unit = null, ?int $decimals = null): string
    {
        return $this->prepareString($this->usageRealDiff, $unit, $decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageRealDiffString(?string $unit = null, ?int $decimals = null): string
    {
        return $this->prepareString($this->peakUsageRealDiff, $unit, $decimals);
    }

    /**
     * @param int $forValue
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    protected function prepareString(int $forValue, ?string $unit = null, ?int $decimals = null): string
    {
        if ($this->formatter instanceof MemoryUsageReportFormatter) {
            return
                $this->formatter->getString($forValue, $unit, $decimals);
        }
        // @codeCoverageIgnoreStart
        return 'WRONG FORMATTER TYPE: ' . get_class($this->formatter);
        // @codeCoverageIgnoreEnd
    }

    public function diff(MemoryUsageReport $firstReport): self
    {
        $this->usageDiff         = $this->usage - $firstReport->usage;
        $this->peakUsageDiff     = $this->peakUsage - $firstReport->peakUsage;
        $this->usageRealDiff     = $this->usageReal - $firstReport->usageReal;
        $this->peakUsageRealDiff = $this->peakUsageReal - $firstReport->peakUsageReal;
        return $this;
    }
}
