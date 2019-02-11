<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use AlecRabbit\Accessories\Caller;

class CallingClass {
    public function __construct()
    {
        $c = new SomeStupidClass();
        $c->usesSomeFunction();
    }
}

class SomeStupidClass
{
    public function usesSomeFunction(): void
    {
        someFunction();
    }

    public static function usesSomeFunctionStatic(): void
    {
        someFunction();
    }
}

function someFunction()
{
    throw new \RuntimeException(Caller::method() . ' called this function');
}

function usesSomeFunction(): void
{
    someFunction();
}


try {
    usesSomeFunction();
} catch (\Exception $e) {
    dump($e->getMessage());
//    var_dump($e);
}

try {
    $c = new CallingClass();
} catch (\Exception $e) {
    dump($e->getMessage());
//    var_dump($e);
}


$s = new SomeStupidClass();
try {
    $s->usesSomeFunction();
} catch (\Exception $e) {
    dump($e->getMessage());
//    var_dump($e);
}

try {
    SomeStupidClass::usesSomeFunctionStatic();
} catch (\Exception $e) {
    dump($e->getMessage());
//    var_dump($e);
}


