<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Caller\Contracts;

interface CallerDataInterface
{
    public const STR_UNDEFINED = 'UNDEFINED';
    public const UNDEFINED =
        [
            'function' => self::STR_UNDEFINED,
        ];

    public const FUNCTION = 'function';
    public const LINE = 'line';
    public const FILE = 'file';
    public const CLS = 'class';
    public const OBJECT = 'object';
    public const TYPE = 'type';
    public const ARGS = 'args';

    public function __toString(): string;
}
