<?php

require_once __DIR__ . '/../vendor/autoload.php';

$r = range(1, 1000000);

var_dump(\AlecRabbit\MemoryUsage::get(true));
unset($r);
$r = \AlecRabbit\G::range(1, 1000000);
var_dump(\AlecRabbit\MemoryUsage::get(true));
var_dump(\AlecRabbit\MemoryUsage::getPeak(true));