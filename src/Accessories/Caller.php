<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

class Caller
{
    public const STR_UNDEFINED = 'UNDEFINED';
    public const UNDEFINED =
        [
            'function' => self::STR_UNDEFINED,
        ];

    /**
     * Static class. Private Constructor.
     */
    private function __construct() // @codeCoverageIgnoreStart
    {
    } // @codeCoverageIgnoreEnd

    public static function get(int $depth = 2): string
    {
        $caller =
            debug_backtrace()[$depth] ?? self::UNDEFINED;
        $type = $caller['type'] ?? '';
        $function = $caller['function'] . '()';
//        dump($caller);
        return
            isset($caller['class']) ?
                $caller['class'] . $type . $function :
                $function;
    }
}
