<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

use function AlecRabbit\typeOf;

/**
 * Class Rewindable
 */
class Rewindable implements \Iterator
{
    /** @var callable */
    private $generatorFunction;

    /** @var \Generator */
    private $generator;

    /** @var null|callable */
    private $onRewind;

    /** @var array */
    private $args;

    /**
     * Rewindable constructor.
     * @param callable $generatorFunction
     * @param mixed ...$args
     */
    public function __construct(callable $generatorFunction, ...$args)
    {
        $this->generatorFunction = $generatorFunction;
        $this->args = $args;
        $this->createGenerator(...$args);
    }

    /**
     * @param mixed ...$args
     */
    private function createGenerator(...$args): void
    {
        $this->generator = \call_user_func($this->generatorFunction, ...$args);

        if (!($this->generator instanceof \Generator)) {
            throw new \InvalidArgumentException(
                'Return type of your generator function MUST be a \Generator. Returns: ' .
                typeOf($this->generator)
            );
        }
    }

    /**
     * @param callable $onRewind
     * @return Rewindable
     */
    public function setOnRewind(callable $onRewind): Rewindable
    {
        if (null !== $this->onRewind) {
            throw new \InvalidArgumentException('onRewind handler can be set only once.');
        }

        $this->onRewind = $onRewind;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return
            $this->generator->current();
    }

    /**
     * {@inheritdoc}
     */
    public function next(): void
    {
        $this->generator->next();
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->generator->key();
    }

    /**
     * {@inheritdoc}
     */
    public function valid(): bool
    {
        return $this->generator->valid();
    }

    /**
     * {@inheritdoc}
     */
    public function rewind(): void
    {
        $this->createGenerator(...$this->args);
        if ($this->onRewind) {
            \call_user_func($this->onRewind);
        }
    }
}
