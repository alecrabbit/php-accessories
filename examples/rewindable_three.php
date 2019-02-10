<?php

use AlecRabbit\Rewindable;

require_once __DIR__ . '/../vendor/autoload.php';

$r = Rewindable::range(1, 3);
var_dump(iterator_to_array($r));
foreach ($r as $item) {
    var_dump($item); // int(1..3)
}
// Rewindable is reusable
foreach ($r as $item) {
    var_dump($item); // int(1..3)

}
