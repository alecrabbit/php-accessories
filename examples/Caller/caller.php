<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use AlecRabbit\Accessories\Caller;

class SomeStupidClass
{
    public function usesSomeFunction(): void
    {
        someFunction();
    }
}

function someFunction()
{
    throw new \RuntimeException(Caller::method() . ' called this function');
}


$s = new SomeStupidClass();
try {
    $s->usesSomeFunction();
} catch (\Exception $e) {
    var_dump($e);
}


