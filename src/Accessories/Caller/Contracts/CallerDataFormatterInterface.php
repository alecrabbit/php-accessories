<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Caller\Contracts;

use AlecRabbit\Accessories\Caller\CallerData;

interface CallerDataFormatterInterface
{
    public function process(CallerData $data):string;
}
