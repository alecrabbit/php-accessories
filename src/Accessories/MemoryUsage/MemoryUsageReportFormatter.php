<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\MemoryUsage;

use AlecRabbit\Accessories\Contracts\AbstractFormatter;
use AlecRabbit\Accessories\MemoryUsage\Contracts\MemoryUsageConstants;
use AlecRabbit\Accessories\MemoryUsage\Contracts\MemoryUsageReportFormatterInterface;
use AlecRabbit\Accessories\Pretty;
use function AlecRabbit\Helpers\bounds;
use const AlecRabbit\Helpers\Strings\Constants\BYTES_UNITS;

class MemoryUsageReportFormatter extends AbstractFormatter implements MemoryUsageReportFormatterInterface,
    MemoryUsageConstants
{

    /** @var null|array */
    protected static $unitsArray;

    /** @var string */
    protected $units = 'MB';

    /** @var int */
    protected $decimals = 2;

    /**
     * @param mixed $options
     */
    public function __construct($options = null)
    {
        parent::__construct($options);
    }

    /**
     * @param string $units
     */
    public function setUnits(string $units): void
    {
        $this->units = $this->refineUnits($units);
    }

    /**
     * @param null|string $units
     * @return string
     */
    private function refineUnits(?string $units): string
    {
        $units = $units ?? $this->units;
        $this->assertUnits($units);
        return $units;
    }

    /**
     * @param string $units
     */
    protected function assertUnits(string $units): void
    {
        if (false === array_key_exists(strtoupper($units), BYTES_UNITS)) {
            throw new \RuntimeException(
                'Unsupported units: "' . $units . '"'
            );
        }
    }

    /**
     * @param int $decimals
     */
    public function setDecimals(int $decimals): void
    {
        $this->decimals = $this->refineDecimals($decimals);
    }

    /**
     * @param null|int $decimals
     * @return int
     */
    private function refineDecimals(?int $decimals): int
    {
        return (int)bounds($decimals ?? $this->decimals, 0, self::MAX_DECIMALS);
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
        ?string $units = null,
        ?int $decimals = null
    ): string {
        return
            Pretty::bytes($report->getUsage(), $this->refineUnits($units), $this->refineDecimals($decimals));
    }

    /**
     * {@inheritdoc}
     */

    public function getPeakUsageString(
        MemoryUsageReport $report,
        ?string $units = null,
        ?int $decimals = null
    ): string {
        return
            Pretty::bytes($report->getPeakUsage(), $this->refineUnits($units), $this->refineDecimals($decimals));
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageRealString(
        MemoryUsageReport $report,
        ?string $units = null,
        ?int $decimals = null
    ): string {
        return
            Pretty::bytes($report->getUsageReal(), $this->refineUnits($units), $this->refineDecimals($decimals));
    }

    /**
     * {@inheritdoc}
     */
    public function getPeakUsageRealString(
        MemoryUsageReport $report,
        ?string $units = null,
        ?int $decimals = null
    ): string {
        return
            Pretty::bytes(
                $report->getPeakUsageReal(),
                $this->refineUnits($units),
                $this->refineDecimals($decimals)
            );
    }
}
