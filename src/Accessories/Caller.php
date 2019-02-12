<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

class Caller
{
    public const UNDEFINED = 'UNDEFINED';

    /**
     * Static class. Private Constructor.
     */
    // @codeCoverageIgnoreStart
    private function __construct()
    {
    }

    // @codeCoverageIgnoreEnd

    public static function get(int $depth = 2): string
    {
        $caller =
            debug_backtrace()[$depth] ?? ['function' => static::UNDEFINED];
        $type = $caller['type'] ?? '';
        $function = $caller['function'] . '()';
        return
            isset($caller['class']) ?
                $caller['class'] . $type . $function :
                $function;
    }
}
