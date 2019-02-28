<?php declare(strict_types=1);

namespace AlecRabbit\Accessories;

class MemoryUsageReport
{
    public const STRING_FORMAT = 'Memory: %s(%s) Real: %s(%s)';
    /** @var int */
    protected $usage;
    /** @var int */
    protected $peakUsage;
    /** @var int */
    protected $usageReal;
    /** @var int */
    protected $peakUsageReal;
    /** @var string */
    protected $unit = 'Mb';
    /** @var int */
    protected $decimals = 2;

    /**
     * MemoryUsageReport constructor.
     * @param int $usage
     * @param int $peakUsage
     * @param int $usageReal
     * @param int $peakUsageReal
     * @param null|string $unit
     * @param null|int $decimals
     */
    public function __construct(
        int $usage,
        int $peakUsage,
        int $usageReal,
        int $peakUsageReal,
        ?string $unit = null,
        ?int $decimals = null
    ) {
        $this->usage = $usage;
        $this->peakUsage = $peakUsage;
        $this->usageReal = $usageReal;
        $this->peakUsageReal = $peakUsageReal;
        if (null !== $unit) {
            $this->unit = $unit;
        }
        if (null !== $decimals) {
            $this->decimals = $decimals;
        }
    }

    public function __toString(): string
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
            Pretty::bytes($this->usage, $unit ?? $this->unit, $decimals ?? $this->decimals);
    }

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getPeakUsageString(?string $unit = null, ?int $decimals = null): string
    {
        return
            Pretty::bytes($this->peakUsage, $unit ?? $this->unit, $decimals ?? $this->decimals);
    }

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getUsageRealString(?string $unit = null, ?int $decimals = null): string
    {
        return
            Pretty::bytes($this->usageReal, $unit ?? $this->unit, $decimals ?? $this->decimals);
    }

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getPeakUsageRealString(?string $unit = null, ?int $decimals = null): string
    {
        return
            Pretty::bytes($this->peakUsageReal, $unit ?? $this->unit, $decimals ?? $this->decimals);
    }
}
