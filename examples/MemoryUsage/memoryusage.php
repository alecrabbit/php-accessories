<?php

use AlecRabbit\Accessories\G;
use AlecRabbit\Accessories\MemoryUsage;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReport;

require_once __DIR__ . '/../../vendor/autoload.php';

// note: your output may differ
var_dump(MemoryUsage::get(true)); // string(6) "2.00MB"

$r = range(1, 1000000);

var_dump(MemoryUsage::get(true)); // string(7) "34.00MB"
unset($r);

// when using a generator range much less memory is used
$r = G::range(1, 1000000);

var_dump(MemoryUsage::get(true)); // string(6) "2.00MB"
var_dump(MemoryUsage::getPeak(true)); // string(7) "34.00MB"

//echo MemoryUsage::reportStatic() . PHP_EOL;
// Memory: 695.45KB(33456.92KB) Real: 2048.00KB(34820.00KB)

$firstReport = MemoryUsage::getReport();
echo $firstReport . PHP_EOL;
echo $firstReport->getPeakUsageRealString() . PHP_EOL;

$memoryUsage = new MemoryUsage;
/** @var MemoryUsageReport $report */
$report = $memoryUsage->report();

var_dump($report->getUsage()); // ~int(721496)
var_dump($report->getPeakUsage()); // ~int(34262904)
var_dump($report->getUsageReal()); // ~int(2097152)
var_dump($report->getPeakUsageReal()); // ~int(35655680)

var_dump($report->getUsageString('kb')); // string(8) "810.84KB"
var_dump($report->getPeakUsageString()); // string(7) "32.67MB"
var_dump($report->getUsageRealString()); // string(6) "2.00MB"
var_dump($report->getPeakUsageRealString('gb')); // string(6) "0.03GB"

echo PHP_EOL;
echo $report . PHP_EOL;
// Memory: 0.68MB(32.67MB) Real: 2.00MB(34.00MB)

$lastReport = MemoryUsage::getReport()->diff($firstReport);

var_dump((string)$firstReport);
var_dump((string)$lastReport);
