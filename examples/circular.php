<?php

require_once __DIR__ . '/../vendor/autoload.php';

use AlecRabbit\Circular;

$c = new Circular([1, 2, 3]);

var_dump($c->getElement()); // int(1)
var_dump($c->getElement()); // int(2)
var_dump($c->getElement()); // int(3)
var_dump($c->getElement()); // int(1)

// or you can invoke $c
var_dump($c()); // int(2)
var_dump($c()); // int(3)
var_dump($c()); // int(1)

foreach ($c as $item) {
    var_dump($item); // int(1..3)
}

foreach ($c as $item) {
    var_dump($item); // int(1..3)
}