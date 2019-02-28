<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use AlecRabbit\Accessories\Caller;


function someFunction()
{
    throw new \RuntimeException(Caller::get() . ' called ' . __FUNCTION__ . '()');
}

function usesSomeFunction(): void
{
    someFunction();
}


var_dump(Caller::get()); // object(AlecRabbit\Accessories\Caller\CallerData)
dump((string)Caller::get()); // "UNDEFINED()"
try {
    usesSomeFunction();
} catch (\Exception $e) {
    dump($e->getMessage()); // "usesSomeFunction() called someFunction()"
}
