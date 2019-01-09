<?php

require_once __DIR__ . '/../vendor/autoload.php';

use AlecRabbit\G;
use AlecRabbit\MemoryUsage;

var_dump(MemoryUsage::get(true)); // string(6) "2.00MB"

$r = range(1, 1000000);

var_dump(MemoryUsage::get(true)); // string(7) "34.00MB"
unset($r);

$r = G::range(1, 1000000);

var_dump(MemoryUsage::get(true)); // string(6) "2.00MB"
var_dump(MemoryUsage::getPeak(true)); // string(7) "34.00MB"