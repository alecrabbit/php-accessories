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
}
