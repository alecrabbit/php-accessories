<?php

declare(strict_types=1);

namespace AlecRabbit;

use function AlecRabbit\Helpers\bounds;
use const AlecRabbit\Helpers\Constants\DEFAULT_PRECISION;

class Pretty
{
    public const DEFAULT_DECIMALS = 2;
    public const MAX_DECIMALS = 6;
    public const DECIMAL_POINT = '.';
    public const THOUSANDS_SEPARATOR = '';
    public const DEFAULT_PRECISION = DEFAULT_PRECISION;

    /** @var null|string */
    protected static $decimalPoint;
    /** @var null|string */
    protected static $thousandsSeparator;
    /** @var null|int */
    protected static $maxDecimals;

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
            format_bytes($number, $unit, static::refineDecimals($decimals));
    }

    /**
     * @param null|int $decimals
     * @return int
     */
    public static function refineDecimals(?int $decimals): int
    {

        return
            (int)bounds(
                $decimals ?? static::DEFAULT_DECIMALS,
                0,
                static::$maxDecimals ?? static::MAX_DECIMALS
            );
    }

    /**
     * @param float $seconds
     * @param int|null $units
     * @param int|null $decimals
     * @return string
     */
    public static function time(float $seconds, ?int $units = null, ?int $decimals = null): string
    {
        if (null === $units && null === $decimals) {
            return format_time_auto($seconds);
        }
        return
            format_time(
                $seconds,
                $units,
                static::refineDecimals($decimals),
                static::$decimalPoint ?? static::DECIMAL_POINT,
                static::$thousandsSeparator ?? static::THOUSANDS_SEPARATOR
            );
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
        return
            ($prefix ?? '') .
            number_format(
                $fraction * 100,
                static::refineDecimals($decimals),
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
     * @param int $maxDecimals
     */
    public static function setMaxDecimals(int $maxDecimals): void
    {
        self::$maxDecimals = abs($maxDecimals);
    }

    public static function resetDecimalPoint(): void
    {
        self::$decimalPoint = null;
    }

    public static function resetThousandsSeparator(): void
    {
        self::$thousandsSeparator = null;
    }

    public static function resetMaxDecimals(): void
    {
        self::$maxDecimals = null;
    }
}
