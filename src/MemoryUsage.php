<?php
/**
 * User: alec
 * Date: 12.10.18
 * Time: 17:45
 */

namespace AlecRabbit;


class MemoryUsage
{
    public static function get(bool $real = false, ?string $unit = null, int $decimals = null): string
    {
        return
            format_bytes(memory_get_usage($real), $unit, $decimals);
    }

    public static function getPeak(bool $real = false, ?string $unit = null, int $decimals = null): string
    {
        return
            format_bytes(memory_get_peak_usage($real), $unit, $decimals);
    }
}