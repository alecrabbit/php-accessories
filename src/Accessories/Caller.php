<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

/** @experimental */
class Caller
{
    public static function method(int $depth = 3): string
    {
        $caller = static::get($depth);
        $r = '';
        $function = $caller['function'] . '()';
        if (isset($caller['class'])) {
            $type = $caller['type'] ?? '';
            $r .= $caller['class'] . $type . $function;
        } else {
            $r .= $function;
        }
        if (isset($caller['object'])) {
            $r .= ' (' . \get_class($caller['object']) . ')';
        }
        return $r;
    }

    public static function get(int $depth = 2): array
    {
        return
            (new \Exception())->getTrace()[$depth];
    }
}
