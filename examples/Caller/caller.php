<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use AlecRabbit\Accessories\Caller;

class SomeStupidClass
{
    public static function usesSomeFunctionStatic(): void
    {
        someFunction();
    }

    public function usesSomeFunction(): void
    {
        someFunction();
    }
}

function someFunction()
{
    throw new \RuntimeException(Caller::get() . ' called ' . __FUNCTION__. '()');
}

function usesSomeFunction(): void
{
    someFunction();
}


try {
    usesSomeFunction();
} catch (\Exception $e) {
    dump($e->getMessage()); // "usesSomeFunction() called someFunction()"
//    var_dump($e);
}

$s = new SomeStupidClass();
try {
    $s->usesSomeFunction();
} catch (\Exception $e) {
    dump($e->getMessage()); // "SomeStupidClass->usesSomeFunction() called someFunction()"
//    var_dump($e);
}

try {
    SomeStupidClass::usesSomeFunctionStatic();
} catch (\Exception $e) {
    dump($e->getMessage()); // "SomeStupidClass::usesSomeFunctionStatic() called someFunction()"
//    var_dump($e);
}




