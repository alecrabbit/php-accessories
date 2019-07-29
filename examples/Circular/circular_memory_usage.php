<?php

use AlecRabbit\Accessories\Circular;
use AlecRabbit\Accessories\MemoryUsage;
use AlecRabbit\Accessories\R;

require_once __DIR__ . '/../../vendor/autoload.php';

$memoryUsageReportStart = MemoryUsage::getReport();
echo $memoryUsageReportStart . PHP_EOL;

$c = new Circular(R::range(1, 100000));

$a = 0;
foreach ($c as $item) {
    $a += $item;
}
var_dump($a);

$memoryUsageReport = MemoryUsage::getReport()->diff($memoryUsageReportStart);
echo $memoryUsageReport . PHP_EOL;

// uses more memory
$c = new Circular(range(1, 100000));

$a = 0;
foreach ($c as $item) {
    $a += $item;
}
var_dump($a);

$memoryUsageReportFinal = MemoryUsage::getReport()->diff($memoryUsageReport);
echo $memoryUsageReportFinal . PHP_EOL;