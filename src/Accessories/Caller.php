<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

use AlecRabbit\Accessories\Caller\CallerData;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataFormatterInterface;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataInterface;

class Caller
{

    /**
     * Static class. Private Constructor.
     */
    private function __construct() // @codeCoverageIgnoreStart
    {
    } // @codeCoverageIgnoreEnd

    public static function get(int $depth = 2, ?CallerDataFormatterInterface $formatter = null): CallerDataInterface
    {
        return
            new CallerData($depth + 1, $formatter);
    }
//    public static function get(int $depth = 2): string
//    {
//        $caller =
//            debug_backtrace()[$depth] ?? self::UNDEFINED;
//        $type = $caller['type'] ?? '';
//        $function = $caller['function'] . '()';
////        dump($caller);
//        return
//            isset($caller['class']) ?
//                $caller['class'] . $type . $function :
//                $function;
//    }
}
