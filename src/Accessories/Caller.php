<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

/** @experimental */
class Caller
{
    public static function method(int $depth = 2): string
    {
        $caller = (new \Exception())->getTrace()[$depth];
        $r = $caller['function'] . '()';
        if (isset($caller['class'])) {
            $r .= ' in ' . $caller['class'];
        }
        if (isset($caller['object'])) {
            $r .= ' (' . get_class($caller['object']) . ')';
        }
        return $r;
    }
}
