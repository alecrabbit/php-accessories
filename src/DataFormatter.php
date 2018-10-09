<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 22:45
 */
declare(strict_types=1);

namespace AlecRabbit;


class DataFormatter
{
    const
        UNITS =
        [
            'B' => 0,
            'KB' => 1,
            'MB' => 2,
            'GB' => 3,
            'TB' => 4,
            'PB' => 5,
            'EB' => 6,
            'ZB' => 7,
            'YB' => 8
        ];

    public static function format(int $bytes, $unit = null, $decimals = null): string
    {
        $negative = false;
        if ($bytes < 0) {
            $bytes = abs($bytes);
            $negative = true;
        }
        $value = 0;
        $unit = strtoupper($unit ?? '');
        if ($bytes > 0) {
            // Generate automatic prefix by bytes
            // If wrong prefix given
            if (!array_key_exists($unit, static::UNITS)) {
                $pow = floor(log($bytes) / log(1024));
                $unit = array_search($pow, static::UNITS);
            }
            // Calculate byte value by prefix
            $value = ($bytes / pow(1024, floor(static::UNITS[$unit])));
        } else {
            $unit = 'B';
        }

        // If decimals is not numeric or decimals is less than 0
        if (!is_numeric($decimals) || $decimals < 0) {
            // set default value
            $decimals = 2;
        } elseif ($decimals > 24) {
            $decimals = 24;
        }

        // Format output
        return
            sprintf('%s%.' . $decimals . 'f' . $unit, $negative ? '-' : '', $value);
    }

}