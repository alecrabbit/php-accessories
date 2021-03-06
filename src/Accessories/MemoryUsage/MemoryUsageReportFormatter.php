<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\MemoryUsage;

use AlecRabbit\Accessories\MemoryUsage\Contracts\MemoryUsageConstants;
use AlecRabbit\Accessories\Pretty;
use AlecRabbit\Formatters\Core\AbstractFormatter;
use AlecRabbit\Reports\Core\Formattable;
use function AlecRabbit\Helpers\bounds;
use function AlecRabbit\str_wrap;
use const AlecRabbit\Helpers\Strings\Constants\BYTES_UNITS;

class MemoryUsageReportFormatter extends AbstractFormatter implements MemoryUsageConstants
{
    /** @var null|array */
    protected static $unitsArray;

    /** @var string */
    protected $units = 'MB';

    /** @var int */
    protected $decimals = 2;

    /** {@inheritDoc} */
    public function __construct(?int $options = null)
    {
        parent::__construct($options);
        $this->options = $options ?? static::OPTION_SHOW_REAL_USAGE;
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
    protected function refineUnits(?string $units): string
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
    protected function refineDecimals(?int $decimals): int
    {
        return (int)bounds($decimals ?? $this->decimals, 0, self::MAX_DECIMALS);
    }

    /**
     * {@inheritdoc}
     */
    public function format(Formattable $report): string
    {
        if ($report instanceof MemoryUsageReport) {
            $diffStr = $this->getDiffStr($report);
            return
                sprintf(
                    self::STRING_FORMAT,
                    Pretty::bytes($report->getUsage(), $this->units, $this->decimals),
                    Pretty::bytes($report->getUsageReal(), $this->units, $this->decimals),
                    Pretty::bytes($report->getPeakUsage(), $this->units, $this->decimals),
                    Pretty::bytes($report->getPeakUsageReal(), $this->units, $this->decimals)
                ) . $diffStr;
        }
        return $this->errorMessage($report, MemoryUsageReport::class);
    }

    /**
     * @param MemoryUsageReport $report
     * @return string
     */
    protected function getDiffStr(MemoryUsageReport $report): string
    {
        if ((null === $usageDiff = $report->getUsageDiff()) || (0 === $usageDiff)) {
            return '';
        }
        return
            ' ' . sprintf(
                self::DIFF_FORMAT,
                $this->prepareBytesString($usageDiff, ' '),
                $this->prepareBytesString($report->getUsageRealDiff(), '(', ')'),
                $this->prepareBytesString($report->getPeakUsageDiff(), ' '),
                $this->prepareBytesString($report->getPeakUsageRealDiff(), '(', ')')
            );
    }

    protected function prepareBytesString(int $value, string $open = '', string $close = ''): string
    {
        return 0 === $value ? '' : str_wrap(Pretty::bytes($value), $open, $close);
    }

    /**
     * @param int $value
     * @param null|string $units
     * @param null|int $decimals
     * @return string
     */
    public function getString(int $value, ?string $units = null, ?int $decimals = null): string
    {
        return
            Pretty::bytes($value, $this->refineUnits($units), $this->refineDecimals($decimals));
    }
}
