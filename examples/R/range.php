<?php

use AlecRabbit\Accessories\R;

require_once __DIR__ . '/../../vendor/autoload.php';

$r = R::range(1, 3);
var_dump($r);
var_dump(iterator_to_array($r));
// array(3) {
//    [0] =>
//    int(1)
//    [1] =>
//    int(2)
//    [2] =>
//    int(3)
// }

// $r is reusable
foreach ($r as $item) {
    var_dump($item); // int(1..3)
}
// int(1)
// int(2)
// int(3)