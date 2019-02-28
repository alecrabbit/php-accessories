<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Contracts;

interface FormatterInterface
{
    /**
     * @param mixed $options
     */
    public function __construct($options = null);
}
