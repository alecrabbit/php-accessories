<?php declare(strict_types=1);


namespace AlecRabbit\Accessories\Contracts;

interface FormatterInterface
{
    /**
     * @param int|null $options
     */
    public function __construct(?int $options = null);

//    public function process($data): string;
}
