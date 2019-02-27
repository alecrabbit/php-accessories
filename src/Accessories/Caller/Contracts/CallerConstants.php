<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Caller\Contracts;

interface CallerConstants
{
    public const FUNCTION = 'function';
    public const LINE = 'line';
    public const FILE = 'file';
    public const CLS = 'class';
    public const OBJECT = 'object';
    public const TYPE = 'type';
    public const ARGS = 'args';

    public const STR_UNDEFINED = 'undefined';

    public const UNDEFINED =
        [
            self::FUNCTION => self::STR_UNDEFINED,
        ];
    public const SHOW_LINE_AND_FILE = 1 << 0;
}
