<?php

use AlecRabbit\Accessories\Circular;

require_once __DIR__ . '/../../vendor/autoload.php';

// array of anything
$c = new Circular([
    0.1,
    'a',
    new stdClass(),
    function () {
    },
]);

// you can invoke $c
var_dump($c());

// or use as iterator
foreach ($c as $item) {
    var_dump($item);
}

