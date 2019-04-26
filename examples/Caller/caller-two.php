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
var_dump((string)Caller::get()); // "Undefined"
try {
    usesSomeFunction();
} catch (\Exception $e) {
    var_dump($e->getMessage()); // "[22:"/var/www/examples/Caller/caller-two.php"] usesSomeFunction() called someFunction()"
}
