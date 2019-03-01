<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Caller;

use AlecRabbit\Accessories\Caller\Contracts\CallerConstants;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataFormatterInterface;
use AlecRabbit\Accessories\Contracts\AbstractFormatter;

class CallerDataFormatter extends AbstractFormatter implements CallerDataFormatterInterface, CallerConstants
{
    /**
     * @param mixed $options
     */
    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->options = $options ?? static::SHOW_LINE_AND_FILE;
    }

    /**
     * {@inheritdoc}
     */
    public function process(CallerData $data): string
    {
        if (null !== $class = $data->getClass()) {
            return
                sprintf(
                    '%s%s%s%s',
                    $this->getLineAndFile($data),
                    $class,
                    $data->getType(),
                    $this->getFunction($data)
                );
        }
        return
            sprintf(
                '%s%s',
                $this->getLineAndFile($data),
                $this->getFunction($data)
            );
    }

    /**
     * @param CallerData $caller
     * @return string
     */
    private function getLineAndFile(CallerData $caller): string
    {
        if (($this->options & static::SHOW_LINE_AND_FILE) && self::STR_UNDEFINED !== $caller->getFunction()) {
            return
                sprintf(
                    '[%s:"%s"] ',
                    $caller->getLine(),
                    $caller->getFile()
                );
        }
        return '';
    }

    /**
     * @param CallerData $caller
     * @return string
     */
    private function getFunction(CallerData $caller): string
    {
        $function = $caller->getFunction();
        if ($function === self::STR_UNDEFINED) {
            return ucfirst($function);
        }
        return $function . '()';
    }
}