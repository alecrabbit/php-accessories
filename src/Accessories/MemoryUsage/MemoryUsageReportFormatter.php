<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\MemoryUsage;

use AlecRabbit\Accessories\Contracts\AbstractFormatter;
use AlecRabbit\Accessories\MemoryUsage\Contracts\MemoryUsageReportFormatterInterface;
use AlecRabbit\Accessories\Pretty;
use function AlecRabbit\Helpers\bounds;
use const AlecRabbit\Helpers\Strings\Constants\BYTES_UNITS;

class MemoryUsageReportFormatter extends AbstractFormatter implements MemoryUsageReportFormatterInterface
{
    public const STRING_FORMAT = 'Memory: %s(%s) Real: %s(%s)';
    public const MAX_DECIMALS = 3;
    /** @var array */
    private static $unitsArray;

    /** @var string */
    protected $units = 'MB';

    /** @var int */
    protected $decimals = 2;

    /**
     * @param string $units
     */
    public function setUnits(string $units): void
    {
        $this->assertUnits($units);
        $this->units = $units;
    }

    protected function assertUnits(string $units)
    {
        if (null === static::$unitsArray) {
            static::$unitsArray = array_keys(BYTES_UNITS);
        }
        if (false === in_array(strtoupper($units), static::$unitsArray, true)) {
            throw new \RuntimeException(
                'Unsupported units: "' . $units .'"'
            );
        }
    }

    /**
     * @param int $decimals
     */
    public function setDecimals(int $decimals): void
    {
        $this->decimals = (int)bounds($decimals, 0, self::MAX_DECIMALS);
    }

    /**
     * {@inheritdoc}
     */
    public function process(MemoryUsageReport $report): string
    {
        return
            sprintf(
                self::STRING_FORMAT,
                Pretty::bytes($report->getUsage(), $this->units, $this->decimals),
                Pretty::bytes($report->getPeakUsage(), $this->units, $this->decimals),
                Pretty::bytes($report->getUsageReal(), $this->units, $this->decimals),
                Pretty::bytes($report->getPeakUsageReal(), $this->units, $this->decimals)
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageString(
        MemoryUsageReport $report,
        ?string $unit = null,
        ?int $decimals = null
    ): string {
        return
            Pretty::bytes($report->getUsage(), $unit ?? $this->units, $decimals ?? $this->decimals);
    }

    /**
     * {@inheritdoc}
     */

    public function getPeakUsageString(
        MemoryUsageReport $report,
        ?string $unit = null,
        ?int $decimals = null
    ): string {
        return
            Pretty::bytes($report->getPeakUsage(), $unit ?? $this->units, $decimals ?? $this->decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageRealString(
        MemoryUsageReport $report,
        ?string $unit = null,
        ?int $decimals = null
    ): string {
        return
            Pretty::bytes($report->getUsageReal(), $unit ?? $this->units, $decimals ?? $this->decimals);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageRealString(
        MemoryUsageReport $report,
        ?string $unit = null,
        ?int $decimals = null
    ): string {
        return
            Pretty::bytes(
                $report->getPeakUsageReal(),
                $unit ?? $this->units,
                $decimals ?? $this->decimals
            );
    }
}
