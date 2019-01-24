<?php

require_once __DIR__ . '/../vendor/autoload.php';

use AlecRabbit\G;
use AlecRabbit\MemoryUsage;

var_dump(MemoryUsage::get(true)); // string(6) "2.00MB"

$r = range(1, 1000000);

var_dump(MemoryUsage::get(true)); // string(7) "34.00MB"
unset($r);

// when using a generator range much less memory is needed
$r = G::range(1, 1000000);

var_dump(MemoryUsage::get(true)); // string(6) "2.00MB"
var_dump(MemoryUsage::getPeak(true)); // string(7) "34.00MB"

echo MemoryUsage::report('kb') . PHP_EOL;
// Memory: 695.45KB(33456.92KB) Real: 2048.00KB(34820.00KB)


$report = MemoryUsage::report('mb');

var_dump($report->getUsage()); // ~int(721496)
var_dump($report->getPeakUsage()); // ~int(34262904)
var_dump($report->getUsageReal()); // ~int(2097152)
var_dump($report->getPeakUsageReal()); // ~int(35655680)

var_dump($report->getUsageString()); // string(6) "0.69MB"
var_dump($report->getPeakUsageString()); // string(7) "32.67MB"
var_dump($report->getUsageRealString()); // string(6) "2.00MB"
var_dump($report->getPeakUsageRealString()); // string(7) "34.00MB"

echo $report . PHP_EOL;
// Memory: 0.68MB(32.67MB) Real: 2.00MB(34.00MB)
