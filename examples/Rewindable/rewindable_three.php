<?php

use AlecRabbit\Accessories\Rewindable;

require_once __DIR__ . '/../../vendor/autoload.php';

$a = [1 => 1, 'two' => 2, 3 => 3, 'four' => 4];
$genFunc = function () use ($a) {
    yield from $a;
};
foreach (new Rewindable($genFunc) as $key => $item) {
    dump($key . ' => ' . $item);
}
echo PHP_EOL;
