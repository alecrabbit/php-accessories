<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Caller;

use AlecRabbit\Accessories\Caller\Contracts\CallerDataFormatterInterface;

class CallerDataFormatter implements CallerDataFormatterInterface
{
    public function process(CallerData $data): string
    {
        $function = $data->getFunction();
        $lineAndFile =
            sprintf(
                '[%s:"%s"]',
                $data->getLine(),
                $data->getFile()
            );
        if (null !== $class = $data->getClass()) {
            return
                sprintf(
                    '%s%s%s %s',
                    $class,
                    $data->getType(),
                    $function,
                    $lineAndFile
                );
        }
        return
            sprintf(
                '%s %s',
                $function,
                $lineAndFile
            );
    }
}
