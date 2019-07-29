<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\MemoryUsage;

interface MemoryUsageReportInterface
{
    /**
     * @return int
     */
    public function getUsage(): int;

    /**
     * @return int
     */
    public function getPeakUsage(): int;

    /**
     * @return int
     */
    public function getUsageReal(): int;

    /**
     * @return int
     */
    public function getPeakUsageReal(): int;

    /**
     * @return int
     */
    public function getUsageDiff(): int;

    /**
     * @return int
     */
    public function getPeakUsageDiff(): int;

    /**
     * @return int
     */
    public function getUsageRealDiff(): int;

    /**
     * @return int
     */
    public function getPeakUsageRealDiff(): int;

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getUsageString(?string $unit = null, ?int $decimals = null): string;

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getPeakUsageString(?string $unit = null, ?int $decimals = null): string;

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getUsageRealString(?string $unit = null, ?int $decimals = null): string;

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getPeakUsageRealString(?string $unit = null, ?int $decimals = null): string;

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getUsageDiffString(?string $unit = null, ?int $decimals = null): string;

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getPeakUsageDiffString(?string $unit = null, ?int $decimals = null): string;

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getUsageRealDiffString(?string $unit = null, ?int $decimals = null): string;

    /**
     * @param null|string $unit
     * @param null|int $decimals
     * @return string
     */
    public function getPeakUsageRealDiffString(?string $unit = null, ?int $decimals = null): string;
}
