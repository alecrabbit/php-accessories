<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

use AlecRabbit\Accessories\Caller\CallerData;
use AlecRabbit\Accessories\Caller\CallerDataFormatter;
use AlecRabbit\Accessories\Caller\Contracts\CallerConstants;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataFormatterInterface;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataInterface;

class Caller implements CallerConstants
{
    /** @var null|CallerDataFormatterInterface */
    protected static $formatter;

    /** @var int */
    protected static $limit = 0;

    /** @var int */
    protected static $options = DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS;

    /**
     * Static class. Private Constructor.
     */
    private function __construct() // @codeCoverageIgnoreStart
    {
    } // @codeCoverageIgnoreEnd

    /**
     * @param null|int $depth
     * @return CallerDataInterface
     */
    public static function get(?int $depth = null): CallerDataInterface
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
    private static function getCallerData(int $depth): array
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

    /**
     * @return CallerDataFormatterInterface
     */
    public static function getFormatter(): CallerDataFormatterInterface
    {
        if (null === static::$formatter) {
            static::$formatter = new CallerDataFormatter();
        }
        return static::$formatter;
    }

    /**
     * @param CallerDataFormatterInterface $formatter
     */
    public static function setFormatter(CallerDataFormatterInterface $formatter): void
    {
        self::$formatter = $formatter;
    }
}
