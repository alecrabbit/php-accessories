<?php

declare(strict_types=1);

namespace AlecRabbit;

use function AlecRabbit\Helpers\bounds;
use const AlecRabbit\Helpers\Constants\DEFAULT_PRECISION;

class Pretty
{
    public const DEFAULT_DECIMALS = 2;
    public const PERCENT_MAX_DECIMALS = 4;
    public const DECIMAL_POINT = '.';
    public const THOUSANDS_SEPARATOR = '';
    public const DEFAULT_PRECISION = DEFAULT_PRECISION;

    /** @var null|string */
    protected static $decimalPoint;
    /** @var null|string */
    protected static $thousandsSeparator;
    /** @var null|int */
    protected static $percentMaxDecimals;

    /**
     * Static class. Private Constructor.
     */
    // @codeCoverageIgnoreStart
    private function __construct()
    {
    }
    // @codeCoverageIgnoreEnd

    /**
     * @param int $number
     * @param null|string $unit
     * @param int|null $decimals
     * @return string
     */
    public static function bytes(int $number, ?string $unit = null, ?int $decimals = null): string
    {
        return
            format_bytes($number, $unit, $decimals ?? static::DEFAULT_DECIMALS);
    }

    /**
     * @param float $value
     * @param int|null $units
     * @param int|null $precision
     * @return string
     */
    public static function time(float $value, ?int $units = null, ?int $precision = null): string
    {
        if (null === $units && null === $precision) {
            return format_time_auto($value);
        }
        return
            format_time($value, $units, $precision ?? static::DEFAULT_PRECISION);
    }

    /**
     * @param float $fraction
     * @param null|int $decimals
     * @param null|string $prefix
     * @param string $suffix
     * @return string
     */
    public static function percent(
        float $fraction,
        ?int $decimals = null,
        ?string $prefix = null,
        string $suffix = '%'
    ): string {
        $decimals =
            (int) bounds(
                $decimals ?? static::DEFAULT_DECIMALS,
                0,
                static::$percentMaxDecimals ?? static::PERCENT_MAX_DECIMALS
            );
        return
            ($prefix ?? '') .
            number_format(
                $fraction * 100,
                $decimals,
                static::$decimalPoint ?? static::DECIMAL_POINT,
                static::$thousandsSeparator ?? static::THOUSANDS_SEPARATOR
            ) .
            $suffix;
    }

    /**
     * @param string $decimalPoint
     */
    public static function setDecimalPoint(string $decimalPoint): void
    {
        self::$decimalPoint = $decimalPoint;
    }

    /**
     * @param string $thousandsSeparator
     */
    public static function setThousandsSeparator(string $thousandsSeparator): void
    {
        self::$thousandsSeparator = $thousandsSeparator;
    }

    /**
     * @param int $percentMaxDecimals
     */
    public static function setPercentMaxDecimals(int $percentMaxDecimals): void
    {
        self::$percentMaxDecimals = abs($percentMaxDecimals);
    }

    public static function resetDecimalPoint(): void
    {
        self::$decimalPoint = null;
    }

    public static function resetThousandsSeparator(): void
    {
        self::$thousandsSeparator = null;
    }

    public static function resetPercentMaxDecimals(): void
    {
        self::$percentMaxDecimals = null;
    }
}
