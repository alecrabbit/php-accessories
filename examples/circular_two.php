<?php

require_once __DIR__ . '/../vendor/autoload.php';

use AlecRabbit\Circular;

// to clarify Circular gets array as parameter
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

