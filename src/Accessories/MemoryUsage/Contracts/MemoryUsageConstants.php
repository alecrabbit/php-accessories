<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\MemoryUsage\Contracts;

interface MemoryUsageConstants
{
    public const STRING_FORMAT = 'Memory: %s(%s) Peak: %s(%s)';
    public const SHOW_REAL_USAGE = 1 << 0;
    public const MAX_DECIMALS = 3;
}
