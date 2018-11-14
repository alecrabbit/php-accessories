<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 22:45
 */
declare(strict_types=1);

namespace AlecRabbit;


class SimpleFormatter
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

}