<?php

use AlecRabbit\Accessories\Circular;

require_once __DIR__ . '/../../vendor/autoload.php';

$expected = [1=> 1,'two' => 2, 3 => 3, 'four' => 4];
$genFunc = function () use ($expected) {
    yield from $expected;
};
$c = new Circular($genFunc);

var_dump($c->value());
var_dump($c->value());
var_dump($c->value());
var_dump($c->value());

foreach ($c as $item) {
    var_dump($item); //
}

foreach ($c as $item) {
    var_dump($item); //
}