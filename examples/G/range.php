<?php

use AlecRabbit\Accessories\G;

require_once __DIR__ . '/../../vendor/autoload.php';


$range = G::range(1, 3);
var_dump($range); // object(Generator)

foreach ($range as $item) {
    var_dump($item); // int(1..3)
}
try {
    foreach ($range as $item) {
        var_dump($item); // int(1..3)
    }
} catch (\Exception $e) {
    var_dump($e->getMessage()); // string(43) "Cannot traverse an already closed generator"
}