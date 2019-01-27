<?php

declare(strict_types=1);

namespace AlecRabbit;

use function AlecRabbit\Helpers\bounds;
use const AlecRabbit\Helpers\Constants\DEFAULT_PRECISION;

class Pretty
{
    public const DEFAULT_DECIMALS = 2;
    public const PERCENT_MAX_DECIMALS = 4;
    public const DEC_POINT = '.';
    public const THOUSANDS_SEPARATOR = ',';

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
            format_time($value, $units, $precision ?? DEFAULT_PRECISION);
    }

    /**
     * @param float $relative
     * @param null|int $decimals
     * @param null|string $prefix
     * @param null|string $suffix
     * @return string
     */
    public static function percent(
        float $relative,
        ?int $decimals = null,
        ?string $prefix = null,
        string $suffix = '%'
    ): string {
        $prefix = $prefix ?? '';
        $suffix = $suffix ?? '';
        $decimals =
            (int)bounds($decimals ??  static::DEFAULT_DECIMALS, 0, static::PERCENT_MAX_DECIMALS);
        return
            $prefix .
            number_format(
                $relative * 100, $decimals,
                static::DEC_POINT,
                static::THOUSANDS_SEPARATOR
            ) .
            $suffix;
    }


}
