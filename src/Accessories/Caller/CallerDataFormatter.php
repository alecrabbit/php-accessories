<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Caller;

use AlecRabbit\Accessories\Caller\Contracts\CallerConstants;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataFormatterInterface;
use AlecRabbit\Accessories\Core\AbstractFormatter;

class CallerDataFormatter extends AbstractFormatter implements CallerDataFormatterInterface, CallerConstants
{
    /** {@inheritDoc} */
    public function __construct(?int $options = null)
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
                    (string)$data->getType(),
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
    protected function getLineAndFile(CallerData $caller): string
    {
        if (($this->options & static::SHOW_LINE_AND_FILE) && self::STR_UNDEFINED !== $caller->getFunction()) {
            return
                sprintf(
                    '[%s:"%s"] ',
                    (string)$caller->getLine(),
                    (string)$caller->getFile()
                );
        }
        return '';
    }

    /**
     * @param CallerData $caller
     * @return string
     */
    protected function getFunction(CallerData $caller): string
    {
        $function = $caller->getFunction();
        if ($function === self::STR_UNDEFINED) {
            return ucfirst($function);
        }
        return $function . '()';
    }
}
