<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Caller;

use AlecRabbit\Accessories\Caller\Contracts\CallerDataFormatterInterface;

class CallerDataFormatter implements CallerDataFormatterInterface
{
    public function process(CallerData $data): string
    {
        $fl = '';
        $function = $data->getFunction();
        if (false !== strpos($function, '{closure}')) {
            $fl =
                sprintf(
                    '[%s:"%s"]',
                    $data->getLine(),
                    $data->getFile()
                );
        }
        if (null !== $class = $data->getClass()) {
            return
                sprintf(
                    '%s%s%s %s',
                    $class,
                    $data->getType(),
                    $function,
                    $fl
                );
        }
        return
            sprintf(
                '%s %s',
                $function,
                $fl
            );
    }
}
