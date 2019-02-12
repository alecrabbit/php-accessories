<?php

use AlecRabbit\Accessories\Circular;

require_once __DIR__ . '/../../vendor/autoload.php';


$c = new Circular([1, 2, 3]);

var_dump($c->value()); // int(1)
var_dump($c->value()); // int(2)
var_dump($c->value()); // int(3)
var_dump($c->value()); // int(1)

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