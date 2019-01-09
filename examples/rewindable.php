<?php

use AlecRabbit\G;

require_once __DIR__ . '/../vendor/autoload.php';

$generatorFunction =
    function ($start, $stop) {
        return G::range($start, $stop);
    };
$r = new \AlecRabbit\Rewindable($generatorFunction, 1, 3);

foreach ($r as $item) {
    var_dump($item); // int(1..3)
}
// Rewindable is reusable
foreach ($r as $item) {
    var_dump($item); // int(1..3)
}
// reassign variable
$r = new \AlecRabbit\Rewindable($generatorFunction, 3, 1);
foreach ($r as $item) {
    var_dump($item); // int(3..1)
}
