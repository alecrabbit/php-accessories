<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 22:45
 */
declare(strict_types=1);

namespace AlecRabbit;


class BytesFormatter
{
    public static function format(int $bytes, ?string $unit = null, int $decimals = null): string
    {
        return
            format_bytes($bytes, $unit, $decimals);
    }

}