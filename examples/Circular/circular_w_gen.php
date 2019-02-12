<?php

use AlecRabbit\Accessories\Circular;
use function AlecRabbit\brackets;
use function AlecRabbit\typeOf;
use const AlecRabbit\Helpers\Constants\BRACKETS_PARENTHESES;

require_once __DIR__ . '/../../vendor/autoload.php';

$expected = [1 => 1, 'two' => 2, 3 => 3, 'four' => 4];
$genFunc = function () use ($expected) {
    yield from $expected;
};
$c = new Circular($genFunc);

dump($c->value()); // int(1)
dump($c->value()); // int(2)
dump($c->value()); // int(3)
dump($c->key()); // string(4) "four"
dump($c->value()); // int(4)

foreach ($c as $key => $item) {
    dump(typeOf($key) . brackets($key, BRACKETS_PARENTHESES) . ' => ' . typeOf($item) . brackets($item,
            BRACKETS_PARENTHESES) );
}
// "integer(1) => integer(1)"
// "string(two) => integer(2)"
// "integer(3) => integer(3)"
// "string(four) => integer(4)"