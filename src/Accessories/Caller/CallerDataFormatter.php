<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Caller;

use AlecRabbit\Accessories\Caller\Contracts\CallerConstants;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataFormatterInterface;

class CallerDataFormatter implements CallerDataFormatterInterface, CallerConstants
{
    public function process(CallerData $data): string
    {
        if (null !== $class = $data->getClass()) {
            return
                sprintf(
                    '%s%s%s%s',
                    $class,
                    $data->getType(),
                    $this->getFunction($data),
                    $this->getLineAndFile($data)
                );
        }
        return
            sprintf(
                '%s%s',
                $this->getFunction($data),
                $this->getLineAndFile($data)
            );
    }

    private function getFunction(CallerData $caller)
    {
        if (self::STR_UNDEFINED === $function = $caller->getFunction()) {
            $function = ucfirst($function);
        } else {
            $function .= '()';
        }
        return $function;
    }

    /**
     * @param CallerData $caller
     * @return string
     */
    private function getLineAndFile(CallerData $caller): string
    {
        if (self::STR_UNDEFINED !== $caller->getFunction()) {
            return
                sprintf(
                    ' [%s:"%s"]',
                    $caller->getLine(),
                    $caller->getFile()
                );
        }
        return '';
    }
}
