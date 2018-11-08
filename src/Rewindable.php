<?php
/**
 * User: alec
 * Date: 08.11.18
 * Time: 15:46
 */

declare(strict_types=1);

namespace AlecRabbit;


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

    /**
     * Rewindable constructor.
     * @param callable $generatorFunction
     */
    public function __construct(callable $generatorFunction)
    {
        $this->generatorFunction = $generatorFunction;
        $this->createGenerator();
    }

    private function createGenerator(): void
    {
        $this->generator = \call_user_func($this->generatorFunction);

        if (!($this->generator instanceof \Generator)) {
            throw new \InvalidArgumentException('Return type of your generator function MUST be a \Generator.');
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
        $this->createGenerator();
        if ($this->onRewind) {
            \call_user_func($this->onRewind);
        }
    }
}