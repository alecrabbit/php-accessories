<?php

require_once __DIR__ . '/../vendor/autoload.php';

use AlecRabbit\Circular;

$c = new Circular([1, 2, 3]);

var_dump($c->getElement()); // int(1)
var_dump($c->getElement()); // int(2)
var_dump($c->getElement()); // int(3)
var_dump($c->getElement()); // int(1)