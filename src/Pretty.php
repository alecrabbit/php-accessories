<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 22:45
 */
declare(strict_types=1);

namespace AlecRabbit;

use const AlecRabbit\Helpers\Constants\DEFAULT_PRECISION;

class Pretty
{
    public const DEFAULT_DECIMALS = 2;

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
}
