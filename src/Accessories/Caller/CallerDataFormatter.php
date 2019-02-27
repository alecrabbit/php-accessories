<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Caller;

use AlecRabbit\Accessories\Caller\Contracts\CallerConstants;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataFormatterInterface;
use function AlecRabbit\typeOf;

class CallerDataFormatter implements CallerDataFormatterInterface, CallerConstants
{
    /** @var int */
    protected $options;

    public function __construct($options = null)
    {
        $this->assertOptions($options);
        $this->options = $options ?? static::SHOW_LINE_AND_FILE;
    }

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
     * @param $options
     */
    private function assertOptions($options): void
    {
        if (null !== $options && !is_int($options)) {
            throw new \RuntimeException(
                'Options for ' . __CLASS__ . ' constructor should be int, "' . typeOf($options) . '" given.'
            );
        }
    }
}
