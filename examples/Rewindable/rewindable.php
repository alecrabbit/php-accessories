<?php

use AlecRabbit\Accessories\G;
use AlecRabbit\Accessories\Rewindable;

require_once __DIR__ . '/../../vendor/autoload.php';

$generatorFunction =
    function ($start, $stop) {
        return G::range($start, $stop);
    };
$r = new Rewindable($generatorFunction, 1, 3);

foreach ($r as $item) {
    var_dump($item); // int(1..3)
}
// Rewindable is reusable
foreach ($r as $item) {
    var_dump($item); // int(1..3)
}
// new Rewindable with same generator function
$r = new Rewindable($generatorFunction, 3, 1);
foreach ($r as $item) {
    var_dump($item); // int(3..1)
}
