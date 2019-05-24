<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

use AlecRabbit\Accessories\Caller\CallerData;
use AlecRabbit\Accessories\Caller\CallerDataFormatter;
use AlecRabbit\Accessories\Caller\Contracts\CallerConstants;
use AlecRabbit\Reports\Core\AbstractReportable;

class Caller extends AbstractReportable implements CallerConstants
{
    /** @var int */
    protected static $limit = 0;

    /** @var int */
    protected static $options = DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS;

    /** @var array */
    protected $data;

    public function __construct(int $depth = null)
    {
        parent::__construct();
        $this->data = $this->getCallerData($depth ?? 2);
        $this->setBindings(
            CallerData::class,
            CallerDataFormatter::class
        );
    }

    /**
     * @param int $depth
     * @return array
     */
    protected function getCallerData(int $depth): array
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
     * @param null|int $depth
     * @return CallerData
     */
    public static function get(?int $depth = null): CallerData
    {
        /** @var CallerData $report */
        $report = (new static($depth ?? 3))->report();
        return $report;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->assertData($data);
        $this->data = $data;
    }

    protected function assertData(array $data): void
    {
        // TODO check $data
    }
}
