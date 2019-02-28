<?php declare(strict_types=1);

namespace AlecRabbit\Accessories;

class MemoryUsageReport
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
    public function __construct(
        int $usage,
        int $peakUsage,
        int $usageReal,
        int $peakUsageReal
    ) {
        $this->usage = $usage;
        $this->peakUsage = $peakUsage;
        $this->usageReal = $usageReal;
        $this->peakUsageReal = $peakUsageReal;
    }

    public function __toString(): string
    {
        return MemoryUsage::getFormatter()->process($this);
    }

    /**
     * @return int
     */
    public function getUsage(): int
    {
        return $this->usage;
    }

    /**
     * @return int
     */
    public function getPeakUsage(): int
    {
        return $this->peakUsage;
    }

    /**
     * @return int
     */
    public function getUsageReal(): int
    {
        return $this->usageReal;
    }

    /**
     * @return int
     */
    public function getPeakUsageReal(): int
    {
        return $this->peakUsageReal;
    }

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getUsageString(?string $unit = null, ?int $decimals = null): string
    {
        return
            MemoryUsage::getFormatter()->getUsageString($this, $unit, $decimals);
    }

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getPeakUsageString(?string $unit = null, ?int $decimals = null): string
    {
        return
            MemoryUsage::getFormatter()->getPeakUsageString($this, $unit, $decimals);
    }

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getUsageRealString(?string $unit = null, ?int $decimals = null): string
    {
        return
            MemoryUsage::getFormatter()->getUsageRealString($this, $unit, $decimals);
    }

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getPeakUsageRealString(?string $unit = null, ?int $decimals = null): string
    {
        return
            MemoryUsage::getFormatter()->getPeakUsageRealString($this, $unit, $decimals);
    }
}
