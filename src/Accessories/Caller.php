<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

use AlecRabbit\Accessories\Caller\CallerData;
use AlecRabbit\Accessories\Caller\CallerDataFormatter;
use AlecRabbit\Accessories\Caller\Contracts\CallerConstants;
use AlecRabbit\Reports\Contracts\ReportInterface;
use AlecRabbit\Reports\Core\Reportable;

class Caller extends Reportable implements CallerConstants
{
    /** @var null|CallerDataFormatter */
    protected static $formatter;

    /** @var int */
    protected static $limit = 0;

    /** @var int */
    protected static $options = DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS;

    /**
     * @return CallerDataFormatter
     */
    public static function getFormatter(): CallerDataFormatter
    {
        if (null === static::$formatter) {
            static::$formatter = new CallerDataFormatter();
        }
        return static::$formatter;
    }

    /**
     * @param CallerDataFormatter $formatter
     */
    public static function setFormatter(CallerDataFormatter $formatter): void
    {
        self::$formatter = $formatter;
    }

    protected function createEmptyReport(): ReportInterface
    {
        return static::get(3);
    }

    /**
     * @param null|int $depth
     * @return CallerData
     */
    public static function get(?int $depth = null): CallerData
    {
        return
            new CallerData(
                self::getCallerData($depth ?? 2)
            );
    }

    /**
     * @param int $depth
     * @return array
     */
    protected static function getCallerData(int $depth): array
    {
        return
            debug_backtrace(static::getOptions(), static::getLimit())[++$depth] ?? self::UNDEFINED;
    }

    /**
     * @return int
     */
    public static function getOptions(): int
    {
        return self::$options;
    }

    /**
     * @param int $options
     */
    public static function setOptions(int $options): void
    {
        self::$options = $options;
    }

    /**
     * @return int
     */
    public static function getLimit(): int
    {
        return self::$limit;
    }

    /**
     * @param int $limit
     */
    public static function setLimit(int $limit): void
    {
        self::$limit = $limit;
    }
}
