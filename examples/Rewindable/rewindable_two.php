<?php


use AlecRabbit\Accessories\Rewindable;

require_once __DIR__ . '/../../vendor/autoload.php';

$generatorFunction =
    function () {
        return yield from [1, 0, 3, 6];
    };
$r = new Rewindable($generatorFunction);

foreach ($r as $item) {
    var_dump($item);
}

var_dump(iterator_to_array($r));
