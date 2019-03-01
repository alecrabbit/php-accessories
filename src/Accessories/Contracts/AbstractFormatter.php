<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\Contracts;

use AlecRabbit\Accessories\Caller;
use function AlecRabbit\typeOf;

abstract class AbstractFormatter implements FormatterInterface
{
    /** @var int */
    protected $options = 0;

    /**
     * @param mixed $options
     */
    public function __construct($options = null)
    {
        $this->assertOptions($options);
    }

    /**
     * @param mixed $options
     */
    protected function assertOptions($options): void
    {
        if (null !== $options && !is_int($options)) {
            throw new \RuntimeException(
                'Options for `' . static::class . '` constructor should be type of "int", "' .
                typeOf($options) . '" given.' . PHP_EOL .
                Caller::get(3)
            );
        }
    }
}
