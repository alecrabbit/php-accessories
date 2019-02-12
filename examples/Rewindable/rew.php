<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$a = [1 => 1, 'two' => 2, 3 => 3, 'four' => 4];
$genFunc = function () use ($a) {
    yield from $a;
};
$r = new \AlecRabbit\Accessories\Rewindable($genFunc);

foreach ($r as $key => $item) {
    dump($key . ' => ' . $item);
}
$r->rewind();
echo PHP_EOL;

/**
 * @param \AlecRabbit\Accessories\Rewindable $r
 */
function func(\AlecRabbit\Accessories\Rewindable $r): void
{
    dump($r->key(), $r->current(), $r->valid());
    $r->next();
    dump($r->key(), $r->current(), $r->valid());
    echo PHP_EOL;
}

func($r);
func($r);
func($r);
func($r);
func($r);

//if (!$this->valid()) {
//    $this->rewind();
//} else {
//    $this->next();
//}
//return $this->current();
