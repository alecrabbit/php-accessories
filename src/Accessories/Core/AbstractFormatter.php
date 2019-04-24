<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\Core;

use AlecRabbit\Accessories\Contracts\FormatterInterface;

abstract class AbstractFormatter implements FormatterInterface
{
    /** @var int */
    protected $options = 0;

    /** {@inheritDoc} */
    public function __construct(?int $options = null)
    {
        $this->options = $options ?? 0;
    }
}
