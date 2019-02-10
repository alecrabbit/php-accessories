<?php

require_once __DIR__ . '/../vendor/autoload.php';

use const \AlecRabbit\Helpers\Constants\UNIT_MICROSECONDS;
use AlecRabbit\Pretty;

var_dump(Pretty::bytes(10485760, 'GB')); // string(6) "0.01GB"
var_dump(Pretty::bytes(10584760, 'MB')); // string(7) "10.09MB"
var_dump(Pretty::bytes(10485760, 'KB')); // string(10) "10240.00KB"
echo PHP_EOL;
var_dump(Pretty::time(0.001048576454530, UNIT_MICROSECONDS, 6)); // string(11) "1048.576μs"
var_dump(Pretty::time(0.0000000021)); // string(5) "2.1ns"
var_dump(Pretty::time(0.214)); // string(5) "214ms"
var_dump(Pretty::time(10485760)); // string(9) "2912.711h"
var_dump(Pretty::time(3212)); // string(6) "53.53m"
var_dump(Pretty::time(time())); // find out yourself :)
echo PHP_EOL;
var_dump(Pretty::nanoseconds(10485)); // string(7) "10.5μs"
var_dump(Pretty::seconds(0.214)); // string(5) "214ms"
var_dump(Pretty::useconds(3212)); // string(5) "3.2ms"
var_dump(Pretty::useconds(12)); // string(5) "12μs"
echo PHP_EOL;
var_dump(Pretty::percent(0.214)); // string(6) "21.40%"

